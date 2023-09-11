<?php

session_start();

$db = new PDO('mysql:host=db; dbname=lower_deck_charaters', 'root', 'password');

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h2>Characters</h2>

</body>
</html>