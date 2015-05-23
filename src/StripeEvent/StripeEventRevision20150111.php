<?php

namespace TeamTNT\StripeEvent;

use TeamTNT\StripeEvent\StripeEvent;


class StripeEventRevision20150111 extends StripeEvent
{

    protected $version='2015-01-11';

    public function __construct($name) {

        parent::__construct($name);

        $this->init();

        $methodName = 'upgrade' .str_replace(' ', '', ucwords(str_replace('.', ' ', $name)));
        if (method_exists ($this,$methodName)){
            $this->$methodName();
        }
    }

    private function upgradeAccountUpdated() {
        $this->event['data']['object']['charges_enabled'] = true;
        $this->event['data']['object']['transfers_enabled'] = true;
        $this->event['data']['object']['support_phone'] = '1234567890';
        $this->event['data']['object']['managed'] = false;
        $this->event['data']['object']['product_description'] =  'Some description';
        $this->event['data']['object']['bank_accounts']['data']['id'] =  'ba_00000000000000000000000';

        unset($this->event['data']['object']['verification']['decline_on_cvc_failure']);
        unset($this->event['data']['object']['verification']['decline_on_avs_failure']);
        $this->event['data']['object']['verification']['contacted'] = false;

        unset($this->event['data']['object']['tax_details']);
        unset($this->event['data']['object']['transfer_enabled']);
        unset($this->event['data']['object']['charge_enabled']);
        unset($this->event['data']['object']['phone_number']);
        unset($this->event['data']['object']['decline_charge_on_cvc_failure']);
        unset($this->event['data']['object']['decline_charge_on_avs_failure']);
        unset($this->event['data']['object']['bank_account']);
        
        
        unset($this->event['data']['object']['address']);
        unset($this->event['data']['object']['personal_information']);

        $this->event['data']['object']['legal_entity'] = [
            'type' => 'sole_prop',
                'business_name'=> 'Tester',
                'address'=> [
                'line1'=> '123 Street Name',
                    'line2'=> null,
                    'city'=> 'City Name',
                    'state'=> 'NY',
                    'postal_code'=> '90403',
                    'country'=> 'US'
                ],
                'first_name' => 'FirstName',
                'last_name' => 'LastName',
                'personal_address' => [
                    'line1' => null,
                        'line2' => null,
                        'city' => null,
                        'state' => null,
                        'postal_code' => null,
                        'country' => 'US'
                    ],
                'dob'=> [
                    'day'=> 14,
                    'month'=> 4,
                    'year'=> 1977],
                'additional_owners' => [],
                'verification' => [
                    'status' => 'verified',
                    'document' => null,
                    'details' => null
                ],
            'decline_charge_on' => [
                'cvc_failure' => false,
                'avs_failure' => false
            ]];


    }



}
