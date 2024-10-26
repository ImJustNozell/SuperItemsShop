<?php

namespace Biswajit\SuperItems\Managers;

use pocketmine\player\Player;

interface EffectInterface
{
    public function apply(Player $player, int $duration): void;
}
