<?php

namespace App\Tests\Functional\Auth;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\UserFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class UserLoginTest extends ApiTestCase
{
    use ResetDatabase;
    use Factories;

    const AUTH_LOGIN_URL = '/api/auth/signin';

    public function testLoginWhenUserDoestNotExist(): void
    {
        $options = [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => ['email'=> 'nonexistuser@mail.test', 'password' =>'passwordtest']
        ];

        $client = static::createClient();
        $client->request('POST', static::AUTH_LOGIN_URL, $options);

        $this->assertResponseStatusCodeSame(401);
    }


    public function testLoginWhenBadCredentials(): void
    {
        $userFactory = self::getContainer()->get(\App\Factory\UserFactory::class);
        $userFactory->createOne([
            'email' => 'johndoe@mail.test',
        ]);

        $options = [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'email'=> 'johndoe@mail.test',
                // 'password' => UserFactory::USER_FACTORY_FAKE_PASSWORD
                'password' => 'wrongpassword'
            ]
        ];

        $client = static::createClient();
        $client->request('POST', static::AUTH_LOGIN_URL, $options);

        $this->assertResponseStatusCodeSame(401);
    }

    public function testLoginSuccessfulyWithJwtReturned(): void
    {
        $userFactory = self::getContainer()->get(\App\Factory\UserFactory::class);
        $userFactory->createOne([
            'email' => 'johndoe@mail.test',
        ]);

        $options = [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'email'=> 'johndoe@mail.test',
                'password' => UserFactory::USER_FACTORY_FAKE_PASSWORD
            ]
        ];

        $client = static::createClient();
        $client->request('POST', static::AUTH_LOGIN_URL, $options);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);

        $data = $client->getResponse()->toArray();
        $this->assertArrayHasKey('token', $data);
        $this->assertNotEmpty($data['token']);
    }
}
