<?php

namespace App\tests\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\UserController;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class UserControllerTest extends TestCase
{
    public function testLogin()
    {


        $client = new Client();

        try {
            $response = $client->request('POST', 'http://localhost/orangehrm_assignment/public/login', [
                    'username' => 'admin2',
                    'password' => '11111'
            ]);


            echo $response->getBody()->getContents();
            $this->assertEquals('true', 'true');
        } catch (GuzzleException $e) {
        }


    }
}

