<?php

namespace Biswajit\SuperItems\Menus;

use Vecnavium\FormsUI\SimpleForm;
use pocketmine\player\Player;
use pocketmine\item\VanillaItems;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use Biswajit\SuperItems\SuperItemsShop;
use davidglitch04\libEco\libEco;

class DarkCarrotForm extends SimpleForm
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
                    $amount = $config->get("Dark_Carrot_Price");
                    libEco::reduceMoney($player, $amount, function (bool $success) use ($player): void {
                        if ($success) {
                            $item = VanillaItems::GOLDEN_CARROT();
                            $glow = VanillaEnchantments::UNBREAKING();
                            $item->addEnchantment(new EnchantmentInstance($glow, 1));
                            $item->getNamedTag()->setString("dark_carrot", "gems");
                            $item->setCustomName("§r§l§6DARK CARROT");
                            $item->setLore([
                                "§r§7Consume This Carrot To Receive",
                                "§r§7Health Boost Or Night Vision",
                                "§r§7For 2 Days.",
                                "",
                                "§r§aDuration§8: §r§c2 Days",
                                "",
                                "§r§eRight-Click To Consume",
                                "",
                                "§r§l§eLEGENDARY"
                            ]);

                            $player->getInventory()->addItem($item);
                            $player->sendMessage("§l§aSuccess! §r§eYou Purchased §bDark Carrot");
                        } else {
                            $player->sendMessage("§l§cError! §r§cYou Don't Have Enough Money :<");
                        }
                    });
                    break;
            }
        });

        $this->setTitle("§l§bPURCHASE DARK CARROT?");
        $this->setContent("§dName: §fDark Carrot\n\n§dDescription: §fConsume This Carrot To Receive Health Boost And Night Vision Effect For 2 Days.\n\n§dDuration: §f2 Days\n\n§dPrice §f" . $config->get("Dark_Carrot_Price"));
        $this->addButton("§r§l§aPURCHASE\n§r§l§c»» §r§6Tap To Purchase", 1, "https://cdn-icons-png.flaticon.com/512/1168/1168610.png");

        $player->sendForm($this);
    }
}
