<?php

namespace Biswajit\SuperItems\Menus;

use Vecnavium\FormsUI\SimpleForm;
use pocketmine\player\Player;

class CookiesForm extends SimpleForm
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
                    new BoosterCookieForm($player);
                    break;

                case 1:
                    new GBCookieForm($player);
                    break;
            }
        });

        $this->setTitle("§l§bCOOKIES - PURCHASE");
        $this->setContent("§dSelect The Which Cookie You Want To Purchase:");
        $this->addButton("§r§l§eBOOSTER COOKIE\n§r§l§c»» §r§6Tap To Purchase", 1, "https://cdn-icons-png.flaticon.com/512/541/541803.png");
        $this->addButton("§r§l§eGB COOKIE\n§r§l§c»» §r§6Tap To Purchase", 1, "https://cdn-icons-png.flaticon.com/512/541/541803.png");

        $player->sendForm($this);
    }
}
