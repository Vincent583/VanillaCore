<?php

namespace Tasks;

use VanillaCore\VanillaCore;

use pocketmine\{Player, Server};
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\{TextFormat as C, Config};
use pocketmine\entity\{Entity, Creature, Human};

class ClearlaggTask extends PluginTask{
	
	private $plugin;
	
	public function __construct(VanillaCore $plugin){
		$this->plugin = $plugin;
		parent::__construct($plugin);
	}
	
	public  function onRun(int $currentTick){
        $plugin = $this->plugin;
        switch($plugin->cmdscfg->getNested("Clearlagg-type")){
            case "clear":
            $this->removeEntities();
            $plugin->getServer()->broadcastMessage(C::GRAY . "(" . C::YELLOW . "ClearLagg" . C::GRAY . ") " . C::GREEN . "Removed " . C::YELLOW . "$entites " . C::GREEN . "entites.");
            break;
            case "killmobs":
            $this->removeMobs();
            $plugin->getServer()->broadcastMessage(C::GRAY . "(" . C::YELLOW . "ClearLagg" . C::GRAY . ") " . C::GREEN . "Removed " . C::YELLOW . "$entites " . C::GREEN . "mobs.");
            break;
            case "clearall":
            $mobs = $this->removeMobs();
            $entites = $this->removeEntities();
            $plugin->getServer()->broadcastMessage(C::GRAY . "(" . C::YELLOW . "ClearLagg" . C::GRAY . ") " . C::GREEN . "Removed " . C::YELLOW . "$mobs " . C::GREEN . "mobs, " . C::YELLOW . "$entites " . C::GREEN . "entites.");
            break;
        }
    }
    
    public function removeEntities(): int{
        $plugin = $this->plugin;
        $i = 0;
        foreach($plugin->getServer()->getLevels() as $level){
          foreach($level->getEntities() as $entity){
            if(!$this->isEntityExempted($entity) && !($entity instanceof Creature)){
              $entity->close();
              $i++;
            }
          }
        }
        return $i;
        }
        
        public function removeMobs(): int{
        $plugin = $this->plugin;
        $i = 0;
        foreach($plugin->getServer()->getLevels() as $level){
          foreach($level->getEntities() as $entity) {
            if(!$this->isEntityExempted($entity) && $entity instanceof Creature && !($entity instanceof Human)){
              $entity->close();
              $i++;
            }
          }
        }
        return $i;
        }
        
        public function exemptEntity(Entity $entity): void{
        $this->exemptedEntities[$entity->getID()] = $entity;
        }
        
        public function isEntityExempted(Entity $entity): bool{
        return isset($this->exemptedEntities[$entity->getID()]);
      }
}
