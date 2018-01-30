<?php

namespace Commands;

use VanillaCore\VanillaCore;

use pocketmine\{Player, Server};
use pocketmine\utils\TextFormat as C;
use pocketmine\command\{PluginCommand, CommandSender, ConsoleCommandSender};
use pocketmine\item\Item;
use pocketmine\inventory\Inventory;

class ClearInvCommand extends PluginCommand {
    
    public function __construct($name, Core $plugin) {
		parent::__construct($name, $plugin);
        $this->setDescription("Clear a player inventory.");
        $this->setPermission("core.clearinv");
        $this->setAliases(["clearinv"]);
	}
    
    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        
        if ($sender instanceof Player) {
            if (!$sender->hasPermission("core.clearinv")) {
                $sender->sendMessage(C::RED . "You are not allow to use this command.");
            } else {
                $inv = $player->getInventory();
                $inv->ClearAll();
                $sender->sendMessage(C::BOLD . C::YELLOW . C::UNDERLINE . "You have cleared your Inventory!");
            }
        } else {
            $sender->sendMessage("Please use this command In-Game!");
        }
        return true;
    }
}
