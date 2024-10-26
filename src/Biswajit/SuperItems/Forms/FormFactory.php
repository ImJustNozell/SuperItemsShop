<?php

namespace Biswajit\SuperItems\Forms;

use pocketmine\player\Player;
use Biswajit\SuperItems\Menus\SuperItemsShopForm;
use Biswajit\SuperItems\Menus\PotionsForm;
use Biswajit\SuperItems\Menus\CookiesForm;
use Biswajit\SuperItems\Menus\OthersForm;

class FormFactory
{
    public static function create(string $type, Player $player): void
    {
        switch ($type) {
            case "potions":
                new PotionsForm($player);
                break;
            case "cookies":
                new CookiesForm($player);
                break;
            case "others":
                new OthersForm($player);
                break;
            default:
                new SuperItemsShopForm($player);
                break;
        }
    }
}
