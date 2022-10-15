<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use TennisGame\Player;

class PlayerTest extends TestCase
{

    public function test_create_player_with_a_name()
    {
        $name = 'Fuen';
        $player = new Player($name);
        $this->assertInstanceOf(Player::class,  $player);
        $this->assertSame($name, $player->name());
    }

    public function test_have_a_score()
    {
        $name = 'Fuen';
        $player = new Player($name);
        $this->assertSame(0, $player->score());
    }
}