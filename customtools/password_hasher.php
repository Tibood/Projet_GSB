<?php 

$file = new SplFileObject("clear_passwords.txt");

// Loop until we reach the end of the file.
while (!$file->eof()) {
    // Echo one line from the file.
    echo 'Clear password : ' . $file->fgets();
    echo 'Corresponding hash : ' . password_hash($file->fgets(), PASSWORD_BCRYPT, ['cost' => 12]);
    echo "\n";
}

// Unset the file to call __destruct(), closing the file handle.
$file = null;