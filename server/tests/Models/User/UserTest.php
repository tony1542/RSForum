<?php

namespace Tests\Models\User;

use App\Models\User\User;
use App\Models\User\UserSkills;
use App\Utils\Runescape\AccountType;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = $this->getMockBuilder(User::class)
            ->onlyMethods(['getUsernameCount'])
            ->getMock();
    }

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
            ->willReturn([
                [
                    'user_id' => 1,
                    'username' => 'testuser',
                    'email_address' => 'testuser@example.com',
                    'password' => password_hash('password', PASSWORD_DEFAULT)
                ]
            ]);

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

    public function testVerifyUsernameValidNewUsername()
    {
        $this->user->method('getUsernameCount')
            ->willReturn(0);

        $this->assertEquals([], $this->user->verifyUsername('newuser'));
    }

    public function testVerifyUsernameEmptyUsername()
    {
        $this->user->expects($this->once())
            ->method('getUsernameCount')
            ->willReturn(0);

        $this->assertEquals(['Enter a username'], $this->user->verifyUsername(''));
    }

    public function testVerifyUsernameLongUsername()
    {
        $this->assertEquals(['Username cannot be longer than 12 characters'],
            $this->user->verifyUsername('verylongusername'));
    }

    public function testVerifyUsernameInvalidCharacters()
    {
        $this->assertEquals(['Username can only contain numbers, letters, or spaces'],
            $this->user->verifyUsername('user!@#'));
    }

    public function testVerifyUsernameExistingUsername()
    {
        $this->user->method('getUsernameCount')
            ->willReturn(1);

        $this->assertEquals(['Username already exists'], $this->user->verifyUsername('existinguser'));
    }

    public function testVerifyUsernameMatchesSignedInUser()
    {
        $this->assertEquals([], $this->user->verifyUsername('signedinuser'));
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

    public function testGetters()
    {
        $userMock = $this->getMockBuilder(User::class)
            ->onlyMethods(['getUserFromDB', 'setRanks', 'getSkills', 'getAccolades'])
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

        $userMock->expects($this->once())
            ->method('getSkills')
            ->willReturn([
                ['skill' => 'attack', 'level' => 99, 'xp' => 13034431],
                ['skill' => 'defence', 'level' => 99, 'xp' => 13034431]
            ]);

        $userMock->expects($this->once())
            ->method('getAccolades')
            ->willReturn([
                ['accolade' => 'zezima', 'score' => 1000],
                ['accolade' => 'lynx titan', 'score' => 2000]
            ]);

        $userMock->load(1);

        $this->assertSame($userMock->getAccountTypeText(), AccountType::PLAYER_TYPE_TEXT[1]);
        $this->assertNotEmpty($userMock->getSkills());
        $this->assertNotEmpty($userMock->getAccolades());
    }
}
