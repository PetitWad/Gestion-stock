<?php
$bd_dns ='mysql:host=localhost;dbname=u671139698_dressupstock';
$bd_username = 'u671139698_dressup';
$bd_pass = '1234@Dressup';
$bd_options =[
    PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES =>false
];
