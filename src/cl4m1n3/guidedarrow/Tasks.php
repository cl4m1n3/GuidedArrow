<?php

namespace cl4m1n3\guidedarrow;

use pocketmine\entity\projectile\Arrow;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;

class Tasks extends Task
{
    private const SUPPORT_LIMITER = 2.5;

    private $main;

    public function __construct($main)
    {
        $this->main = $main;
    }

    public function onRun(): void
    {
        foreach ($this->main->getServer()->getOnlinePlayers() as $player) {
            foreach ($player->getWorld()->getEntities() as $entity) {
                if ($entity instanceof Arrow && $entity->getOwningEntity() == $player && $this->main->getStatus($player)) {

                    $direction = $player->getDirectionVector();
                    $from = $player->getPosition()->asVector3();
                    $to = $entity->getPosition()->asVector3();
                    $distance = $from->distance($to);
                    $hover_point = $distance + self::SUPPORT_LIMITER;

                    if ($distance <= 250) {
                        $vector = new Vector3($from->getX() + $direction->getX() * $hover_point, $from->getY() + 2 + $direction->getY() * $hover_point, $from->getZ() + $direction->getZ() * $hover_point);
                        $entity->setMotion(($vector->subtractVector($to))->normalize());
                    }
                }
            }
        }
    }
}