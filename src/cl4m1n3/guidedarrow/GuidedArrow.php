<?php
declare(strict_types=1);

namespace cl4m1n3\guidedarrow;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use cl4m1n3\guidedarrow\listener\Event;
use cl4m1n3\guidedarrow\command\GuidedArrowCommand;

class GuidedArrow extends PluginBase
{
    protected function onEnable() : void
    {
        Server::getInstance()->getPluginManager()->registerEvents(new Event(), $this);
        Server::getInstance()->getCommandMap()->register("guidedarrow", new GuidedArrowCommand());
        $this->getScheduler()->scheduleRepeatingTask(new Tasks($this), 1);
    }
}