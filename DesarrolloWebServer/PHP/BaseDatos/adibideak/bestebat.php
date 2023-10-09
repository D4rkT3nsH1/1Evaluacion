<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beste bat</title>
    <style>
        body{
            background-color: rgb(145, 209, 255);
            margin:0;
            padding:20px;
        }
        header{
            display:flex;
            justify-content: space-between;
        }
        form{
            padding:15px
        }
        textarea{
            width: 100%;
            min-height: 300px;
        }
    </style>
</head>
<body>
    <header>
        <h3>$_SESSION: <small><?php echo session_id(); ?>  <a href="../">Hasiera</a></small></h3>
    </header>
    <textarea><?php echo print_r($_SESSION,true); ?></textarea>
</body>
</html>