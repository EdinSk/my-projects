<?php

require_once __DIR__ . '/database.php';

class USER extends DB
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->instance->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($data)
    {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateUser($userId, $username, $email, $role)
    {
        $sql = "UPDATE users SET username = :username, email = :email, role = :role WHERE user_id = :user_id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteUser($userId)
    {
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function loginUser($email, $password)
    {
        $sql = "SELECT user_id, username, role, email, password FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':email', $email);

        try {
            if ($stmt->execute()) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    // Remove the password hash before returning user data
                    unset($user['password']);
                    return $user;
                } else {
                    // Invalid email or password
                    return false;
                }
            } else {
                // If query execution fails
                throw new Exception("Error executing login query.");
            }
        } catch (PDOException $e) {
            // Log database errors securely
            error_log("Database error in loginUser: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            // Log general errors
            error_log("General error in loginUser: " . $e->getMessage());
            return false;
        }
    }

    public function emailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function getUserIinstanceByEmail($email)
    {
        $sql = "SELECT user_id FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
