<?php

namespace cl4m1n3\guidedarrow;

use pocketmine\scheduler\Task;
use pocketmine\entity\projectile\Arrow;
use cl4m1n3\guidedarrow\GuidedArrow;

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
                if($entity instanceof Arrow && $entity->getOwningEntity() == $player && GuidedArrow::getStatus($player))
                {
                    $entity->setMotion($player->getDirectionVector()->multiply(2));
                }
            }
        }
    }
}