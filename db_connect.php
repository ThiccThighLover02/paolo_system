<?php
//Nagcreate lang ako ng new file para hindi mo na idedeclare ung mga variables ulit haha
    $server = "localhost";
    $username = "root";
    $password = "MilkTeaLover02040402";
    $dbname = "paolo_system"; //Palitan mo nalang to hahah saka ung password
    $conn = new mysqli($server, $username, $password, $dbname);

// dito din ako magseset ng timezone para everytime na kukunin mo ung date and time dito mo nalang kunin sa file na to
date_default_timezone_set("Asia/Manila");
?>