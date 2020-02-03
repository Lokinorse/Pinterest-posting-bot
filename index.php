<?php
// You may need to amend this path to locate Composer's autoloader
require('vendor/autoload.php'); 
require_once('googleSpreadsheetsSettings.php');

use seregazhuk\PinterestBot\Factories\PinterestBot;


$bot = PinterestBot::create();
// Login
$bot->auth->login('demonictype@gmail.com', 'lok1norse');

// Get lists of your boards
$boards = $bot->boards->forUser('demonictype');
/* function ifArray ($array){
    if(gettype($array)=="array"){   
        foreach($array as $item){
            if(gettype($item)=="array"){
                return ifArray($item);
            } else {
                echo $item . "<br/>";
            }
        }
    } else {
        echo $array . "<br/>";
    }
}
ifArray($boards); */
// Create a pin
$bot->pins->create('https://ngsochi.com/images/2019/10/leopard_001.jpg', $boards[1]['id'], 'Pin description');

function postPinsFromFile($url, $certainBoard, $description){
    //НЕ ЗАБЫТЬ ПОСТАВИТЬ ТАЙМЕР ДЛЯ КАЖДОГО ПОСТА
    $bot->pins->create($url, $certainBoard, $description);
}

