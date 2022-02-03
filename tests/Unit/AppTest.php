<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AppTest extends TestCase
{
    public function test_getProducts()
    {
        $response = $this->get('/api/v1/getProducts');
        $this->assertEquals(200, $response->status());
    }

    public function test_getProduct()
    {
        $response = $this->get('/api/v1/getProduct/1');
        $this->assertEquals(200, $response->status());
    }

    public function test_getProductsForUser()
    {
        $response = $this->get('/api/v1/getProductsForUser/1');
        $this->assertEquals(200, $response->status());
    }

    public function test_deleteProduct()
    {
        $response = $this->get('/api/v1/deleteProduct/1000');
        $this->assertEquals(200, $response->status());
    }

    public function test_addProduct()
    {
        $response = $this->post('/api/v1/addProduct/');
        $this->assertEquals(422, $response->status());
    }

    public function test_updateProduct()
    {
        $response = $this->post('/api/v1/updateProduct/');
        $this->assertEquals(422, $response->status());
    }

    public function test_uploadProductImage()
    {
        $response = $this->post('/api/v1/uploadProductImage/');
        $this->assertEquals(422, $response->status());
    }

    public function test_addProductToUser()
    {
        $response = $this->post('/api/v1/addProductToUser/');
        $this->assertEquals(422, $response->status());
    }

    public function test_removeProductToUser()
    {
        $response = $this->post('/api/v1/removeProductToUser/');
        $this->assertEquals(422, $response->status());
    }

}
