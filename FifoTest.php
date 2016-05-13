<?php
require "Fifo.php";
class FifoTest extends PHPUnit_Framework_TestCase
{
    /**
    *
    * this test includes post test;
    */
    function test_get(){
        $cache = new Fifo(10);
        $cache->put("key", "value");
        $cache->put("key2", "value2");
        $cache->put("key2", "value3");
        $this->assertEquals("value", $cache->get("key"));
        $this->assertEquals("value3", $cache->get("key2"));
        $this->assertNull($cache->get("key3"));        

    }
    
    
    function test_remove(){
        $cache = new Fifo(10);
        $cache->put("key", "value");
        $cache->put("key2", "value2");
        $cache->put("key3", "value3");
            
        $bool = $cache->remove("key3");
        $this->assertNull($cache->get("key3"));
        $this->assertTrue($bool);
        $this->assertEquals("value", $cache->get("key"));
        $this->assertEquals("value2", $cache->get("key2"));
        

        $bool = $cache->remove("key4");
        $this->assertFalse($bool);

    }
    
    function test_limitDataNum()
    {
        $cache = new Fifo(2);
        $cache->put("key", "value");
        $cache->put("key2", "value2");
        $cache->put("key3", "value3");
        $cache->put("key4", "value4");
        
       $this->assertEquals(2, $cache->getDataNum()); 
       $this->assertNull($cache->get("key"));
       $this->assertNull($cache->get("key2"));
       $this->assertEquals("value3", $cache->get("key3"));
       $this->assertEquals("value4", $cache->get("key4")); 
    }
    
    function test_limitDataNumUpdated()
    {
        $cache = self::dataSet();
        $cache->put("key4", "value5");

        $this->assertEquals(2, $cache->getDataNum());   
        $this->assertNull($cache->get("key"));
        $this->assertNull($cache->get("key2"));
        $this->assertEquals("value3", $cache->get("key3"));
        $this->assertEquals("value5", $cache->get("key4"));
        
        

    }
    
    function test_limitDataNumRemoved()
    {
        $cache = self::dataSet();
        $cache->remove("key4");
        
        $this->assertEquals(1, $cache->getDataNum());
        $this->assertNull($cache->get("key"));
         $this->assertNull($cache->get("key2"));
         $this->assertEquals("value3", $cache->get("key3"));
         $this->assertNull($cache->get("key4"));

    }
     
    static function dataSet(){
        $cache = new Fifo(2);
        $cache->put("key", "value");
        $cache->put("key2", "value2");
        $cache->put("key3", "value3");
        $cache->put("key4", "value4");
        return $cache;   
    }
}   

