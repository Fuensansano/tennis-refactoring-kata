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
        $score = "";
        if ($this->isDeuce()) {
            return $this->deuce();
        }

         if ($this->m_score1 >= 4 || $this->m_score2 >= 4) {
             $score = $this->advantageOrWin();
         } else {
            for ($i = 1; $i < 3; $i++) {
                if ($i == 1) {
                    $tempScore = $this->m_score1;
                } else {
                    $score .= "-";
                    $tempScore = $this->m_score2;
                }
                switch ($tempScore) {
                    case 0:
                        $score .= "Love";
                        break;
                    case 1:
                        $score .= "Fifteen";
                        break;
                    case 2:
                        $score .= "Thirty";
                        break;
                    case 3:
                        $score .= "Forty";
                        break;
                }
            }
        }
        return $score;
    }

    private function deuce() {
        $score = "";

        switch ($this->m_score1) {
            case 0:
                 $score = "Love-All";
                break;
            case 1:
                $score = "Fifteen-All";
                break;
            case 2:
                $score = "Thirty-All";
                break;
            default:
                $score = "Deuce";
                break;
        }
        return $score;
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
}
