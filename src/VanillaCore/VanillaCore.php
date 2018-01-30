<?php

namespace VanillaCore;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;

#Task
use Tasks\BroadcastTask, ClearlaggTask};

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
    
    private function RegTask() {
        $tick = $this->broadcastcfg->getNested("broadcast.tick");
			$this->getServer()->getScheduler()->scheduleRepeatingTask(new BroadcastTask($this), $tick); #20 = 1 second
        }
    
        $tick = $this->cmdscfg->get("Clearlagg-tick");
			$this->getServer()->getScheduler()->scheduleRepeatingTask(new ClearlaggTask($this), $tick); #20 = 1 second
        }
    }
}    
