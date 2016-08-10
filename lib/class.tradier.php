<?php if(!defined('ABSPATH')) die('Fatal Error');

class Tradier{

    protected $token = 'OWcXGaw4S7x2ASW2sDIttF2cpGWx';
    protected $handle = null;

    public function __CONSTRUCT(){
        $this->handle = curl_init("https://sandbox.tradier.com/v1/markets/quotes?symbols=spy");
    }

    public function fetch(){
        curl_setopt($this->handle, CURLOPT_HTTPHEADER, array(
            "Accept: application/json",
            "Authorization: Bearer ".$this->token,
        ));

        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($this->handle);

        if ($result === FALSE)
        {
            $error = curl_error($this->handle) ;
            curl_close($this->handle);
            return $error;
        }
        else
        {
            curl_close($this->handle);
            return $result;
        }
    }

}
