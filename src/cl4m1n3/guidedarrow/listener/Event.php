<?php

namespace cl4m1n3\guidedarrow\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\entity\Location;
use pocketmine\entity\projectile\Arrow;

class Event implements Listener
{
    public function onPlayerItemUse(PlayerItemUseEvent $event) : void
    {
        $player = $event->getPlayer();
        $location = $player->getLocation();
        $item = $event->getItem();
        
        if($item->getId() == 262 && $item->getCustomName() == "Guided Arrow\n§ePinch in the hand")
        {
            // shot with a guided arrow
            $arrow = new Arrow(new Location($location->getX(), $location->getY() + 2, $location->getZ(), $player->getWorld(), $location->getYaw(), $location->getPitch()), $player, true);
            $arrow->setOwningEntity($player);
            $arrow->setGravity(0.01);
            $arrow->setMotion($player->getDirectionVector()->multiply(2));        
            $arrow->spawnToAll();
        }
    }
}