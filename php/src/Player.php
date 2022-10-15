<?php
declare(strict_types=1);

namespace TennisGame;


class Player
{

    const MIN_POINTS_TO_WIN = 4;
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

    public function increaseScore()
    {
        $this->score++;
    }

    public function isDeuce(Player $otherPlayer): bool
    {
        return $this->score === $otherPlayer->score;
    }

    public function hasAdvantageOrWin($otherPlayer)
    {
        return $this->score >= self::MIN_POINTS_TO_WIN || $otherPlayer->score >= self::MIN_POINTS_TO_WIN;
    }

    public function printableScore(): string
    {
        return match ($this->score) {
            0 => Point::LOVE->value,
            1 => Point::FIFTEEN->value,
            2 => Point::THIRTY->value,
            default => Point::FORTY->value,
        };
    }

    public function scoreDifferent($otherPlayer): int
    {
        return $this->score - $otherPlayer->score;
    }

}