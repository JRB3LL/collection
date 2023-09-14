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
            "SELECT `name`, `species`, `rank`, `image` 
                FROM `characters`;"
        );

        $characterDataQuery->execute();

        $data = $characterDataQuery->fetchAll();

        foreach ($data as $characterData)

            $characters[] = new Character(
                $characterData['name'],
                $characterData['species'],
                $characterData['rank'],
                $characterData['image']
            );

        return $characters;
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
}
