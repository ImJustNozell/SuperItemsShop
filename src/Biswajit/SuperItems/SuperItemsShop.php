<?php

namespace Biswajit\SuperItems;

use Biswajit\SuperItems\Forms\FormFactory;
use Biswajit\SuperItems\Managers\EffectManager;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;

class SuperItemsShop extends PluginBase implements Listener
{
	use SingletonTrait;

	public function onEnable(): void
	{
		self::setInstance($this);
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool
	{
		if ($cmd->getName() === "sshop") {
			if (!$sender instanceof Player) {
				$sender->sendMessage("This command can only be used by a player in the game.");
				return true;
			}

			if (!$sender->hasPermission("SuperItemsShop.cmd.use")) {
				$sender->sendMessage("You don't have permission to use this command.");
			} else {
				FormFactory::create("shop", $sender);
			}
		}
		return true;
	}


	public function onItemUse(PlayerItemUseEvent $event): void
	{
		$player = $event->getPlayer();
		$item = $event->getItem();
		EffectManager::applyEffectsBasedOnItem($player, $item);
	}
}
