<?php

namespace Biswajit\SuperItems\Menus;

use Biswajit\SuperItems\SuperItemsShop;
use davidglitch04\libEco\libEco;
use Vecnavium\FormsUI\SimpleForm;
use pocketmine\player\Player;
use pocketmine\item\VanillaItems;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;

class LegendsAppleForm extends SimpleForm
{


    public function __construct(Player $player)
    {

        parent::__construct(function (Player $player, $data) {
            $result = $data;
            if ($result === null) {
                return;
            }
            switch ($result) {
                case 0:
                    $amount = SuperItemsShop::getInstance()->getConfig()->get("Legends_Apple_Price");
                    libEco::reduceMoney($player, $amount, function (bool $success) use ($player): void {
                        if ($success) {
                            $item = VanillaItems::GOLDEN_APPLE();
                            $glow = VanillaEnchantments::UNBREAKING();
                            $item->addEnchantment(new EnchantmentInstance($glow, 1));
                            $item->getNamedTag()->setString("legends_apple", "gems");
                            $item->setCustomName("§r§l§6LEGENDS APPLE");

                            $item->setLore([
                                "§r§7Consume This Apple To Receive",
                                "§r§7Health Boost Or Night Vision",
                                "§r§7For 1 Day.",
                                "",
                                "§r§aDuration§8: §r§c1 Day",
                                "",
                                "§r§eRight-Click To Consume",
                                "",
                                "§r§l§eLEGENDARY"
                            ]);
                            $player->getInventory()->addItem($item);
                            $player->sendMessage("§l§aSuccess! §r§eYou Purchased §bLegends Apple");
                        } else {
                            $player->sendMessage("§l§cError! §r§cYou Don't Have Enough Money :<");
                        }
                    });
                    break;
            }
        });

        $this->setTitle("§l§bPURCHASE LEGENDS APPLE?");
        $this->setContent("§dName: §fLegends Apple\n\n§dDescription: §fConsume This Apple To Receive Health Boost And Night Vision Effect For 1 Day.\n\n§dDuration: §f1 Day\n\n§dPrice §f" . SuperItemsShop::getInstance()->getConfig()->get("Legends_Apple_Price"));
        $this->addButton("§r§l§aPURCHASE\n§r§l§c»» §r§6Tap To Purchase", 1, "https://cdn-icons-png.flaticon.com/512/1168/1168610.png");

        $player->sendForm($this);
    }
}
