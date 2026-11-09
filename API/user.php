<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../Class/User.php';
$user = new User();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $op = $_POST['op'] ?? '';
    
    if($op == 'add'){
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $pass = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'student';
        $course = $_POST['course'] ?? null;
        
        echo $user->add($name, $email, $pass, $role, $course);
    }
    else if($op == 'login'){
        $email = $_POST['email'] ?? '';
        $pass = $_POST['password'] ?? '';
        
        echo $user->login($email, $pass);
    }
}
?>