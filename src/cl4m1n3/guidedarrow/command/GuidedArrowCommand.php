<?php

namespace cl4m1n3\guidedarrow\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use cl4m1n3\guidedarrow\GuidedArrow;

class GuidedArrowCommand extends Command
{
    public function __construct()
    {
        parent::__construct("guidedarrow", "guided arrow", "use /guidedarrow");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player)
        {
            if($sender->hasPermission("use.guidedarrow"))
            {
                if(GuidedArrow::getStatus($sender)) // If the status is true
                {
                    GuidedArrow::setStatus($sender, false);
                    $sender->sendMessage(TextFormat::WHITE . "The guided arrow has been successfully " . TextFormat::RED . "deactivated" . TextFormat::WHITE . "!");
                    return;
                }
                GuidedArrow::setStatus($sender, true);
                $sender->sendMessage(TextFormat::WHITE . "The guided arrow has been successfully " . TextFormat::GREEN . "activated" . TextFormat::WHITE . "!");
                return;
            }
            $sender->sendMessage(TextFormat::RED . "§cYou do not have permission to use this command!");
        }
    }
}