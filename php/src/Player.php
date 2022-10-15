<?php
declare(strict_types=1);

namespace TennisGame;


class Player
{

    private int $score = 0;
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
        return $this->score;
    }

    public function increaseScore()
    {
        $this->score++;
    }
}