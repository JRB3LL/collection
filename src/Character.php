<?php

readonly class Character
{
    public int $id;
    public string $name;
    public string $species;
    public string $rank;
    public string $image;

    public function __construct(
        int $id,
        string $name,
        string $species,
        string $rank,
        string $image
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->species = $species;
        $this->rank = $rank;
        $this->image = $image;
    }
}
