<?php
require('vendor/autoload.php'); 
require_once('googleSpreadsheetsSettings.php');
require_once('dbCredentials.php');
use seregazhuk\PinterestBot\Factories\PinterestBot;


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


function postPins($index, $description, $affilate, $nickname, $login, $password, $board)
    {
        global $files1;
        global $normpath;

        $bot = PinterestBot::create();
        $bot->auth->login($login, $password);
        // Get lists of your boards
        $boards = $bot->boards->forUser($nickname);


        $path = $normpath . $files1[$index];
        sleep(21); //delay is required to avoid ban
        $bot->pins->create($path, $board, $description, $affilate);
        echo "<br/>" . 'Pin was sucessfully uploaded' . "<br/>";
    }; 


$link = mysqli_connect(DBCredentials::$host, DBCredentials::$user, DBCredentials::$password, DBCredentials::$database)   
or die("Ошибка " . mysqli_error($link));	
$sql =  "SELECT * FROM pins WHERE status = 0 AND posting_time<NOW()";
$result = mysqli_query($link, $sql)  or die("Could not connect database " .mysqli_error($link)); //return boolean

$index = -1;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $index++;
        postPins(
        $index,
        $row["description"], 
        $row["affilate_link"], 
        $row["nickname"], 
        $row["pinterest_login"], 
        $row["pinterest_password"],
        $row["board"]);
        echo "description: " . $row["description"]. " - picture: " . $row["picture"] . "<br>";

    }
} else {
    echo "0 results";
}


