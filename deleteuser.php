<?php

require_once ('sasha-lib.php');
$requestParams = getRequestParams($argv);

$email = $requestParams["email"];
if ($email === null) {
    writeline("введіть будь ласка значення");
    exit();
}
$user = getUser($requestParams["email"]);
if ($user === null) {
    writeline("Користувача з такие емейлом не існує");
    exit();
}

deleteUserByEmail($email);




