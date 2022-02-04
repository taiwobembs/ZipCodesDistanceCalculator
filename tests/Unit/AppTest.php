<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AppTest extends TestCase
{

    public function test_getZipCodes()
    {
        $response = $this->get('/api/v1/getZipCodes');
        $this->assertEquals(200, $response->status());
    }

    public function test_getZipCode()
    {
        $response = $this->get('/api/v1/getZipCode/1');
        $this->assertEquals(200, $response->status());
    }


}
