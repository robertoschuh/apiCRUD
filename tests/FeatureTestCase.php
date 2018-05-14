<?php
/**
 * Created by PhpStorm.
 * User: r0b
 * Date: 14/05/18
 * Time: 19:02
 */

namespace Tests;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FeatureTestCase extends TestCase
{
    use DatabaseMigrations;

    protected $defaultUser;

    /*
     * @var \App\User
     */
    function defaultUser(){

        if($this->defaultUser){
            return $this->defaultUser;
        }

        return $this->defaultUser = factory('App\User',  1)->create();
    }

}