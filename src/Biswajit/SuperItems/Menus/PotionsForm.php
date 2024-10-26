<?php

namespace Biswajit\SuperItems\Menus;

use Vecnavium\FormsUI\SimpleForm;
use pocketmine\player\Player;

class PotionsForm extends SimpleForm
{

    public function __construct(Player $player)
    {
        parent::__construct(function (Player $player, $data) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    new GodPotionForm($player);
                    break;

                case 1:
                    new BloodPotionForm($player);
                    break;
            }
        });

        $this->setTitle("§l§bPOTIONS - PURCHASE");
        $this->setContent("§dSelect The Which Potion You Want To Purchase:");
        $this->addButton("§r§l§eGOD POTION\n§r§l§c»» §r§6Tap To Purchase", 1, "https://cdn-icons-png.flaticon.com/512/867/867927.png");
        $this->addButton("§r§l§eBLOOD POTION\n§r§l§c»» §r§6Tap To Purchase", 1, "https://cdn-icons-png.flaticon.com/512/867/867927.png");

        $player->sendForm($this);
    }
}
