<?php

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

    if (strlen($characterName) > 150) {
        echo "Field exceeds maximum length 150.";
    } else {
        return true;
    }

    if (strlen($characterSpecies) > 150) {
        echo "Field exceeds maximum length 150.";
    } else {
        return true;
    }

    if (strlen($characterRank) > 150) {
        echo "Field exceeds maximum length 150.";
    } else {
        return true;
    }

    if (strlen($characterImage) > 10000) {
        echo "Field exceeds maximum length 10000.";
    } else {
        return true;
    }

    $characterDataQuery = $db->prepare(
        "INSERT INTO `characters`
        (`name`,`species`, `rank`, `image`)
        VALUE (:name, :species, :rank, :image)"
    );

    $characterDataQuery->bindParam('name', $characterName);
    $characterDataQuery->bindParam('species', $characterSpecies);
    $characterDataQuery->bindParam('rank', $characterRank);
    $characterDataQuery->bindParam('image', $characterImage);

    $characterSaved = $characterDataQuery->execute();

    if ($characterSaved === true) {
        header('Location: DisplayAllCharacters.php');
    } else {
        echo "Character details are not complete, Please try again.";
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

    <form method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" /></br>
        <label for="species">Species</label>
        <input type="text" name="species" id="species" /></br>
        <label for="rank">Rank</label>
        <input type="text" name="rank" id="rank" /></br>
        <label for="image">Image URL</label>
        <input type="text" name="image" id="image" /></br>
        <input type="submit" />
        <a href="index.php">Back</a>
    </form>

</body>

</html>