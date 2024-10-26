<?php

namespace Biswajit\SuperItems\Menus;

use Vecnavium\FormsUI\SimpleForm;
use pocketmine\player\Player;
use pocketmine\item\VanillaItems;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use Biswajit\SuperItems\SuperItemsShop;
use davidglitch04\libEco\libEco;

class GBCookieForm extends SimpleForm
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
                    $amount = $config->get("GB_Cookie_Price");
                    libEco::reduceMoney($player, $amount, function (bool $success) use ($player): void {
                        if ($success) {
                            $item = VanillaItems::COOKIE();
                            $glow = VanillaEnchantments::UNBREAKING();
                            $item->addEnchantment(new EnchantmentInstance($glow, 1));
                            $item->getNamedTag()->setString("gb_cookie", "gems");
                            $item->setCustomName("§r§l§6GB COOKIE");
                            $item->setLore([
                                "§r§7Consume This Cookie To Receive",
                                "§r§7Some Effects For 1 Day.",
                                "",
                                "§r§aDuration§8: §r§c1 Day",
                                "",
                                "§r§eRight-Click To Consume",
                                "",
                                "§r§l§eLEGENDARY"
                            ]);

                            $player->getInventory()->addItem($item);
                            $player->sendMessage("§l§aSuccess! §r§eYou Purchased §bGB Cookie");
                        } else {
                            $player->sendMessage("§l§cError! §r§cYou Don't Have Enough Money :<");
                        }
                    });
                    break;
            }
        });

        $this->setTitle("§l§bPURCHASE GB COOKIE?");
        $this->setContent("§dName: §fGB Cookie\n\n§dDescription: §fConsume This Cookie To Receive Some Effects For 1 Day.\n\n§dDuration: §f1 Day\n\n§dPrice §f" . $config->get("GB_Cookie_Price"));
        $this->addButton("§r§l§aPURCHASE\n§r§l§c»» §r§6Tap To Purchase", 1, "https://cdn-icons-png.flaticon.com/512/1168/1168610.png");

        $player->sendForm($this);
    }
}
