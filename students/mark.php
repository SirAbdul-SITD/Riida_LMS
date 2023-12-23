<?php
require("../settings.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['objectives'])) {
        // Get assessment ID from POST data
        $id = $_POST['id'];

        // Assuming your JSON data is stored in a separate file
        $query = "SELECT * FROM assessments WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $assessments = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if assessment data is found
        if (!$assessments) {
            // Handle the case where assessment data is not found
            // You can redirect or display an error message
            die('Assessment not found.');
        }

        // Decode JSON data
        $questionsData = json_decode($assessments['questions'], true);

        // Extract correct answers from the database
        $correctAnswers = [];
        foreach ($questionsData['ObjectiveAnswers'] as $answerSet) {
            $correctAnswer = $answerSet['Answers'][0];

            // Iterate through each question and find the correct answer
            foreach ($questionsData['ObjectiveQuestions'] as $questionIndex => $question) {
                $optionIndex = array_search($correctAnswer, $question['Options']);
                if ($optionIndex !== false) {
                    // Add 1 to get the question number (since question numbers start from 1)
                    $correctAnswers[$questionIndex] = $optionIndex + 1;
                    break; // Break out of the loop once the correct answer is found for this question
                }
            }
        }

        // Function to mark objective questions
        function markObjectiveQuestions($answers, $correctAnswers)
        {
            $score = 0;
            foreach ($answers as $index => $selectedOption) {
                if ($selectedOption == $correctAnswers[$index]) {
                    $score++;
                }
            }

            return $score;
        }

        // Objective questions answers
        $objectiveAnswers = [];

        foreach ($questionsData['ObjectiveQuestions'] as $index => $question) {
            $questionIndex = $index + 1;
            $inputName = 'objectiveQuestion' . $questionIndex;

            // Check if the answer is submitted
            if (isset($_POST[$inputName])) {
                $objectiveAnswers[$index] = (int) $_POST[$inputName];
            } else {
                // Handle unanswered questions
                $objectiveAnswers[$index] = 0;
            }
        }

        // Mark objective questions
        $objectiveScore = markObjectiveQuestions($objectiveAnswers, $correctAnswers);

                            // Process and store essay answers
                    // processEssayQuestions($essayAnswers);

                            // Display or log the results as needed
                    // Convert JSON object to plain text without parentheses
                    // echo "Objective Questions Score: $objectiveScore\n";
                    // echo "\n";
                    // echo "Objective total number: " . count($questionsData['ObjectiveQuestions']);
                    // echo "\n";

        $response = ['success' => true, 'response' => 'success', 'message' => "Homework Submitted Successfully.\n Objective Scores: $objectiveScore. Essay Scores: 0"];
        echo json_encode($response);

    }


















    //     if (isset($_POST['objectives'])) {
//     // Get assessment ID from POST data
//     $id = $_POST['id'];

    //     // Fetch assessment data from the database
//     $query = "SELECT * FROM assessments WHERE id = :id";
//     $stmt = $pdo->prepare($query);
//     $stmt->bindParam(':id', $id, PDO::PARAM_STR);
//     $stmt->execute();
//     $assessments = $stmt->fetch(PDO::FETCH_ASSOC);

    //     // Check if assessment data is found
//     if (!$assessments) {
//         // Handle the case where assessment data is not found
//         // You can redirect or display an error message
//         die('Assessment not found.');
//     }

    //     // Decode JSON data
//     $questionsData = json_decode($assessments['questions'], true);

    //     // Function to mark objective questions
//     function markObjectiveQuestions($answers, $correctAnswers)
//     {
//         $score = 0;
//         foreach ($answers as $questionNumber => $selectedOption) {
//             $correctAnswer = $correctAnswers[$questionNumber - 1];
//             if ($selectedOption == $correctAnswer) {
//                 $score++;
//             }
//         }

    //         return $score;
//     }

    //     // Objective questions answers
//     $objectiveAnswers = [];

    //     // Iterate through the $_POST data
//     foreach ($_POST as $key => $value) {
//         // Check if the key is an objective question
//         if (strpos($key, 'objectiveQuestion') === 0) {
//             // Extract question number from the key
//             $questionNumber = filter_var($key, FILTER_SANITIZE_NUMBER_INT);

    //             // Add user's answer to the array
//             $objectiveAnswers[$questionNumber] = $value;
//         }
//     }

    //     // Mark objective questions
//     $correctAnswers = [1, 1, 1, 1]; // Define correct answers for the assessment
//     $objectiveScore = markObjectiveQuestions($objectiveAnswers, $correctAnswers);

    //     // Process and store essay answers
//     // processEssayQuestions($essayAnswers);

    //     // Display or log the results as needed
//     // Convert JSON object to plain text without parentheses
//     // echo "Objective Questions Score: $objectiveScore\n";
//     // echo "\n";
//     // echo "Objective total number: " . count($questionsData['ObjectiveQuestions']);
//     // echo "\n";

    //     $response = ['success' => true, 'response' => 'success', 'results' => $objectiveScore, 'message' => "Homework Submitted Successfully, Check back by for results"];
//     echo json_encode($response);
// }


    if (isset($_POST['essay'])) {

        // Function to process essay questions
        // function processEssayQuestions($essayAnswers) {
        //     // Implement your logic to process and store essay answers here
        //     // For example, you can store them in a database or a file
        //     // $essayAnswers contains an array with the submitted essay answers
        // }

        // Essay questions answers
        // $essayAnswers = [];

        // foreach ($questionsData['EssayQuestions'] as $index => $question) {
        //     $questionIndex = $index + 1;
        //     $inputName = 'essay_question' . $questionIndex;

        //     // Check if the answer is submitted
        //     if (isset($_POST[$inputName])) {
        //         $essayAnswers[$index] = $_GET[$inputName];
        //     } else {
        //         // Handle unanswered questions
        //         $essayAnswers[$index] = '';
        //     }
        // }
        // echo "Essay Questions Processed and Stored.\n";
    }
}
?>