<?php

namespace Biswajit\SuperItems\Managers;

use pocketmine\player\Player;
use pocketmine\item\Item;

class EffectManager
{
    private static array $effectMap = [
        "god_potion" => [PotionEffect::class, 259200],
        "blood_potion" => [PotionEffect::class, 172800],
        "booster_cookie" => [CookieEffect::class, 172800],
        "gb_cookie" => [CookieEffect::class, 86400],
        "dark_carrot" => [CarrotEffect::class, 172800],
        "legends_apple" => [AppleEffect::class, 86400],
    ];

    public static function applyEffectsBasedOnItem(Player $player, Item $item): void
    {
        $namedTag = $item->getNamedTag();
        foreach (self::$effectMap as $tag => [$effectClass, $duration]) {
            if ($namedTag->getTag($tag)) {
                $effect = new $effectClass();
                $effect->apply($player, $duration);
                $player->getInventory()->remove($item);
                break;
            }
        }
    }
}
