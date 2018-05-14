<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends  \Illuminate\Foundation\Testing\TestCase
{
    use CreatesApplication;

    protected $defaultUser;
    /*
     * @var \App\User
     */
    function defaultUser(){

        if($this->defaultUser){
            return $this->defaultUser;
        }

        return $this->defaultUser = factory('App\User',  1)->create()->first();
    }
}
