<?php

namespace TeamTNT\StripeEvent;



class StripeEvent
{

    protected $version="2014-09-08";

    protected $event = null;

    public function __construct($name)
    {
        $file = dirname(__FILE__) . '/../webhooks/2014-09-08/'.$name.'.json';

        if (file_exists($file)) {
            $this->event=json_decode(file_get_contents($file),true);
        }
    }

    public function toJson($prettyPrint=null)
    {
        return json_encode($this->event,$prettyPrint);
    }


    protected function init()
    {
        $this->event['api_version']=$this->version;
        $this->event['created']=time();
    }



}
