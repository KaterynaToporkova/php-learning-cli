<?php

function writeline(string $string = "") {
    echo $string . PHP_EOL;
}

function getRequestParams($argv)
{
    if (isset($argv[4])) {
        throw new Exception("Too much parameters given to the command");
    }

    $email = isset($argv[1]) ? $argv[1] : null;
    $name = isset($argv[2]) ? $argv[2] : null;
    $balance = isset($argv[3]) ? $argv[3] : null;

    $params = [
        'email' => $email,
        'name' => $name,
        'balance' => $balance,
    ];

    return $params;
}

function checkEmailIsUnique($email)
{
    $fp = fopen("users.txt", "r");
    // Convert each line into the local $data variable
    while (($data = fgetcsv($fp, 1000)) !== FALSE) {
        if ($data[0] == $email) {
            throw new Exception("Couldn't save into table user. Email is not unique.");
        }
    }
}

function saveUser(array $user)
{
    $insertArray = [];
    $insertArray['email'] = isset($user['email']) ? $user['email'] : null;
    $insertArray['name'] = isset($user['name']) ? $user['name'] : null;
    $insertArray['balance'] = isset($user['balance']) ? $user['balance'] : null;

    if (!isset($user['email'])) {
        throw new Exception("Couldn't save into table user. Query was: INSERT INTO users `email`, `name`, `balance` VALUES({$insertArray['email']}, {$insertArray['name']}, {$insertArray['balance']})");
    }

    checkEmailIsUnique($user['email']);

    // Open file in append mode
    $fp = fopen('users.txt', 'a');

    // Append input data to the file
    fputcsv($fp, $insertArray);

    // close the file
    fclose($fp);
}

function getUsers(): array
{
    $fp = fopen("users.txt", "r");
    $result = [];
    $i = 0;
    // Convert each line into the local $data variable
    while (($data = fgetcsv($fp, 1000)) !== FALSE) {
        $i++;
        $result[$i]['email'] = $data[0];
        $result[$i]['name'] = $data[1];
        $result[$i]['balance'] = $data[2];

    }

    return $result;
}

/**
 * Повертає масив користувача по заданому емейлу.
 * У випадку якщо не існує користувача по заданому емейлу - поверне null.
 *
 * @param string $email
 * @return array|null
 */
function getUser(string $email): ?array
{
    $fp = fopen("users.txt", "r");
    // Convert each line into the local $data variable
    while (($data = fgetcsv($fp, 1000)) !== FALSE) {
        if ($data[0] == $email) {
            $result = [];
            $result['email'] = $data[0];
            $result['name'] = $data[1];
            $result['balance'] = $data[2];
            return $result;
        }
    }

    return null;
}

function updateUser(array $user): bool
{
    $userModel = getUser($user['email']);

    if (!$userModel) {
        throw new Exception("Користувача з емейлом - {$user['email']} не існує");
    }

    $fp = fopen("users.txt", "r");
    $newData = [];
    $i = 0;

    $updated = false;

    // Convert each line into the local $data variable
    while (($data = fgetcsv($fp, 1000)) !== FALSE) {
        $i++;

        if ($data[0] == $user['email']) {
            $newData[$i]['email'] = $user['email'];
            $newData[$i]['name'] = $user['name'];
            $newData[$i]['balance'] = $user['balance'];

            $updated = true;
        } else {
            $newData[$i]['email'] = $data[0];
            $newData[$i]['name'] = $data[1];
            $newData[$i]['balance'] = $data[2];
        }
    }

    unlink("users.txt");
    file_put_contents("users.txt", '');

    foreach($newData as $newUser) {
        saveUser($newUser);
    }

    return $updated;
}

function deleteUserByEmail(string $email): void
{
    $userModel = getUser($email);

    if (!$userModel) {
        throw new Exception("Користувача з емейлом - {$email} не існує");
    }

    $fp = fopen("users.txt", "r");
    $newData = [];
    $i = 0;


    // Convert each line into the local $data variable
    while (($data = fgetcsv($fp, 1000)) !== FALSE) {
        $i++;

        if ($data[0] == $email) {
	        $i--;
	        continue;
        }

	$newData[$i]['email'] = $data[0];
	$newData[$i]['name'] = $data[1];
	$newData[$i]['balance'] = $data[2];
    }

    unlink("users.txt");
    file_put_contents("users.txt", '');

    foreach($newData as $newUser) {
        saveUser($newUser);
    }
}



