<?php

namespace Tests\Models\User;

use App\Models\User\User;
use App\Models\User\UserSkills;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testLoad()
    {
        $userMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['getUserFromDB', 'setRanks'])
            ->getMock();

        $userMock->expects($this->once())
            ->method('getUserFromDB')
            ->willReturn([
                'user_id' => 1,
                'username' => 'testuser',
                'email_address' => 'testuser@example.com',
                'logged_in' => 1,
                'admin' => 0,
                'account_type_id' => 1
            ]);

        $userMock->load(1);

        $this->assertEquals('testuser', $userMock->getUsername());
        $this->assertEquals('testuser@example.com', $userMock->getEmail());
    }

    public function testLoginSuccess()
    {
        $userMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['getUserByEmail', 'setUserAsLoggedIn'])
            ->getMock();

        $userMock->expects($this->once())
            ->method('getUserByEmail')
            ->with('testuser@example.com')
            ->willReturn([[
                'user_id' => 1,
                'username' => 'testuser',
                'email_address' => 'testuser@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT)
            ]]);

        $userMock->expects($this->once())
            ->method('setUserAsLoggedIn');

        $this->assertTrue($userMock->login('testuser@example.com', 'password'));
    }

    public function testLoginFailure()
    {
        $userMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['getUserByEmail'])
            ->getMock();

        $userMock->expects($this->once())
            ->method('getUserByEmail')
            ->with('invaliduser@example.com')
            ->willReturn([]);

        $this->assertFalse($userMock->login('invaliduser@example.com', 'password'));
    }

    public function testVerifyUsername()
    {
        $userMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['getUsernameCount'])
            ->getMock();

        $userMock->method('getUsernameCount')
            ->willReturnOnConsecutiveCalls(0, 1);

        $this->assertEmpty($userMock->verifyUsername('newuser'));
        $this->assertNotEmpty($userMock->verifyUsername('testuser'));
    }

    public function testGetTotalLevel()
    {
        $userMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['setRanks'])
            ->getMock();

        $userSkillsMock = $this->createMock(UserSkills::class);
        $userSkillsMock->method('getTotalLevel')->willReturn(100);

        $userMock->setSkills($userSkillsMock);

        $this->assertEquals(100, $userMock->getTotalLevel());
    }

    public function testLogout()
    {
        $userMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['setUserAsLoggedOut'])
            ->getMock();

        $userMock->expects($this->once())
            ->method('setUserAsLoggedOut');

        setSignedInUser($userMock);

        session_start();
        $userMock->logout();
        $this->assertFalse($userMock->isAdmin());
    }
}
