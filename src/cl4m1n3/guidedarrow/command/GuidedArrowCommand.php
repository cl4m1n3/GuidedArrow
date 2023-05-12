<?php

namespace cl4m1n3\guidedarrow\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\CommandException;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player;

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
                $sender->getInventory()->addItem(ItemFactory::getInstance()->get(262, 0, 1)->setCustomName("Guided Arrow\n§ePinch in the hand"));
                return;
            }
            $sender->sendMessage("§cYou do not have permission to use this command!");
        }
    }
}