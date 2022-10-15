<?php
declare(strict_types=1);

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    const MIN_POINTS_TO_WIN = 4;
    const ADVANTAGE_POINT = 1;
    private $m_score1 = 0;
    private $m_score2 = 0;
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
            $this->m_score1++;
            return;
        }

        $this->m_score2++;

    }

    public function getScore()
    {
        if ($this->isDeuce()) {
            return $this->deuce();
        }

        if ($this->hasAdvantageOrWin()) {
            $minusResult = $this->m_score1 - $this->m_score2;
            if ($this->hasAdvantage($minusResult)) {
                return $this->advantage($minusResult);
            }

            return $this->win($minusResult);
        }

        return $this->getScoreByPlayer($this->m_score1) . '-' . $this->getScoreByPlayer($this->m_score2);
    }

    private function deuce(): string
    {
        return match ($this->m_score1) {
            0 => Point::LOVE->value . '-' . GameStatus::ALL->value,
            1 => Point::FIFTEEN->value . '-' . GameStatus::ALL->value,
            2 => Point::THIRTY->value . '-' . GameStatus::ALL->value,
            default => GameStatus::DEUCE->value,
        };
    }


    private function isDeuce(): bool
    {
        return $this->m_score1 == $this->m_score2;
    }

    private function advantage($minusResult): string
    {
        if ($minusResult == self::ADVANTAGE_POINT) {
            return GameStatus::ADVANTAGE->value . ' ' . $this->player1->name();
        }
        return GameStatus::ADVANTAGE->value . ' ' . $this->player2->name();
    }

    public function win(int $minusResult): string
    {
        if ($minusResult >= 2) {
            return GameStatus::WIN->value . ' for ' . $this->player1->name();
        }

        return GameStatus::WIN->value . ' for ' . $this->player2->name();

    }

    public function getScoreByPlayer($playerScore): string
    {
        return match ($playerScore) {
            0 => Point::LOVE->value,
            1 => Point::FIFTEEN->value,
            2 => Point::THIRTY->value,
            default => Point::FORTY->value,
        };
    }


    private function hasAdvantageOrWin(): bool
    {
        return $this->m_score1 >= self::MIN_POINTS_TO_WIN || $this->m_score2 >= self::MIN_POINTS_TO_WIN;
    }


    private function hasAdvantage(int $minusResult): bool
    {
        return $minusResult === self::ADVANTAGE_POINT || $minusResult === -self::ADVANTAGE_POINT;
    }
}
