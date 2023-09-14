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
        $nameError = "Field exceeds maximum length 150.";
        $valid = false; // Repeat this change for each of the validation checks
    }

    if (strlen($characterSpecies) > 150) {
        $speciesError = "Field exceeds maximum length 150.";
        $valid = false;
    }

    if (strlen($characterRank) > 150) {
        $rankError = "Field exceeds maximum length 150.";
        $valid = false;
    }

    if (strlen($characterImage) > 10000) {
        $imageError = "Field exceeds maximum length 10000.";
        $vaild = false;
    }

    $characterDataQuery = new CharacterData($db);

    $characterSaved = $characterDataQuery->sendCharacterData($characterName, $characterSpecies, $characterRank, $characterImage);

    if ($characterSaved === true) {
        header('Location: DisplayAllCharacters.php');
    } else {
        $inputError = "Character details are not complete, Please try again.";
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

    <a href="index.php">Back</a>

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
        <input type="text" name="name" id="name" /></br>

        <label for="species">Species</label>
        <?php
        if (isset($speciesError)) {
            echo $speciesError;
        }
        ?>
        <input type="text" name="species" id="species" /></br>

        <label for="rank">Rank</label>
        <?php
        if (isset($rankError)) {
            echo $rankError;
        }
        ?>
        <input type="text" name="rank" id="rank" /></br>

        <label for="image">Image URL</label>
        <?php
        if (isset($imageError)) {
            echo $imageError;
        }
        ?>
        <input type="text" name="image" id="image" /></br>

        <input type="submit" />

        <a href="index.php">Back</a>
    </form>

</body>

</html>