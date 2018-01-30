<?php

namespace Tasks;

use VanillaCore\VanillaCore;

use pocketmine\Server;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\{TextFormat as C, Config};

class BroadcastTask extends PluginTask{
	
	private $plugin;
	
	public function __construct(VanillaCore $plugin){
		$this->plugin = $plugin;
		parent::__construct($plugin);
	}
	
	public  function onRun(int $currentTick){
        $getmessages = $this->plugin->broadcastcfg->getNested("broadcast.messages");
        $randomessages = $getmessages[array_rand($getmessages)];
        $messages = "$randomessages";
        $this->plugin->getServer()->broadcastMessage("$messages");
	}
}
