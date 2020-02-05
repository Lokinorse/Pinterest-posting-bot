<html>
<button class="btn btn-primary" onclick="location.href='index.php'">Перейти назад для работы с другим аккаунтом</button>
</html>
<?php
require('vendor/autoload.php'); 
require_once('googleSpreadsheetsSettings.php');
use seregazhuk\PinterestBot\Factories\PinterestBot;

$login=null;
if (!empty($_POST['pinterest_login'])){
    $login = $_POST['pinterest_login'];
} 
$password=null;
if (!empty($_POST['pinterest_password'])){
    $password = $_POST['pinterest_password'];
} 
$boardNumber = 0;
if(!empty($_POST['board_number'])){
    $boardNumber = $_POST['board_number']-1;
} 

//Folder with pics to be posted
$dir = 'pinsToBePosted';
$files = scandir($dir);
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}
function improvedScandir($item){
    if(!startsWith($item, '.')){
        return $item;
    }
}
$files1 = array_values(array_filter($files, "improvedScandir"));
$normpath = $dir . '/';
if($login!==null && $password!==null){
    $bot = PinterestBot::create();
    $bot->auth->login($login, $password);
    // Get lists of your boards
    $boards = $bot->boards->forUser('demonictype');


    // Post pins from the file
    function postPinsFromFile($index, $description, $affilate)
    {
        global $bot;
        global $boards;
        global $files1;
        global $normpath;
        global $sleepingTime;
        global $boardNumber;

        $path = $normpath . $files1[$index];
        sleep(19); //delay is required to avoid ban
        $bot->pins->create($path, $boards[$boardNumber]['id'], $description, $affilate);
        echo "<br/>" . 'Pin was sucessfully uploaded' . "<br/>";
    };

    $index = -1;
    foreach ($values as $row) 
    {
        $index++;
        postPinsFromFile($index, $row[1], $row[2]);
    } 
} //if login&&password exist
?>