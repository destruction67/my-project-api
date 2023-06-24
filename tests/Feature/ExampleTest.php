<?php

namespace Tests\Feature;

use App\Services\ObjKeysService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    protected $objKeysService;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->objKeysService = app(ObjKeysService::class);
    }


    public function testGetUserPositionKeys()
    {

        $expectedResult = [
            [
                'id' => 1,
                'name' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'staff',
            ],
            [
                'id' => 3,
                'name' => 'guest',
            ],
        ];


        $result = $this->objKeysService->getUserPositionKeys();

        // Convert the result to an array
        $resultArray = $result->toArray();

        // Assert that the result matches the expected array structure
        $this->assertEquals($expectedResult, $resultArray);

//
//        $result = $this->objKeysService->getUserPositionKeys();
//
//        $resultArray = $result->toArray();
//
//        // Assert that the result is an array
//        $this->assertIsArray($resultArray);

    }
}
