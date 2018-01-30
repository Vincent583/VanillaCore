<?php

namespace Events;

use VanillaCore\VanillaCore;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\Listener;

class PlayerDeath implements Listener {
    
    private $core;
    
    public function __construct(VanillaCore $core){
        $this->core = $core;
    }
    
    public function PlayerDeath(PlayerDeathEvent $event) {
        $event->setKeepInventory(true);
    }
}
