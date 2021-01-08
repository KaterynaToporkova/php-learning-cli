<?php

require_once ('sasha-lib.php');
$requestParams = getRequestParams($argv);










$info = getUser($requestParams["email"]);

if ($info == true) {
    writeline("email: " . $info["email"]);
    writeline("name: " . $info["name"]);
    writeline("balance: " . $info["balance"]);
} else {
    writeline("Ви ввели не існуючий емейл, спробуйте ще раз" . PHP_EOL);
}

