<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use \net\authorize\api\constants\ANetEnvironment;
use App\Models\PaymentProfile;


class AuthorizeDotNetController extends Controller {

    public function __construct(){

        $this->endpoint = ((boolean)env("AUTHORIZE_DOT_NET_USE_PRODUCTION_ENDPOINT")) ? ANetEnvironment::PRODUCTION : ANetEnvironment::SANDBOX;
        //$this->customerProfileId = auth()->user()->authorize_dot_net_customer_profile_id;
        $this->customerProfileId = "506144082";
    }

    public function index() {
        
        $request = new AnetAPI\GetCustomerProfileRequest();
        $request->setMerchantAuthentication($this->getMerchantAuthentication());
        $request->setCustomerProfileId($this->customerProfileId);
        $controller = new AnetController\GetCustomerProfileController($request);
        $response = $controller->executeWithApiResponse($this->endpoint);

        if(!$this->responseSuccess($response)){

            var_dump($response->getMessages());exit;
        }

        $customerProfile = $response->getProfile();
        $paymentProfiles = $customerProfile->getPaymentProfiles();

        if(empty($paymentProfiles)) $paymentProfiles = [];

        $stdObjPaymentProfiles = [];
        foreach($paymentProfiles as $profile) $stdObjPaymentProfiles[] = PaymentProfile::fromMaskedTypeToStandardObject($profile);

        return Inertia::render("Playground/AuthorizeDotNet/Index", ["paymentProfiles" => $stdObjPaymentProfiles]);
    }


    public function getMerchantAuthentication() {

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env("AUTHORIZE_DOT_NET_API_MERCHANT_LOGIN_ID"));
        $merchantAuthentication->setTransactionKey(env("AUTHORIZE_DOT_NET_MERCHANT_TRANSACTION_KEY"));

        return $merchantAuthentication;
    }

    public function responseSuccess($response) {

        $successCode = "OK";

        return $response->getMessages()->getResultCode() !== $successCode;
    }


    public function create() {

        return Inertia::render("Playground/AuthorizeDotNet/NewCard");
    }

    public function store(Request $request) {

        // Create a new Customer Payment Profile object
        $paymentProfile = new AnetAPI\CustomerPaymentProfileType();
        $paymentProfile->setCustomerType('individual');
        $paymentProfile->setBillTo($this->billTo($request));
        $paymentProfile->setPayment($this->paymentType($request));
        $paymentProfile->setDefaultPaymentProfile(true);

        // Assemble the complete transaction request
        $paymentProfileRequest = new AnetAPI\CreateCustomerPaymentProfileRequest();
        $paymentProfileRequest->setMerchantAuthentication($this->getMerchantAuthentication());
    
        // Add an existing profile id to the request
        $paymentProfileRequest->setCustomerProfileId($this->customerProfileId);
        $paymentProfileRequest->setPaymentProfile($paymentProfile);
        $paymentProfileRequest->setValidationMode("liveMode");
    
        // Create the controller and get the response
        $controller = new AnetController\CreateCustomerPaymentProfileController($paymentProfileRequest);
        $response = $controller->executeWithApiResponse($this->endpoint);

        if($this->responseSuccess($response)) {

            $payment_profile = new PaymentProfile();
            $payment_profile->exp_month = $request->expMonth;
            $payment_profile->exp_year = $request->expYear;
            $payment_profile->external_id = $response->getCustomerProfileId();
            $payment_profile->save();

            return redirect(route("payments"));
        }

        else throw new \Exception($response->getMessages());
    }

    public function show($id) {

        var_dump("Hello from show");exit;
    }
    
    public function edit($id) {

        var_dump("Hello from edit");exit;
    }

    public function update(Request $request, $id) {

        var_dump("Hello from update");exit;
    }

    public function destroy($id) {

        var_dump("Hello from destroy");exit;
    }

    // Create the Bill To info for new payment type
    public function billTo($request) {

        $billTo = new AnetAPI\CustomerAddressType();
        $billTo->setFirstName($request->firstName);
        $billTo->setLastName($request->lastName);
        $billTo->setAddress($request->address);
        $billTo->setCity($request->city);
        $billTo->setState($request->state);
        $billTo->setZip($request->zip);
        $billTo->setCountry("USA");
        $billTo->setPhoneNumber($request->phone);

        return $billTo;
    }

    public function paymentType($request) {

        // Set credit card information for payment profile
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($request->cardNumber);
        $creditCard->setExpirationDate($request->expYear ."-". $request->expMonth);
        $paymentType = new AnetAPI\PaymentType();
        $paymentType->setCreditCard($creditCard);

        return $paymentType;
    }
}
