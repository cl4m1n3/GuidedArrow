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
        $this->setPermission("use.guidedarrow");
        parent::__construct("guidedarrow", "guided arrow", "use /guidedarrow", ["garrow"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            if ($sender->hasPermission("use.guidedarrow")) {

                GuidedArrow::getInstance()->updateStatus($sender);
                
                $sender->sendMessage(
                    TextFormat::WHITE . "The guided arrow has been successfully " .
                    [true => TextFormat::GREEN . "activated", false => TextFormat::RED . "deactivated"][GuidedArrow::getInstance()->getStatus($sender)] .
                    TextFormat::WHITE . "!"
                );
                return;
            }
            $sender->sendMessage(TextFormat::RED . "§cYou do not have permission to use this command!");
        }
    }
}
