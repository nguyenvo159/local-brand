<?php

namespace CT275\Labs;

use PDO;

class UserRepository
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function findByEmail(string $email): ?User
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return new User($user['userID'], $user['firstName'], $user['lastName'], $user['email'], $user['password'], $user['phone']);
        }

        return null;
    }
    public function findById(int $userID): ?User
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE userID = :userID");
        $statement->bindParam(':userID', $userID);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return new User($user['userID'], $user['firstName'], $user['lastName'], $user['email'], $user['password'], $user['phone']);
        }

        return null;
    }

    public function addUser(string $firstName, string $lastName, string $email, string $password, string $phone): bool
    {
        $statement = $this->pdo->prepare("INSERT INTO users (firstName, lastName, email, password, phone) VALUES (?, ?, ?, ?, ?)");
        return $statement->execute([$firstName, $lastName, $email, $password, $phone]);
    }

    public function checkPassword(User $user, string $password): bool
    {
        return $user->getPassword() === $password;
    }
}

class User
{
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $password;
    protected $phone;

    

    public function __construct($id, $firstName, $lastName, $email, $password, $phone)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
    }

    // Các phương thức getter và setter cho các thuộc tính

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    // Các phương thức khác cần thiết cho việc làm việc với thông tin người dùng
}
