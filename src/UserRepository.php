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
        $statement = $this->pdo->prepare("INSERT INTO users (firstName, lastName, email, password, phone) VALUES (:firstName, :lastName, :email, :password, :phone)");
        
        $statement->bindParam(':firstName', $firstName);
        $statement->bindParam(':lastName', $lastName);
        $statement->bindParam(':email', $email);

        // Băm mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $statement->bindParam(':password', $hashedPassword);
        // $statement->bindParam(':password', $password);
        
        $statement->bindParam(':phone', $phone);

        return $statement->execute();
    }

    public function checkPassword(User $user, string $password): bool
    {
        // return $user->getPassword() === $password;

        return password_verify($password, $user->getPassword());
    }

    public function updatePassword(int $userID, string $newPassword): bool
    {
        // Băm mật khẩu mới
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $statement = $this->pdo->prepare("UPDATE users SET password = :password WHERE userID = :userID");
        $statement->bindParam(':password', $hashedPassword);
        $statement->bindParam(':userID', $userID);

        return $statement->execute();
    }
    public function updateUserProfile(int $userID, string $firstName, string $lastName, string $email, string $phone): bool
    {
        $statement = $this->pdo->prepare("UPDATE users SET firstName = :firstName, lastName = :lastName, email = :email, phone = :phone WHERE userID = :userID");

        $statement->bindParam(':firstName', $firstName);
        $statement->bindParam(':lastName', $lastName);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':userID', $userID);

        return $statement->execute();
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
