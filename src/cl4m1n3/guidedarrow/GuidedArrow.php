<?php
declare(strict_types=1);

namespace cl4m1n3\guidedarrow;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;
use cl4m1n3\guidedarrow\command\GuidedArrowCommand;

class GuidedArrow extends PluginBase
{
    private static array $players = [];
    
    protected function onEnable() : void
    {
        $this->getServer()->getCommandMap()->register("guidedarrow", new GuidedArrowCommand());
        $this->getScheduler()->scheduleRepeatingTask(new Tasks($this), 1);
    }
    public static function getStatus(Player $player) : bool
    {
        $nick = $player->getName();
        if(in_array($nick, self::$players))
        {
            return self::$players[$nick];
        }
        return false;
    }
    public static function setStatus(Player $player, bool $status) : void
    {
        $nick = $player->getName();
        self::$players[$nick] = $status;
    }
}