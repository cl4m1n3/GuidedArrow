<?php

namespace cl4m1n3\guidedarrow;

use pocketmine\scheduler\Task;

class Tasks extends Task{
    
    private $main;
    
    public function __construct($main){
        $this->main = $main;
    }
    public function onRun() : void{
        foreach($this->main->getServer()->getOnlinePlayers() as $player)
        {
            foreach($player->getWorld()->getEntities() as $entity)
            {
                if($entity instanceof \pocketmine\entity\projectile\Arrow && $entity->getOwningEntity() == $player && $entity->getGravity() == 0.01)
                {
                    $entity->setMotion($player->getDirectionVector()->multiply(2));
                }
            }
        }
    }
}