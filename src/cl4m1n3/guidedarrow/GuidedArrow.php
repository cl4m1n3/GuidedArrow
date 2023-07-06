<?php
declare(strict_types=1);

namespace cl4m1n3\guidedarrow;

use cl4m1n3\guidedarrow\command\GuidedArrowCommand;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class GuidedArrow extends PluginBase
{
    private static $instance;

    private array $statuses = [];

    protected function onEnable(): void
    {
        self::$instance = $this;

        $this->getServer()->getCommandMap()->register("guidedarrow", new GuidedArrowCommand());
        $this->getScheduler()->scheduleRepeatingTask(new Tasks($this), 1);
    }

    public static function getInstance(): GuidedArrow
    {
        return self::$instance;
    }

    public function getStatus(Player $player): bool
    {
        $nick = strtolower($player->getName());
        return in_array($nick, $this->statuses) ? $this->statuses[$nick] : false;
    }

    public function updateStatus(Player $player): void
    {
        $this->statuses[strtolower($player->getName())] = !$this->getStatus($player);
    }
}