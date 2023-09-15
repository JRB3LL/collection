<?php

require_once 'src/CharacterData.php';

$db = new PDO('mysql:host=db; dbname=lower_deck_charaters', 'root', 'password');

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$characterId = $_GET['id'] ?? false;

$model = new CharacterData($db);

$deleted = $model->softDelete($characterId);

if ($deleted === true) {
    header('Location: DisplayAllCharacters.php'); 
    
}