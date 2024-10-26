<?php

namespace Biswajit\SuperItems\Menus;

use Vecnavium\FormsUI\SimpleForm;
use pocketmine\player\Player;

class OthersForm extends SimpleForm
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
                    new DarkCarrotForm($player);
                    break;

                case 1:
                    new LegendsAppleForm($player);
                    break;
            }
        });

        $this->setTitle("§l§bOTHERS - PURCHASE");
        $this->setContent("§dSelect The Which Item You Want To Purchase:");
        $this->addButton("§r§l§eDARK CARROT\n§r§l§c»» §r§6Tap To Purchase", 1, "https://cdn-icons-png.flaticon.com/512/8323/8323931.png");
        $this->addButton("§r§l§eLEGENDS APPLE\n§r§l§c»» §r§6Tap To Purchase", 1, "https://cdn-icons-png.flaticon.com/512/8323/8323931.png");

        $player->sendForm($this);
    }
}
