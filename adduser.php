<?php

require_once ('sasha-lib.php');
$requestParams = getRequestParams($argv);






























$user = getUser($requestParams["email"]);
if ($user) {
    writeline("Потрібно ввести інший email, такий користувач вже існує");
} else {
    saveUser($requestParams);
    writeline("Збереження пройшло успішно");
}



