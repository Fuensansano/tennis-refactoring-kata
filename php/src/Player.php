<?php

namespace TennisGame;


class Player
{

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name()
    {
        return $this->name;
    }

    public function score()
    {
        return 0;
    }
}