<?php
declare(strict_types=1);

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    const ADVANTAGE_POINT = 1;
    private $player1;
    private $player2;

    public function __construct($player1Name, $player2Name)
    {
        $this->player1 = new Player($player1Name);
        $this->player2 = new Player($player2Name);
    }

    public function wonPoint($playerName)
    {
        if ($this->player1->name() == $playerName) {
            $this->player1->increaseScore();
            return;
        }

        $this->player2->increaseScore();

    }

    public function getScore()
    {
        //TODO: Test isDeuce()
        if ($this->isDeuce()) {
            return $this->deuce();
        }

        //TODO hasAdvantageorWin
        if ($this->hasAdvantageOrWin()) {
            $minusResult = $this->player1->scoreDifferent($this->player2);
            if ($this->hasAdvantage($minusResult)) {
                return $this->advantage($minusResult);
            }

            return $this->win($minusResult);
        }
        return $this->player1->printableScore() . '-' . $this->player2->printableScore();
    }

    private function deuce(): string
    {
        if ($this->player1->printableScore() === Point::FORTY->value) {
            return GameStatus::DEUCE->value;
        }
        return sprintf("%s-%s", $this->player1->printableScore(), GameStatus::ALL->value);
    }


    private function isDeuce(): bool
    {
        return $this->player1->isDeuce($this->player2);
    }

    private function advantage($minusResult): string
    {
        if ($minusResult == self::ADVANTAGE_POINT) {
            return sprintf("%s %s", GameStatus::ADVANTAGE->value, $this->player1->name());
        }
        return sprintf("%s %s", GameStatus::ADVANTAGE->value, $this->player2->name());
    }

    public function win(int $minusResult): string
    {
        if ($minusResult >= 2) {
            return sprintf("%s for %s", GameStatus::WIN->value, $this->player1->name());
        }

        return sprintf("%s for %s", GameStatus::WIN->value, $this->player2->name());

    }

    private function hasAdvantageOrWin(): bool
    {
        return $this->player1->hasAdvantageOrWin($this->player2);
    }


    private function hasAdvantage(int $minusResult): bool
    {
        return $minusResult === self::ADVANTAGE_POINT || $minusResult === -self::ADVANTAGE_POINT;
    }
}
