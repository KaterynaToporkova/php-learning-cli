<?php

require_once ('sasha-lib.php');
$requestParams = getRequestParams($argv);








$allInfo = getUsers();

foreach ($allInfo as $key => $info) {
    writeline($key . " email: " . $info["email"]);
    writeline("name: " . $info["name"]);
    writeline("balance: " . $info["balance"]);
    if ($info["balance"] < 100) {
        writeline("Статус: не багатий" . PHP_EOL);
    } else {
        writeline("Статус: багатий" . PHP_EOL);
    }
}






