<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/stylesheet.css">
</head>
<body>
    <form id='pinterest_account' action="logined.php" method="post">
        <input type='text' id = 'pinterest_login' name = 'pinterest_login' placeholder = 'pinterest login'>
        <input type='text' id = 'pinterest_password' name = 'pinterest_password' placeholder = 'pinterest password'>
        <label  for="boardselector">Выберите доску</label>
        <input type="number" id="boardselector" name = 'board_number' min="1" max="1000">
        <button class="btn btn-primary" >Запустить бота для этого аккаунта</button>
    </form>
</body>

</html>