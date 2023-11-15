<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Create pub/media directory if not exists
    $directory = 'pub/media';
    if (!file_exists($directory)) {
        mkdir($directory, 0755, true);
    }

    // Create a new directory with the first letter of the file
    $firstLetter = strtolower(substr($file['name'], 0, 1));
    $firstLetterDirectory = "{$directory}/{$firstLetter}";

    if (!file_exists($firstLetterDirectory)) {
        mkdir($firstLetterDirectory, 0755, true);
    }

    // Create a new directory with the second character of the file
    $secondCharacter = strtolower(substr($file['name'], 1, 1));
    $secondCharacterDirectory = "{$firstLetterDirectory}/{$secondCharacter}";

    if (!file_exists($secondCharacterDirectory)) {
        mkdir($secondCharacterDirectory, 0755, true);
    }

    // Upload the file
    $originalFilename = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    // Check if the file already exists
    $newFilename = $originalFilename;
    $counter = 1;
    while (file_exists("{$secondCharacterDirectory}/{$newFilename}.{$extension}")) {
        $newFilename = $originalFilename . '-' . date('Ymd-His') . '-' . $counter;
        $counter++;
    }

    // Move the uploaded file to the destination
    move_uploaded_file($file['tmp_name'], "{$secondCharacterDirectory}/{$newFilename}.{$extension}");
}
