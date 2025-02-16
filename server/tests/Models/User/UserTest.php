<?php

namespace Tests\Models\User;

use App\Models\User\User;
use App\Models\User\UserSkills;
use App\Models\User\UserAccolades;
use App\Exceptions\EnvException;
use PHPUnit\Framework\TestCase;
use PDO;
use Carbon\Carbon;

class UserTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        // Mock the database connection
        $this->pdo = $this->createMock(PDO::class);

        $this->pdo
            ->method('prepare')
            ->will($this->returnCallback(function ($query) {
                $stmt = $this->createMock(\PDOStatement::class);

                if (strpos($query, 'SELECT user_id, username, email_address, logged_in, admin, account_type_id FROM user WHERE user_id = ?') !== false) {
                    $stmt->method('execute')
                        ->willReturn(true);
                    $stmt->method('fetch')
                        ->willReturn([
                            'user_id' => 1,
                            'username' => 'testuser',
                            'email_address' => 'testuser@example.com',
                            'logged_in' => 1,
                            'admin' => 0,
                            'account_type_id' => 1
                        ]);
                } elseif (strpos($query, 'SELECT * FROM user WHERE email_address =?') !== false) {
                    $stmt->method('execute')
                        ->willReturn(true);
                    $stmt->method('fetchAll')
                        ->willReturn([[
                            'user_id' => 1,
                            'username' => 'testuser',
                            'email_address' => 'testuser@example.com',
                            'logged_in' => 1,
                            'admin' => 0,
                            'account_type_id' => 1,
                            'password' => password_hash('password', PASSWORD_DEFAULT)
                        ]]);
                }

                return $stmt;
            }));

        $GLOBALS['getDatabase'] = function () {
            return $this->pdo;
        };
    }

    public function testConstructor()
    {
        $user = new User(1);

        $this->assertEquals('testuser', $user->getUsername());
        $this->assertEquals('testuser@example.com', $user->getEmail());
    }

    public function testLoginSuccess()
    {
        $this->assertTrue(User::login('testuser@example.com', 'password'));
    }

    public function testLoginFailure()
    {
        $this->assertFalse(User::login('invaliduser@example.com', 'password'));
    }

    public function testVerifyUsername()
    {
        $user = new User(1);

        $this->assertEmpty($user->verifyUsername('newuser'));
        $this->assertNotEmpty($user->verifyUsername('testuser'));
    }

//    public function testGetTotalLevel()
//    {
//        $userSkillsMock = $this->createMock(UserSkills::class);
//        $userSkillsMock->method('getTotalLevel')->willReturn(100);
//
//        $user = new User(1);
//        $user->skills = $userSkillsMock;
//
//        $this->assertEquals(100, $user->getTotalLevel());
//    }

    public function testLogout()
    {
        $user = new User(1);
        setSignedInUser($user);

        $user->logout();

//        $stmt = $this->pdo->prepare('UPDATE user SET logged_in = 0 WHERE email_address =?');
//        $this->assertNotEquals(false, $stmt);
    }
}
