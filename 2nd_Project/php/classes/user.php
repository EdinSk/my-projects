<?php

require_once __DIR__ . '/database.php';

class USER extends DB {
    
    public function __construct() {
        parent::__construct();
    }

    public function createUser($data) {
        $role = 2; // Default role for a new user
    
        $sql = "INSERT INTO users (username, email, password, role)
                VALUES (:inputName, :inputEmail, :inputPassword, :role)";
        $stmt = $this->instance->prepare($sql);
    
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
    
        $stmt->bindParam(':inputName', $data['username']);
        $stmt->bindParam(':inputEmail', $data['email']);
        $stmt->bindParam(':inputPassword', $passwordHash);
        $stmt->bindParam(':role', $role);
    
        // Execute the query and return the result
        try {
            $result = $stmt->execute();
            return $result; // Return the execution result
        } catch (PDOException $e) {
            // Handle the error (e.g., log it, display an error message)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function loginUser($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':email', $email);
    
        try {
            if ($stmt->execute()) {
                $user = $stmt->fetch();
    
                if ($user && password_verify($password, $user['password'])) {
                    return $user; // Login successful
                } else {
                    return false; // Invalid email or password
                }
            } else {
                throw new Exception("Error executing login query.");
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmt = $this->instance->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        return $count > 0; // Returns true if email exists, false otherwise
    }
}
?>
