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

        $merchantAuthentication = $this->getMerchantAuthentication();
        
        $request = new AnetAPI\GetCustomerProfileRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
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

        var_dump($request->all());exit;

        $paymentProfileDb new PaymentProfile();

        $merchantAuthentication = $this->getMerchantAuthentication();

        $refId = 'ref' . time();
    
        // Set credit card information for payment profile
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($request->cardNumber);
        $creditCard->setExpirationDate($request->expYear ."-". $request->expMonth);
        $paymentType = new AnetAPI\PaymentType();
        $paymentType->setCreditCard($creditCard);
    
        // Create the Bill To info for new payment type
        $billto = new AnetAPI\CustomerAddressType();
        $billto->setFirstName($request->firstName);
        $billto->setLastName($request->lastName);
        $billto->setAddress($request->address);
        $billto->setCity($request->city);
        $billto->setState($request->state);
        $billto->setZip($request->zip);
        $billto->setCountry("USA");
        $billto->setPhoneNumber($request->phone);
    
        // Create a new Customer Payment Profile object
        $PaymentProfile = new AnetAPI\CustomerPaymentProfileType();
        $PaymentProfile->setCustomerType('individual');
        $PaymentProfile->setBillTo($billto);
        $PaymentProfile->setPayment($paymentType);
        $PaymentProfile->setDefaultPaymentProfile(true);
    
        // Assemble the complete transaction request
        $PaymentProfileRequest = new AnetAPI\CreateCustomerPaymentProfileRequest();
        $PaymentProfileRequest->setMerchantAuthentication($merchantAuthentication);
    
        // Add an existing profile id to the request
        $PaymentProfileRequest->setCustomerProfileId($this->customerProfileId);
        $PaymentProfileRequest->setPaymentProfile($PaymentProfile);
        $PaymentProfileRequest->setValidationMode("liveMode");
    
        // Create the controller and get the response
        $controller = new AnetController\CreateCustomerPaymentProfileController($PaymentProfileRequest);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

        if($this->responseSuccess($response)) return redirect(route("payments"));

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
}
