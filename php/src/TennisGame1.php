<?php

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    const PLAYER_1 = 'player1';
    private $m_score1 = 0;
    private $m_score2 = 0;
    private $player1Name = '';
    private $player2Name = '';

    public function __construct($player1Name, $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint($playerName)
    {

        if (self::PLAYER_1 == $playerName) {
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

        if ($this->m_score1 >= 4 || $this->m_score2 >= 4) {
            return $this->advantageOrWin();
        }

        return $this->printScoreByPlayer($this->m_score1) . '-' . $this->printScoreByPlayer($this->m_score2);
    }

    private function deuce(): string
    {
        return match ($this->m_score1) {
            0 => Point::LOVE->value . '-All',
            1 => Point::FIFTEEN->value . '-All',
            2 => Point::THIRTY->value . '-All',
            default => "Deuce"
        };
    }


    private function isDeuce(): bool
    {
        return $this->m_score1 == $this->m_score2;
    }


    public function advantageOrWin(): string
    {
        $minusResult = $this->m_score1 - $this->m_score2;

        if ($minusResult === 1 || $minusResult === -1) {
            return $this->advantage($minusResult);
        }

        return $this->win($minusResult);
    }

    private function advantage($minusResult): string
    {
        if ($minusResult == 1) {
            return "Advantage player1";
        }
        return "Advantage player2";
    }


    public function win(int $minusResult): string
    {
        if ($minusResult >= 2) {
            return "Win for player1";
        }
        return "Win for player2";
    }


    public function printScoreByPlayer($scorePlayer): string
    {
        return match ($scorePlayer) {
            0 => Point::LOVE->value,
            1 => Point::FIFTEEN->value,
            2 => Point::THIRTY->value,
            default => Point::FORTY->value,
        };
    }
}
