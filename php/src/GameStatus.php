<?php

namespace TennisGame;

enum GameStatus: string
{
    case DEUCE = 'Deuce';
    case ALL = 'All';
    case ADVANTAGE = 'Advantage';
    case WIN = 'Win';
}
