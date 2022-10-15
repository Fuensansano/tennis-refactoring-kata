<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use TennisGame\Player;

class PlayerTest extends TestCase
{


    public function testCreatePlayer()
    {
        $name = 'Fuen';
        $player = new Player($name);
        $this->assertInstanceOf(Player::class,  $player);
        $this->assertSame($name, $player->name());
    }
}