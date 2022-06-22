<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentProfile extends Model {

    public $isDefault;
    public $id;
    public $cardType;
    public $cardNumber;
    public $expirationDate;
    public $date;
    public $firstName;
    public $lastName;
    public $phone;
    public $fax;
    public $email;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $country;
    public $dateIsMasked;

    use HasFactory;


    public static function fromMaskedType($masked) {

        $profile = new self();
        $profile->setDefault($masked->getDefaultPaymentProfile());

        if(method_exists($masked, "getCustomerPaymentProfileId")) {

            $profile->id = $masked->getCustomerPaymentProfileId();
        }

        $profile->cardType = $masked->getPayment()->getCreditCard()->getCardType();
        $profile->cardNumber = $masked->getPayment()->getCreditCard()->getCardNumber();
        $profile->expirationDate = $masked->getPayment()->getCreditCard()->getExpirationDate();

        $profile->dateIsMasked = self::isMaskedDate($profile->expirationDate);
        if(!$profile->dateIsMasked) $profile->date = new DateTime($profile->expirationDate);

        $profile->setPaymentProfileBillingInfo($masked->getBillTo());

        return $profile;
    }

    
    private static function isMaskedDate($date){

        return strpos($date, "X") === 0;
    }


    public function setDefault($status) {

        $this->isDefault = $status == true;
    }

    public function firstName() {

        return $this->firstName;
    }

    public function id() {

        return $this->id;
    }

    public function lastName() {

        return $this->lastName;
    }

    public function type() {

        return $this->cardType;
    }

    public function lastFour() {

        return substr($this->cardNumber, -4);
    }

    public function maskedCardNumber() {

        return $this->cardNumber;
    }

    public function expiresOn() {

        return $this->expirationDate;
    }

    public function expYear() {

        if(empty($this->id)) return "";

        return $this->dateIsMasked ? "XX" : $this->date->format("Y");
    }

    public function expMonth() {

        if(empty($this->id)) return "";

        return $this->dateIsMasked ? "XX" : $this->date->format("m");
    }

    public function phone() {

        return $this->phone;
    }

    public function email() {

        return $this->email;
    }

    public function address() {

        return $this->address;
    }

    public function city() {

        return $this->city;
    }

    public function state() {

        return $this->state;
    }

    public function zip() {

        return $this->zip;
    }

    public function country() {

        return $this->country;
    }

    public function isDefault() {

        return $this->isDefault;
    }


	public function setPaymentProfileBillingInfo($billTo) {

        if(empty($billTo)) return null;

        $this->phone = $billTo->getPhoneNumber();
        $this->fax = $billTo->getFaxNumber();
        $this->email = $billTo->getEmail();
        $this->firstName = $billTo->getFirstName();
        $this->lastName = $billTo->getLastName();
        $this->address = $billTo->getAddress();
        $this->city = $billTo->getCity();
        $this->state = $billTo->getState();
        $this->zip = $billTo->getZip();
        $this->country = $billTo->getCountry();
	}

    public function setExpirationDate($date) {

        //var_dump($date);exit;

        $this->dateIsMasked = false;
        $this->date = new DateTime($date);
    }
}
