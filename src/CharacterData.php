<?php

session_start();

require_once 'src/Character.php';

class CharacterData
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getCharacterData()
    {
        $characterDataQuery = $this->db->prepare(
            "SELECT `id`, `name`, `species`, `rank`, `image`, `deleted` 
                FROM `characters` WHERE `deleted` = 0;"
        );

        $characterDataQuery->execute();

        $data = $characterDataQuery->fetchAll();

        foreach ($data as $characterData)

            $characters[] = new Character(
                $characterData['id'],
                $characterData['name'],
                $characterData['species'],
                $characterData['rank'],
                $characterData['image']
            );

        return $characters;
    }

    public function getDeletedCharacterData()
    {
        $deletedCharacterDataQuery = $this->db->prepare(
            "SELECT `id`, `name`, `species`, `rank`, `image`, `deleted` 
                FROM `characters` WHERE `deleted` = 1;"
        );

        $deletedCharacterDataQuery->execute();

        $data = $deletedCharacterDataQuery->fetchAll();

        foreach ($data as $characterData)

            $deletedCharacters[] = new Character(
                $characterData['id'],
                $characterData['name'],
                $characterData['species'],
                $characterData['rank'],
                $characterData['image']
            );

        return $deletedCharacters;
    }

    public function sendCharacterData($characterName, $characterSpecies, $characterRank, $characterImage)
    {
        $characterDataQuery = $this->db->prepare(
            "INSERT INTO `characters`
            (`name`,`species`, `rank`, `image`)
            VALUE (:name, :species, :rank, :image)"
        );

        $characterDataQuery->bindParam('name', $characterName);
        $characterDataQuery->bindParam('species', $characterSpecies);
        $characterDataQuery->bindParam('rank', $characterRank);
        $characterDataQuery->bindParam('image', $characterImage);

        return $characterDataQuery->execute();
    }

    public function softDelete($id) {
        $updateData = "UPDATE characters SET deleted = 1 WHERE id = :id";
        $updatedInput = $this->db->prepare($updateData);
        $updatedInput->bindParam("id", $id);

        if ($updatedInput->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
