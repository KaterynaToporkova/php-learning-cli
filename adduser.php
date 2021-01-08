<?php

require_once ('sasha-lib.php');
$requestParams = getRequestParams($argv);


































#####################################
### є функція saveUser($user) приймає масив користувача у форматі 'email', 'name', 'balance'
### $requestParams містить в собі передані цій команді параметри
### є функція getUser(string $email)
#   Вхідний параметер це емейл користувача, а повертає функція масив заданого користувача
# або null у випадку якшо такого немає

/**
 * 1. Перевірити чи користувач існую
 *    1.1 Взяти користувача по введеному емейлу
 *    1.2 Якшо такий користувач існує, видати на екран текст, що потрібно ввести інший імейл
 *    1.3 Якшо не існує
 * 2. Зберегти коритувача і вивести на екран текс, що збереження пройшло успішно
 */

//$user = ["email" => "Kateryna@gmail.com", "name" => "Katya", "balance" => 3];

//saveUser($user);
//saveUser($user1);

//print_r(getUser("KarinaPetrovna@gmail.com"));
//print_r($requestParams);
//$requestParams;
//print_r(saveUser($requestParams));


$user = getUser($requestParams["email"]);
if ($user == true) {
    writeline("Потрібно ввести інший email, такий користувач вже існує");
} else {
    saveUser($requestParams);
    writeline("Збереження пройшло успішно");
}



