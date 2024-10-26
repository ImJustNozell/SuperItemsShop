<?php

namespace Biswajit\SuperItems\Menus;

use Vecnavium\FormsUI\SimpleForm;
use pocketmine\player\Player;
use pocketmine\item\VanillaItems;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use Biswajit\SuperItems\SuperItemsShop;
use davidglitch04\libEco\libEco;

class BoosterCookieForm extends SimpleForm
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
                    $amount = $config->get("Booster_Cookie_Price");
                    libEco::reduceMoney($player, $amount, function (bool $success) use ($player): void {
                        if ($success) {
                            $item1 = VanillaItems::COOKIE();
                            $glow = VanillaEnchantments::UNBREAKING();
                            $item1->addEnchantment(new EnchantmentInstance($glow, 1));
                            $item1->getNamedTag()->setString("booster_cookie", "gems");
                            $item1->setCustomName("§r§l§6BOOSTER COOKIE");
                            $item1->setLore([
                                "§r§7Consume This Cookie To Receive",
                                "§r§7Some Effects For 3 Days.",
                                "",
                                "§r§aDuration§8: §r§c3 Days",
                                "",
                                "§r§eRight-Click To Consume",
                                "",
                                "§r§l§eLEGENDARY"
                            ]);

                            $player->getInventory()->addItem($item1);
                            $player->sendMessage("§l§aSuccess! §r§eYou Purchased §bBooster Cookie");
                        } else {
                            $player->sendMessage("§l§cError! §r§cYou Don't Have Enough Money :<");
                        }
                    });
                    break;
            }
        });

        $this->setTitle("§l§bPURCHASE BOOSTER COOKIE?");
        $this->setContent("§dName: §fBooster Cookie\n\n§dDescription: §fConsume This Cookie To Receive Some Effects For 3 Days.\n\n§dDuration: §f3 Days\n\n§dPrice §f" . $config->get("Booster_Cookie_Price"));
        $this->addButton("§r§l§aPURCHASE\n§r§l§c»» §r§6Tap To Purchase", 1, "https://cdn-icons-png.flaticon.com/512/1168/1168610.png");

        $player->sendForm($this);
    }
}
