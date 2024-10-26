<?php

namespace Biswajit\SuperItems\Managers;

use pocketmine\player\Player;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;

class CookieEffect implements EffectInterface
{
    public function apply(Player $player, int $duration): void
    {
        $effects = [
            VanillaEffects::SPEED(),
            VanillaEffects::HASTE(),
            VanillaEffects::JUMP_BOOST(),
            VanillaEffects::NIGHT_VISION(),
            VanillaEffects::HEALTH_BOOST(),
        ];

        foreach ($effects as $effect) {
            $player->getEffects()->add(new EffectInstance($effect, $duration * 20, 1, true));
        }
    }
}
