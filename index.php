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
// Create a pin

/*     $bot->pins->create('https://www.dw.com/image/44504125_303.jpg', $boards[1]['id'], 'Pin description'); */
function postPinsFromFile($url, $description){
    global $bot;
    global $boards;
    sleep(61); //Задержка необходима во избежание бана
    $bot->pins->create($url, $boards[1]['id'], $description);


}

foreach ($values as $row) {

    postPinsFromFile($row[0], $row[1]);


}