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
}