<?php
require "Fifo.php";
class FifoTest extends PHPUnit_Framework_TestCase
{
    /**
    *
    * this test includes post test;
    */
    function test_get(){
        $cache = new Fifo();
        $cache->put("key", "value");
        $cache->put("key2", "value2");
        $cache->put("key2", "value3");
        $this->assertEquals("value", $cache->get("key"));
        $this->assertEquals("value3", $cache->get("key2"));
        $this->assertNull($cache->get("key3"));        

    }
    
    
    function test_remove(){
        $cache = new Fifo();
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

}
