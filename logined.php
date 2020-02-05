<html>
<button class="btn btn-primary" onclick="location.href='index.php'">Перейти назад для работы с другим аккаунтом</button>
</html>
<?php
require('vendor/autoload.php'); 
require_once('googleSpreadsheetsSettings.php');
require_once('dbCredentials.php');
use seregazhuk\PinterestBot\Factories\PinterestBot;


$nickname = null;
if (!empty($_POST['pinterest_nickname'])){
    $nickname = $_POST['pinterest_nickname'];
}
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



function makeQuery($sql, $pin_description, $picture, $affilate_link, $posting_time){
/*     global $sql; */
	$link = mysqli_connect(DBCredentials::$host, DBCredentials::$user, DBCredentials::$password, DBCredentials::$database)   
    or die("Ошибка " . mysqli_error($link));	
/* 	$sql = "INSERT INTO pins (pin_description, picture, affilate_link, posting_time) VALUES ('$pin_description', '$picture', '$affilate_link', '$posting_time')"; */
	$result = mysqli_query($link, $sql)  or die("Could not connect database " .mysqli_error($link)); //return boolean
	$data = array(
	$result ? 'true' : 'false'
	);
	echo json_encode($data);
}




if($login!==null && $password!==null){
    $bot = PinterestBot::create();
    $bot->auth->login($login, $password);
    // Get lists of your boards
    $boards = $bot->boards->forUser('demonictype');


    // Post pins from the file
/*     function postPinsFromFile($index, $description, $affilate)
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
    }; */
    function postPinsFromFileToDB($index, $description, $affilate, $posting_time)
    {   
        global $login;
        global $password;
        global $bot;
        global $boards;
        global $files1;
        global $normpath;
        global $sleepingTime;
        global $boardNumber;
        global $sql;
        global $nickname;
        $board = $boards[$boardNumber]['id'];
        $path = $normpath . $files1[$index];
        $sql = "INSERT INTO pins (description, picture, affilate_link, posting_time, pinterest_login, pinterest_password, board, status, nickname)
                VALUES ('$description', '$path', '$affilate', '$posting_time', '$login', '$password', '$board', 0, '$nickname')";
        makeQuery($sql, $description,  $path, $affilate, $posting_time);
        echo "<br/>" . 'Pin was sucessfully sent to DB' . "<br/>";
    };

    $index = -1;
    foreach ($values as $row) 
    {
        $index++;
        postPinsFromFileToDB($index, $row[1], $row[2], $row[3]);
    } 
} //if login&&password exist
?>