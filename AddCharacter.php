<?php

require_once 'src/CharacterData.php';

$db = new PDO('mysql:host=db; dbname=lower_deck_charaters', 'root', 'password');

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$characterName = $_POST['name'] ?? false;
$characterSpecies = $_POST['species'] ?? false;
$characterRank = $_POST['rank'] ?? false;
$characterImage = $_POST['image'] ?? false;


if (
    $characterName &&
    $characterSpecies &&
    $characterRank &&
    $characterImage
) {
    $valid = true;

    if (strlen($characterName) > 150) {
        $nameError = "<br />Field exceeds maximum length 150.<br />";
        $valid = false;
    }

    if (strlen($characterSpecies) > 150) {
        $speciesError = "<br />Field exceeds maximum length 150.<br />";
        $valid = false;
    }

    if (strlen($characterRank) > 150) {
        $rankError = "<br />Field exceeds maximum length 150.<br />";
        $valid = false;
    }

    if (strlen($characterImage) > 1000) {
        $imageError = "<br />Field exceeds maximum length 1000.<br />";
        $vaild = false;
    }

    if ($valid) {
        $characterDataQuery = new CharacterData($db);
        $characterSaved = $characterDataQuery->sendCharacterData($characterName, $characterSpecies, $characterRank, $characterImage);
        if ($characterSaved === true) {
            header('Location: DisplayAllCharacters.php');
        }
    }
} else {
    if (isset($_POST['name'])) {
        $inputError = "Character details are not complete, Please try again.<br /><br />";
    }
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

    <h2>Add Character</h2>

    <a href="index.php">Back</a><br /><br />

    <form method="POST">

        <?php
        if (isset($inputError)) {
            echo $inputError;
        }
        ?>

        <label for="name">Name</label>
        <?php
        if (isset($nameError)) {
            echo $nameError;
        }
        ?>
        <input type="text" name="name" id="name" /><br /><br />

        <label for="species">Species</label>
        <?php
        if (isset($speciesError)) {
            echo $speciesError;
        }
        ?>
        <input type="text" name="species" id="species" /><br /><br />

        <label for="rank">Rank</label>
        <?php
        if (isset($rankError)) {
            echo $rankError;
        }
        ?>
        <input type="text" name="rank" id="rank" /><br /><br />

        <label for="image">Image URL</label>
        <?php
        if (isset($imageError)) {
            echo $imageError;
        }
        ?>
        <input type="text" name="image" id="image" /><br /><br />

        <input type="submit" />

    </form>

</body>

</html>