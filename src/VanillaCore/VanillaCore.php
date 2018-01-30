<?php

namespace VanillaCore;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;

#Commands
use Commands\ClearInvCommand;

#Events
use Events\PlayerDeath;
use Events\onDropItem;

class VanillaCore extends PluginBase {
    
    public function onLoad() {
        $this->getLogger()->info(C::YELLOW . "VanillaCore Loading!");
    }
    
    public function onEnable() {
        $this->RegEvents();
        $this->RegTasks();
        $this->RegCommands();
        $this->getLogger()->info(C::GREEN . "VanillaCore Enabled!");
    }
    
    public function onDisable() {
        $this->getLogger()->info(C::RED . "VanillaCore Disabled!");
    }
    
    private function RegCommands() {
        $this->getServer()->getCommandMap()->register("clearinv", new ClearInvCommand("clearinv", $this));
    }
    
    public function RegEvents() {
        $this->getServer()->getPluginManager()->registerEvents(($this->onDropItem = new onDropItem($this)), $this);
        $this->getServer()->getPluginManager()->registerEvents(($this->PlayerDeath = new PlayerDeath($this)), $this);
    }
}
