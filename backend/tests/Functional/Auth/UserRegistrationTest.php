<?php

namespace App\Tests\Functional\Auth;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\UserFactory;
use Zenstruck\Foundry\Test\ResetDatabase;
use Zenstruck\Foundry\Test\Factories;

class UserRegistrationTest extends ApiTestCase
{
    use ResetDatabase;
    use Factories;

    const AUTH_REGISTRATION_URL = '/api/auth/registration';

    private function getValidRegistrationData(): array
    {
        return [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'johndoe@mail.test',
            'confirmEmail' => 'johndoe@mail.test',
            'password' => 'passwordtest',
            'confirmPassword' => 'passwordtest'
        ];
    }

    private function getRegistrationDataWithoutEmail()
    {
        $data = $this->getValidRegistrationData();
        unset($data['email']);
        unset($data['confirmEmail']);

        return $data;
    }

    public function testRegistrationWhenEmailIsMissing(): void
    {
        $options = [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => $this->getRegistrationDataWithoutEmail()
        ];

        $client = static::createClient();
        $client->request('POST', static::AUTH_REGISTRATION_URL, $options);

        $this->assertResponseStatusCodeSame(422);
        $this->assertJsonContains([
            'violations' => [
                ['propertyPath' => 'email'],
                ['propertyPath' => 'confirmEmail'],
            ]
        ]);
    }

    public function testRegistrationWhenEmailIsAlreadyUsed(): void
    {
        $client = static::createClient();

        $userFactory = self::getContainer()->get(\App\Factory\UserFactory::class);
        $userFactory->createOne([
            'email' => 'johndoe@mail.test',
        ]);

        $options = [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => $this->getValidRegistrationData(),
        ];

        $client->request('POST', static::AUTH_REGISTRATION_URL, $options);

        $this->assertResponseStatusCodeSame(422);
        $this->assertJsonContains([
            'violations' => [
                ['propertyPath' => 'email'],
            ],
        ]);
    }

    public function testRegistrationSuccessfuly(): void
    {
        $options = [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => $this->getValidRegistrationData()
        ];

        $client = static::createClient();
        $client->request('POST', static::AUTH_REGISTRATION_URL, $options);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(201);
    }
}
