<?php

readonly class Character
{
    public string $name;
    public string $species;
    public string $rank;
    public string $image;

    public function __construct(
        string $name,
        string $species,
        string $rank,
        string $image
    ) {
        $this->name = $name;
        $this->species = $species;
        $this->rank = $rank;
        $this->image = $image;
    }
}
