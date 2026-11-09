<?php
require_once 'Database.php';

class Question extends Database {

    public function addQuestion($exam_id, $question_text, $opt_a, $opt_b, $opt_c, $opt_d, $correct_answer) {
        $stmt = $this->conn->prepare("INSERT INTO questions (exam_id, question_text, option_a, option_b, option_c, option_d, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $exam_id, $question_text, $opt_a, $opt_b, $opt_c, $opt_d, $correct_answer);

        if($stmt->execute()) {
            return json_encode(['success' => true, 'message' => 'Question added successfully']);
        }
        return json_encode(['success' => false, 'message' => 'Failed to add question']);
    }

    public function getQuestionsByExam($exam_id) {
        $stmt = $this->conn->prepare("SELECT * FROM questions WHERE exam_id = ?");
        $stmt->bind_param("i", $exam_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $questions = [];
        while($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }
        return json_encode($questions);
    }
}
?>