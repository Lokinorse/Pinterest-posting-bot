<?php
require('vendor/autoload.php'); 
require_once('googleSpreadsheetsSettings.php');

use seregazhuk\PinterestBot\Factories\PinterestBot;

$bot = PinterestBot::create();
$bot->auth->login('demonictype@gmail.com', 'lok1norse');
// Get lists of your boards
$boards = $bot->boards->forUser('demonictype');

// Post pins from the file
function postPinsFromFile($url, $description)
{
    global $bot;
    global $boards;
    sleep(61); //delay is required to avoid ban
    $bot->pins->create($url, $boards[1]['id'], $description);
}

foreach ($values as $row) 
{
    postPinsFromFile($row[0], $row[1]);
}