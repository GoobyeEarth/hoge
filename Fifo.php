<?php

class Fifo
{
    private  $data  = array();
    public function __constract(){

    }
    
    public function put($argKey, $argValue)
    {
        $this->data[$argKey] = $argValue;
    }
    
    public function get($key)
    {
        if(array_key_exists($key, $this->data) ){
            return  $this->data[$key];    
        }
        else{
            return null;
        }
            
    }
    
    public function remove($key)
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
