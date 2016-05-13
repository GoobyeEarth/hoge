<?php
require "Cache.php";
class CacheTest extends PHPUnit_Framework_TestCase
{
    function test_push()
    {
        $cache = new Cache();
        $cache->put("test", "test2"); 
        $this->assertCount(1, $cache->data); 
        $this->assertArrayHasKey("test", $cache->data); 
        $this->assertEquals("test2", $cache->data["test"]);   
    }

    function test_get1(){

        $cache = new Cache();
        
        $cache->put("key", "value");
        $cache->put("key2", "value2");
        $cache->put("key3", "value3");
        $cache->put("key3", "value4");    

        $this->assertCount(3, $cache->data);
        $this->assertArrayHasKey("key", $cache->data);
        $this->assertEquals("value", $cache->data["key"]);
        $str = $cache->get("key3");  
        $this->assertEquals("value4", $cache->get("key3"));
        var_dump($cache->data); 
    }
    
    function test_get2(){
         
        $cache = new Cache();
          
        $cache->put(1, "value");
        $cache->put(2, "value2");
        $cache->put(3, "value3"); 
        $cache->put(3, "value4");
               
        $this->assertCount(3, $cache->data);
        $this->assertArrayHasKey(1, $cache->data);
        $this->assertEquals("value", $cache->data[1]);
        $this->assertEquals("value4", $cache->get(3));
        var_dump($cache->data);
    }
    
    function test_remove(){
        $cache = new Cache();
        $cache->put("key", "value");
        $cache->put("key2", "value2");
        $cache->put("key3", "value3");
        $cache->put("key3", "value4");    
            
        $cache->remove("key3");
        $this->assertCount(2, $cache->data);
        var_dump($cache->data);
    }

}
