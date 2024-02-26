<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    // public function testRegisterUser(): void 
    // { 
    //     $user = [ 
    //         'name' => "Vitya",
    //         'password' => "12345678", 
    //         'email' => "vitya@gmail.com", 
    //         'isClient' => "1", 
    //     ]; 
    //     $response = $this->post('api/register', $user); 
    //     $response->assertStatus(200); 
    // } 
    public function testLoginUser(): void 
    { 
        $user = [
            'password' => "12345678", 
            'email' => "vitya@gmail.com", 
        ]; 
        $response = $this->post('api/login', $user); 
        $response->assertStatus(200); 
    } 
    public function testRegisterUserError(): void 
    { 
        $user = [ 
            'name' => "",
            'password' => "", 
            'email' => "", 
            'isClient' => "", 
        ]; 
        $response = $this->post('api/register', $user); 
        $response->assertStatus(302); 
        // $this->assertDatabaseHas('users', $user); 
    } 
    public function testLoginUserError(): void 
    { 
        $user = [
            'password' => "", 
            'email' => "vitya@gmail.com", 
        ]; 
        $response = $this->post('api/login', $user); 
        $response->assertStatus(302); 
    } 
}
