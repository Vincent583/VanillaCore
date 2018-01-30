<?php

namespace Events;

use VanillaCore\VanillaCore;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\item\Item;

class onDropItem implements Listener {
    
    private $core;
    
    public function __construct(VanillaCore $core){
        $this->core = $core;
    }
    
    public function OnDropItem(PlayerDropItemEvent $event){
		if($event->getPlayer()->getGamemode() === 1) $event->setCancelled();
	}
}
