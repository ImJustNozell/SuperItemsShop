<?php

namespace Biswajit\SuperItems\Menus;

use Vecnavium\FormsUI\SimpleForm;
use pocketmine\player\Player;
use pocketmine\item\VanillaItems;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use Biswajit\SuperItems\SuperItemsShop;
use davidglitch04\libEco\libEco;

class GodPotionForm extends SimpleForm
{

    public function __construct(Player $player)
    {
        $config = SuperItemsShop::getInstance()->getConfig();

        parent::__construct(function (Player $player, $data) use ($config) {
            $result = $data;
            if ($result === null) {
                return;
            }
            switch ($result) {
                case 0:
                    $amount = $config->get("God_Potion_Price");
                    libEco::reduceMoney($player, $amount, function (bool $success) use ($player): void {
                        if ($success) {
                            $item1 = VanillaItems::POTION();
                            $glow = VanillaEnchantments::UNBREAKING();
                            $item1->addEnchantment(new EnchantmentInstance($glow, 1));
                            $item1->getNamedTag()->setString("god_potion", "gems");
                            $item1->setCustomName("§r§l§6GOD POTION");
                            $item1->setLore([
                                "§r§7Consume This Potion To Receive",
                                "§r§7All Effects For 3 Days.",
                                "",
                                "§r§aDuration§8: §r§c3 Days",
                                "",
                                "§r§eRight-Click To Consume",
                                "",
                                "§r§l§eLEGENDARY"
                            ]);

                            $player->getInventory()->addItem($item1);
                            $player->sendMessage("§l§aSuccess! §r§eYou Purchased §bGod Potion");
                        } else {
                            $player->sendMessage("§l§cError! §r§cYou Don't Have Enough Money :<");
                        }
                    });
                    break;
            }
        });

        $this->setTitle("§l§bPURCHASE GOD POTION?");
        $this->setContent("§dName: §fGod Potion\n\n§dDescription: §fConsume This Potion To Receive All Effects For 3 Days.\n\n§dDuration: §f3 Days\n\n§dPrice §f" . $config->get("God_Potion_Price"));
        $this->addButton("§r§l§aPURCHASE\n§r§l§c»» §r§6Tap To Purchase", 1, "https://cdn-icons-png.flaticon.com/512/1168/1168610.png");

        $player->sendForm($this);
    }
}
