<?php

namespace Tests\Feature;

use Illuminate\Auth\Authenticatable;
use Tests\FeatureTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTests extends FeatureTestCase
{
    use DatabaseTransactions;

    /**
     * A basic functional test for user login.
     *
     * @return void
     */
    public function test_login_user()
    {

      
        $this->actingAs($this->defaultUser());

        $response = $this->json('POST', '/api/v1/auth/login', ['email' => 'demo@demo.com', 'password' => bcrypt('demo')]);

        $response->assertStatus(200);

    }

    /**
     * A basic functional test for user register.
     *
     * @return void
     */
    public function test_register_user()
    {


        $response = $this->json('POST', '/api/v1/auth/register',  ['email' => 'email2@emailtest.com', 'password' => bcrypt('secret'), 'forename' => 'paco', 'surname' => 'suarez']);

        $response->assertStatus(201);

    }




}
