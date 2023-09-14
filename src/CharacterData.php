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
            "SELECT `name`, `species`, `rank`, `image`, `deleted` 
                FROM `characters` WHERE `deleted` = 0;"
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
}
