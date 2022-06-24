<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use \net\authorize\api\constants\ANetEnvironment;
use App\Models\PaymentProfile;


class AuthorizeDotNetController extends Controller {

    public function index() {

        $myCustomerProfileId = "506144082";
        $merchantAuthentication = $this->getMerchantAuthentication();
        $endpoint = ((boolean)env("AUTHORIZE_DOT_NET_USE_PRODUCTION_ENDPOINT")) ? ANetEnvironment::PRODUCTION : ANetEnvironment::SANDBOX;

        $request = new AnetAPI\GetCustomerProfileRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setCustomerProfileId($myCustomerProfileId);
        $controller = new AnetController\GetCustomerProfileController($request);
        $response = $controller->executeWithApiResponse($endpoint);

        if(!$this->responseSuccess($response)){

            var_dump($response->getMessages());exit;
        }

        $customerProfile = $response->getProfile();
        $paymentProfiles = $customerProfile->getPaymentProfiles();

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


    public function create() {}

    public function store(Request $request) {}

    public function show($id) {}
    
    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
