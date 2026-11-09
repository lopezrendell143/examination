<?php
require_once 'Database.php';

class Exam extends Database {

    public function createExam($title, $description, $time_limit_minutes, $start_time, $end_time, $course, $year_level) {
        $stmt = $this->conn->prepare("INSERT INTO exams (title, description, time_limit_minutes, start_time, end_time, course, year_level) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissss", $title, $description, $time_limit_minutes, $start_time, $end_time, $course, $year_level);

        if($stmt->execute()) {
            return json_encode(['success' => true, 'message' => 'Exam created successfully']);
        }
        return json_encode(['success' => false, 'message' => 'Failed to create exam']);
    }

    public function displayAllExams() {
        $result = $this->conn->query("SELECT * FROM exams ORDER BY created_at DESC");
        $exams = [];
        while($row = $result->fetch_assoc()) {
            $exams[] = $row;
        }
        return json_encode($exams);
    }
}
?>