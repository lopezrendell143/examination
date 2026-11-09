<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

require_once '../Class/Exam.php';
$exam = new Exam();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $op = $_POST['op'] ?? '';

    if ($op == 'create') {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $time_limit_minutes = $_POST['time_limit_minutes'] ?? 0;
        $start_time = $_POST['start_time'] ?? '';
        $end_time = date('Y-m-d H:i:s', strtotime($start_time . ' + 7 days')); 
        $course = $_POST['course'] ?? 'All Courses';
        $year_level = $_POST['year_level'] ?? 'All Year Levels';

        $result = $exam->createExam($title, $description, $time_limit_minutes, $start_time, $end_time, $course, $year_level);
        echo $result;
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $op = $_GET['op'] ?? '';
    if ($op == 'displayall' || $op == 'available' || $op == '') {
        echo $exam->displayAllExams();
    }
}
?>