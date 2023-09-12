<?php

session_start();

$db = new PDO('mysql:host=db; dbname=lower_deck_charaters', 'root', 'password');

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$characterDataQuery = $db->prepare(
    "SELECT `name`, `species`, `rank`, `image` 
        FROM `characters`;"
);

$characterDataQuery->execute();

$data = $characterDataQuery->fetchAll();

foreach ($data as $characterData) {
    echo '<div>';
    echo '<img src="' . $characterData['image'] . '" width="120" height="200">';
    echo '<li>' . $characterData['name'] . '</li>';
    echo '<li>' . $characterData['species'] . '</li>';
    echo '<li>' . $characterData['rank'] . '</li>';
    echo '</div>';
}
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