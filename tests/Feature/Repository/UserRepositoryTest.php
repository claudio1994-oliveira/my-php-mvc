<?php

namespace App\Tests\Feature\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use PDO;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    private PDO $pdo;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec('DROP TABLE IF EXISTS users;');
        $this->pdo->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT NOT NULL , username TEXT NOT NULL UNIQUE , email TEXT NOT NULL UNIQUE , password TEXT NOT NULL , created_at TIMESTAMP, updated_at TIMESTAMP);');

        $this->userRepository = new UserRepository($this->pdo);
    }

    public function testAddUser()
    {
        $user = new User('John Doe', 'john_doe', 'john@example.com', 'hashed_password');

        $result = $this->userRepository->create($user);

        $this->assertIsObject($result);

        $addedUser = $this->userRepository->find($user->getId());
        $this->assertEquals($user->name, $addedUser->name);
        $this->assertEquals($user->username, $addedUser->username);
        $this->assertEquals($user->email, $addedUser->email);
        $this->assertEquals($user->password, $addedUser->password);
    }

    public function testUpdateUser()
    {
        $existingUser = new User('Existing User', 'existing_user', 'existing@example.com', 'hashed_password');
        $this->userRepository->create($existingUser);

        $existingUser->name = 'Updated User';
        $existingUser->username = 'updated_user';
        $existingUser->email = 'updated@example.com';
        $existingUser->password = 'updated_hashed_password';

        $result = $this->userRepository->update($existingUser->getId(), $existingUser);

        $this->assertTrue($result);

        $updatedUser = $this->userRepository->find($existingUser->getId());
        $this->assertEquals($existingUser->name, $updatedUser->name);
        $this->assertEquals($existingUser->username, $updatedUser->username);
        $this->assertEquals($existingUser->email, $updatedUser->email);
        $this->assertEquals($existingUser->password, $updatedUser->password);
    }

    public function testRemoveUser()
    {
        $existingUser = new User('User to Remove', 'remove_user', 'remove@example.com', 'hashed_password');
        $this->userRepository->create($existingUser);

        $result = $this->userRepository->delete($existingUser->getId());

        $this->assertTrue($result);
    }

    public function testFindAllUsers()
    {

        $user1 = new User('User 1', 'user1', 'user1@example.com', 'hashed_password_1');
        $user2 = new User('User 2', 'user2', 'user2@example.com', 'hashed_password_2');

        $this->userRepository->create($user1);
        $this->userRepository->create($user2);

        $users = $this->userRepository->all();

        $this->assertCount(2, $users);
        $this->assertEquals('User 1', $users[0]['name']);
        $this->assertEquals('User 2', $users[1]['name']);
    }

    public function testFindByUsername()
    {
        $user = new User('Test User', 'test_user', 'test@example.com', 'hashed_password');
        $this->userRepository->create($user);

        $foundUser = $this->userRepository->findByUsername('test_user');

        $this->assertEquals('Test User', $foundUser['name']);
        $this->assertEquals('test_user', $foundUser['username']);
        $this->assertEquals('test@example.com', $foundUser['email']);
        $this->assertEquals('hashed_password', $foundUser['password']);
    }


}