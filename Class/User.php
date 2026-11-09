<?php
require_once 'Database.php';

class User extends Database {

    public function add($name, $email, $password, $role, $course = null) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // If teacher, course can be null or empty
        $assignedCourse = ($role == 'teacher') ? null : ($course ?? 'All Courses');

        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, role, course) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $hashedPassword, $role, $assignedCourse);
        
        if($stmt->execute()) {
            return json_encode(['success' => true, 'message' => 'User created successfully']);
        }
        return json_encode(['success' => false, 'message' => 'Failed to create user']);
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])) {
                unset($row['password']);
                return json_encode([
                    'success' => true, 
                    'message' => 'Login successful',
                    'user' => $row
                ]);
            }
        }
        return json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
}
?>