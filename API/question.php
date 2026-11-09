<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../Class/Question.php';
$question = new Question();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $op = $_POST['op'] ?? '';
    
    if($op == 'add'){
        $exam_id = $_POST['exam_id'] ?? 0;
        $q_text = $_POST['question_text'] ?? '';
        $opt_a = $_POST['option_a'] ?? '';
        $opt_b = $_POST['option_b'] ?? '';
        $opt_c = $_POST['option_c'] ?? '';
        $opt_d = $_POST['option_d'] ?? '';
        $correct = $_POST['correct_answer'] ?? 'A';
        
        echo $question->addQuestion($exam_id, $q_text, $opt_a, $opt_b, $opt_c, $opt_d, $correct);
    }
}
else if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $op = $_GET['op'] ?? '';
    
    if($op == 'get_by_exam'){
        $exam_id = $_GET['exam_id'] ?? 0;
        echo $question->getQuestionsByExam($exam_id);
    }
}
?>