<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testCreateOrder()
    {
     
        $data = [
            'category_id' => "1",
            'user_id' => "3",
            'isModerated' => "1",
            'text' => "test",
            'url_to_photo' => "test url",
            'sum' => "10000",
            'tel_number' => "701701701701",
            'address' => "Abay avenue 1",
            'isActive' => "1",
          ];

        $response = $this->post('api/order', $data); 
        $response->assertStatus(201); 
        $this->assertDatabaseHas('orders', $data); 
    }
    // public function testUpdateOrder()
    // {

    //     $order = [ 
    //         'category_id' => 1, 
    //         'user_id' => "3", 
    //         'isModerated' => "1", 
    //         'text' => "mext text", 
    //         'url_to_photo' => "URL", 
    //         'sum' => "5", 
    //         'tel_number' => "777777", 
    //         'address' => "Abay avenue 1", 
    //         'isActive' => "1", 
    //     ]; 
 
    //     $response = $this->put('api/order/16', $order); 
    //     $response->assertStatus(200); 
    //     // $this->assertDatabaseHas('orders', $order); 

    // } 
    // public function testDeleteOrder(): void 
    // { 
    //     $response = $this->delete('api/order/16'); 
    //     $response->assertStatus(200); 
    // } 
    public function testGetAllOrder(): void 
    { 
        $response = $this->get('api/order/get_all'); 
        $response->assertStatus(200); 
    } 
 
    public function testByUserId(): void 
    { 
        $response = $this->get('api/order/by_user_id/69'); 
        $response->assertStatus(200); 
    } 
    public function testCreateOrderError(): void 
    { 
        $order = [ 
            'category_id' => "",
            'user_id' => "",
            'isModerated' => "",
            'text' => "",
            'url_to_photo' => " ",
            'sum' => "",
            'tel_number' => "",
            'address' => "  ",
            'isActive' => "", 
        ]; 
        $response = $this->post('api/order', $order); 
        $response->assertStatus(302); 
        // $this->assertDatabaseHas('users', $user); 
    } 
 
    public function testDeleteOrderError(): void 
    { 
        $response = $this->delete('api/order/'); 
 
        $response->assertStatus(405); 
    } 
 
    public function testOrderByUserIdError(): void 
    { 
        $response = $this->get('api/order/by_user_id/'); 
        $response->assertStatus(500); 
    } 
 
    public function testUpdateUserError(): void 
    { { 
            $order = [ 
                'category_id' => "",
                'user_id' => "",
                'isModerated' => "",
                'text' => "",
                'url_to_photo' => " ",
                'sum' => "",
                'tel_number' => "",
                'address' => "  ",
                'isActive' => "", 
            ]; 
 
            $response = $this->put('api/UpdateUser', $order); 
            $response-> assertStatus(404); 
        } 
    }
}
