<?php

namespace Biswajit\SuperItems\Menus;

use Biswajit\SuperItems\Forms\FormFactory;
use Vecnavium\FormsUI\SimpleForm;
use pocketmine\player\Player;

class SuperItemsShopForm extends SimpleForm
{
    public function __construct(Player $player)
    {
        parent::__construct(function (Player $player, $data) {
            if ($data === null) return;

            switch ($data) {
                case 0:
                    FormFactory::create("potions", $player);
                    break;
                case 1:
                    FormFactory::create("cookies", $player);
                    break;
                case 2:
                    FormFactory::create("others", $player);
                    break;
            }
        });

        $this->setTitle("§l§bSUPER ITEMS SHOP");
        $this->setContent("§dSelect The Which Item You Want To Purchase:");
        $this->addButton("§r§l§ePOTIONS\n§r§l§c»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/512/867/867927.png");
        $this->addButton("§r§l§eCOOKIES\n§r§l§c»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/512/541/541803.png");
        $this->addButton("§r§l§eOTHERS\n§r§l§c»» §r§6Tap To Open", 1, "https://cdn-icons-png.flaticon.com/512/8323/8323931.png");

        $player->sendForm($this);
    }
}
