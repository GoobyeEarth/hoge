<?php

class Fifo
{
    private  $data = [];
    
    private $maxDataNum = 2;
    private $inCount = 0;
    

    public function __construct($maxNum){
        $this->maxDataNum = $maxNum;
    }
    
    public function put($argKey, $argValue)
    {  
        if(array_key_exists($argKey, $this->data)){
          $this->data[$argKey]['value'] = $argValue; 
            return ;
        }

        $this->data[$argKey]['value'] = $argValue;
        $this->data[$argKey]['count'] = $this->inCount;
        
        foreach($this->data as $record){
            if($record['count'] <= $this->inCount - $this->maxDataNum){
                //unset($record);
                //var_dump($record);
                $key = $this->findKey($record['count']);
                unset($this->data[$key]);
            }
        }
        $this->inCount++;
    }
    
    public function get($key)
    {
        if(array_key_exists($key, $this->data) ){
            return  $this->data[$key]['value'];    
        }
        else{
            return null;
        }
            
    }
    
    public function remove($key)
    {
        if(array_key_exists($key, $this->data) ){
            
            $shiftCount = $this->data[$key]['count'];
            
            for($count = $shiftCount - 1; $this->inCount - $this->maxDataNum <= $count; $count--){
                if($this->findKey($count) != null){

                    $this->data[$this->findKey($count)]['count']++;
                }
            }

            unset($this->data[$key]);
            
            
            return true;    
        }
        else{
            return false;
        }

    }
    
    private function findKey($num)
    {   
        foreach($this->data as $record){
            if($record['count'] === $num){
                return array_keys($this->data, $record)[0];        
            }
        }
        
        return null;



    }   
    public function getDataNum()
    {
        return count($this->data);        
    }

    
}
