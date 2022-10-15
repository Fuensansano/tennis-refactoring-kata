<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use TennisGame\Player;

class PlayerTest extends TestCase
{

    private Player $player;
    public const A_RANDOM_PLAYER_NAME = 'A_RANDOM_PLAYER_NAME';

    protected function setUp(): void
    {
        parent::setUp();
        $this->player = new Player(self::A_RANDOM_PLAYER_NAME);
    }

    public function test_create_player_with_a_name()
    {
        $this->assertInstanceOf(Player::class,  $this->player);
        $this->assertSame(self::A_RANDOM_PLAYER_NAME, $this->player->name());
    }

    public function test_have_a_score()
    {
        $this->assertSame(0, $this->player->score());
    }

    public function test_have_a_increment_score()
    {
        $this->player->increaseScore();
        $this->assertSame(1, $this->player->score());
    }

    /**
     * @dataProvider provideTimesOfIncreaseScore
     */
    public function test_have_a_multiple_increments_to_the_score(int $timesToIncrease): void
    {
        for ($i = 0; $i < $timesToIncrease; $i++){
            $this->player->increaseScore();
        }
        $this->assertSame($timesToIncrease, $this->player->score());
    }

    public function provideTimesOfIncreaseScore(): \Generator
    {
        yield [ 100 ];
        yield [ 25 ];
        yield [ 50 ];
    }

    public function test_two_players_with_the_same_score_are_a_deuce()
    {
        $this->assertTrue($this->player->isDeuce(new Player(self::A_RANDOM_PLAYER_NAME)));
    }

    public function test_two_player_should_have_a_different_score()
    {
        $otherPlayer = new Player(self::A_RANDOM_PLAYER_NAME);
        $otherPlayer->increaseScore();
        $this->assertFalse($this->player->isDeuce($otherPlayer));
    }
}
