<?php

require_once ('sasha-lib.php');
$requestParams = getRequestParams($argv);
$balance = $requestParams['name'];
$requestParams['balance'] = $balance;
unset($balance);
unset($requestParams['name']);





if ($requestParams["email"] === null) {
    writeline("Ви не ввели емейл, спробуйте ще раз");
    exit();
}
if ($requestParams["balance"] === null) {
    writeline("Ви не ввели баланс, спробуйте ще раз");
    exit();
}

$foo = is_numeric($requestParams["balance"]);
if (!$foo) {
    writeline("Ви ввели не числове значення балансу");
}



$user = getUser($requestParams["email"]);
if ($user) {
    $name = $user["name"];
    $updateUserInfo = ["email" => $requestParams["email"], "name" => $name, "balance" => $requestParams["balance"]];
    updateUser($updateUserInfo);
    writeline("Збереження пройшло успішно!");
} else {
    writeline("Ви ввели не існуючий емейл, спробуйте ще раз");
}












