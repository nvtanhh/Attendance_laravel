<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }//    public function testHandleGroup(){
//        $response =$this->action("GET",'HandleGroup@createGroup',['name'=>"TEST",'description'=>"test for des",'location'=>"1"]);
//        $a =$response->getContent();
//        print_r($a);
//    }
}
