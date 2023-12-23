<?php
$jsonData = '{
    "ObjectiveQuestions": [
        {"Question": "What is poetry?", "Options": ["A form of literature that uses language in a unique and creative way", " A type of narrative essay", " A form of writing that tells a story", " A type of writing that focuses on events in chronological order"]},
        {"Question": "What are some common literary devices used in poetry?", "Options": ["Simile, metaphor, personification, and imagery", " Alliteration, onomatopoeia, and rhyme", " Sonnet, haiku, and free verse", " Love, nature, and beauty"]},
        {"Question": "Which sound device is characterized by the repetition of the initial consonant sound in a series of words?", "Options": ["Alliteration", " Onomatopoeia", " Rhyme", " Imagery"]},
        {"Question": "What is the purpose of a narrative essay?", "Options": ["To entertain, engage, or inform the reader through storytelling techniques", " To compare and contrast different ideas or concepts", " To provide a descriptive analysis of a poem", " To express thoughts, emotions, and ideas creatively"]},
        {"Question": "What is the climax in a narrative essay?", "Options": ["The turning point of the story", " The resolution or closure", " The introduction of tension and conflict", " The ending that leaves a lasting impression"]}
    ],
    "EssayQuestions": [
        {"Question": "Discuss the key features of poetry, including its use of literary devices, poetic forms, and sound devices. Provide examples to support your answer."},
        {"Question": "Explain the importance of storytelling techniques in a narrative essay. How do vivid descriptions, engaging dialogue, and a strong narrative structure contribute to creating a compelling narrative? Support your answer with examples."},
        {"Question": "Choose a specific poem that you find meaningful or impactful. Discuss the themes explored in the poem and how the poet uses compressed and metaphorical language to convey complex ideas and emotions. Analyze the poem\'s structure and any sound devices used to enhance its rhythm and musicality."}
    ]
}';



// Decode JSON data
$data = json_decode($jsonData, true);

// Function to convert JSON data to plain text
function convertToPlainText($data) {
    $output = '';

    foreach ($data as $section => $questions) {
        $output .= "$section:\n";
        foreach ($questions as $question) {
            $output .= "  " . $question['Question'] . "\n";
            if (isset($question['Options'])) {
                foreach ($question['Options'] as $index => $option) {
                    $output .= "    " . chr(97 + $index) . ") $option\n";
                }
            }
        }
    }

    return $output;
}

// Convert JSON data to plain text
$plainText = convertToPlainText($data);

// Output the result
echo $plainText;
?>
