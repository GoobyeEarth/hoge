<?php

class Cache
{
    public $data  = array();
    function put($argKey, $argValue)
    {
        $this->data[$argKey] = $argValue;

    }

    function get($key)
    {
        if(array_key_exists($key, $this->data) ){
            return  $this->data[$key];    
        }
        else{
            return null;
        }

            

    }

    function remove($key)
    {
        if(array_key_exists($key, $this->data) ){
            unset($this->data[$key]);
            return true;    
        }
        else{
            return false;
        }

    }
    





}
