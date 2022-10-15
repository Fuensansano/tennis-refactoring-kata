<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use TennisGame\Player;
use TennisGame\Point;

class PlayerTest extends TestCase
{
    private Player $otherPlayer;
    private Player $player;
    public const A_RANDOM_PLAYER_NAME = 'A_RANDOM_PLAYER_NAME';

    protected function setUp(): void
    {
        parent::setUp();
        $this->player = new Player(self::A_RANDOM_PLAYER_NAME);
        $this->otherPlayer = new Player(self::A_RANDOM_PLAYER_NAME);
    }

    public function test_create_player_with_a_name()
    {
        $this->assertInstanceOf(Player::class,  $this->player);
        $this->assertSame(self::A_RANDOM_PLAYER_NAME, $this->player->name());
    }


    public function test_have_a_increment_score()
    {
        $this->player->increaseScore();
        $this->assertSame(Point::FIFTEEN->value, $this->player->printableScore());
    }


    public function test_two_players_with_the_same_score_are_a_deuce()
    {
        $this->assertTrue($this->player->isDeuce(new Player(self::A_RANDOM_PLAYER_NAME)));
    }

    public function test_two_player_should_have_a_different_score()
    {
        $this->otherPlayer->increaseScore();
        $this->assertFalse($this->player->isDeuce($this->otherPlayer));
    }

    public function test_a_player_has_advantage_or_has_win()
    {
        $this->otherPlayer->increaseScore();
        $this->otherPlayer->increaseScore();
        $this->otherPlayer->increaseScore();
        $this->otherPlayer->increaseScore();
        $this->assertTrue($this->player->hasAdvantageOrWin($this->otherPlayer));
    }


    /**
     * @dataProvider provideNotEnoughPointsToAdvantageOrWin
     */
    public function test_given_that_no_player_has_reach_40_points_then_nobody_has_advantage_or_won(int $pointsPlayer, int $pointsOtherPlayer): void
    {
        for ($i = 0; $i < $pointsOtherPlayer; $i++){
            $this->otherPlayer->increaseScore();
        }

        for ($i = 0; $i < $pointsPlayer; $i++){
            $this->player->increaseScore();
        }

        $this->assertFalse($this->player->hasAdvantageOrWin($this->otherPlayer));
    }

    public function provideNotEnoughPointsToAdvantageOrWin(): \Generator
    {
        yield [ 0,0 ];
        yield [ 0,1 ];
        yield [ 0,2 ];
        yield [ 0,3 ];
        yield [ 0,1 ];
        yield [ 1,0 ];
        yield [ 2,0 ];
        yield [ 3,0 ];
        yield [ 1,1 ];
        yield [ 1,2 ];
        yield [ 1,3 ];
        yield [ 2,1 ];
        yield [ 2,2 ];
        yield [ 2,3 ];
        yield [ 3,1 ];
        yield [ 3,2 ];
        yield [ 3,3 ];
    }



}
