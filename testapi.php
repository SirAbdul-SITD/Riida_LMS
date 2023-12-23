<?php

// Hugging Face API endpoint
$apiEndpoint = 'https://api-inference.huggingface.co/models/HuggingFaceH4/zephyr-7b-beta';

// Input text
$inputText = 'explain to a dummy what linear algebra is, its use, and also include if it has any category or subtopic all in details with 5 examples for ech subtopic, let your explanation be lengthy';

// Authorization Bearer token
$apiKey = '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';

// Build the cURL command
$curlCommand = 'curl ' . $apiEndpoint . ' -X POST -d \'{"inputs": "' . $inputText . '"}\' -H "Content-Type: application/json" -H "Authorization: Bearer ' . $apiKey . '"';

// Execute the cURL command and capture the output
exec($curlCommand, $output, $returnCode);

// Check if the command was successful
if ($returnCode === 0) {
    // Decode the JSON response
    $response = json_decode(implode('', $output), true);

    // Echo the response
    echo "Generated Response:\n";
    echo print_r($response, true);
} else {
    // Echo an error message
    echo "Error executing cURL command.\n";
    echo "Return code: $returnCode\n";
}

?>
