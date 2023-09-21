<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<select name="select">

    <?php
        $a = 10;
        for ($i=1; $i <= $a; $i++) { 
            echo "<option value=",$i,"> $i </option>";
        }
    ?>

</select>



</body>
</html>

