<?php

namespace NoobMCBG\Shire;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};
use pocketmine\scheduler\Task;
use pocketmine\level\particle\{CriticalParticle, DestroyBlockParticle};
use pocketmine\entity\{Effect, EffectInstance};
use pocketmine\block\Block;
use NoobMCBG\Shire\Main as Shire;

class VirusTask extends Task {

    public function __construct(Shire $plugin){
        $this->plugin = $plugin;
    }

    public function onRun($currentTick){
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player){
            $name = $player->getName();
            if($player->isSurvival()){
                if($level->getName() === $this->config->get("shire-world")){
                    if(!$this->plugin->virustime->exists($player->getName())){
                        $this->plugin->virustime->set($player->getName(), 500);
                    }
                }
                $virustime = $this->plugin->virustime->get($player->getName());
                $vt = round(($virustime/500 * 100), 3);
                if($virustime >= 1){
                $this->plugin->virustime->set($player->getName(), $virustime - 0.02);
                }else{
                $player->getLevel()->addParticle(new DestroyBlockParticle($player->add(0,0.6,0), Block::get(7)));
                $player->addEffect(new EffectInstance(Effect::getEffect(2), 2, 1));
                $player->addEffect(new EffectInstance(Effect::getEffect(7), 2, 1));
                $player->addEffect(new EffectInstance(Effect::getEffect(15), 2, 1));
                $player->addEffect(new EffectInstance(Effect::getEffect(17), 2, 1));
                $player->addEffect(new EffectInstance(Effect::getEffect(19), 2, 1));
                $player->addEffect(new EffectInstance(Effect::getEffect(20), 2, 1));
                }
            }
        }
	}
}