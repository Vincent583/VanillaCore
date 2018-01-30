<?php

namespace VanillaCore;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;

#Events
use Events\PlayerDeath;
use Events\onDropItem;

class VanillaCore extends PluginBase {
    
    public function onLoad() {
        $this->getLogger()->info(C::YELLOW . "VanillaCore Loading!");
    }
    
    public function onEnable() {
        $this->RegEvents();
        $this->getLogger()->info(C::GREEN . "VanillaCore Enabled!");
    }
    
    public function onDisable() {
        $this->getLogger()->info(C::RED . "VanillaCore Disabled!");
    }
    
    public function RegEvents() {
        $this->getServer()->getPluginManager()->registerEvents(($this->onDropItem = new onDropItem($this)), $this);
        $this->getServer()->getPluginManager()->registerEvents(($this->PlayerDeath = new PlayerDeath($this)), $this);
    }
}
