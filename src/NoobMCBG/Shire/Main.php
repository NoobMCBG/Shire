<?php

namespace NoobMCBG\Shire;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase as PB;
use pocketmine\event\player\{PlayerJoinEvent, PlayerIntractEvent};
use pocketmine\event\Listener as L;
use pocketmine\level\Position;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityLevelChangeEvent;

class Main extends PB implements L {

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("\n\n\nĐã Hoạt Động Plugin\n-=-=-=-=-=-=-=-=-=-=-=-\n\n XỨ SHIRE\n\nRemake By NoobMCBG\n\n-=-=-=-=-=-=-=-=-=-=-=-\n\n\n");
		$this->getLogger()->info("Remake by NoobMCBG");
		$this->point = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
		$this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		@mkdir($this->getDataFolder(), 0744, true);
		$this->saveDefaultConfig();
		$this->virustime = new Config($this->getDataFolder() . "virustime.yml", Config::YAML);
		$this->getScheduler()->scheduleRepeatingTask(new VirusTask($this), 20); //20 tick = 1 giây
	}
 
	private function ShireWorldCheck(Entity $entity) : bool{
		if(!$entity instanceof Player){
            return false;
        }
		if(!in_array($entity->getLevel()->getName(), $this->getConfig()->get("shire-world"))){
			$entity->sendPopup(" ");
		}else{
			$entity->addTitle("§l§6✦§c Bạn Không Còn Ở Xứ Shire §6✦");
		}
	}

	public function onJoin(PlayerJoinEvent $ev){
		$player = $ev->getPlayer();
		$this->getServer()->getCommandMap()->dispatch($player, $this->getConfig()->get("join-cmd"));
		if($this->virustime->exists($player->getName())){
		    $this->virustime->set(strtolower($player->getName()), 500);
		}
	}

	public function onLevelChange(EntityLevelChangeEvent $event) : void{
		$entity = $event->getEntity();
		if($entity instanceof Player){
			$this->ShireWorldCheck($entity);
	    }
	}

	public function onBreak(BlockBreakEvent $ev){
		$player = $ev->getPlayer();
		$level = $player->getLevel();
		if($level->getName() === $this->getConfig()->get("shire-world")){
            if($ev->isCancelled()){
            return false;
            }else{
            $player = $ev->getPlayer();
            $name = $player->getName();
            $level = $player->getLevel();
            $block = $ev->getBlock();
                //Gia Tài Khi Cầm Cúp Sắt Enchant Gia Tài
                if($player->getInventory()->getItemInHand()->getId() == 257){
                    if($player->getInventory()->getItemInHand()->hasEnchantment(18)){
                        $fortune = $player->getInventory()->getItemInHand()->getEnchantment(18)->getLevel();
                        $fortune = $fortune > 1000 ? 1000 : $fortune;
                    }
                }
                //Gia Tài Khi Cầm Cúp Kim Cương Enchant Gia Tài
                if($player->getInventory()->getItemInHand()->getId() == 278){
                    if($player->getInventory()->getItemInHand()->hasEnchantment(18)){
                        $fortune = $player->getInventory()->getItemInHand()->getEnchantment(18)->getLevel();
                        $fortune = $fortune > 1000 ? 1000 : $fortune;
                    }
                }
                //Gia Tài Khi Cầm Cúp Netherire Enchant Gia Tài
                if($player->getInventory()->getItemInHand()->getId() == 745){
                    if($player->getInventory()->getItemInHand()->hasEnchantment(18)){
                        $fortune = $player->getInventory()->getItemInHand()->getEnchantment(18)->getLevel();
                        $fortune = $fortune > 1000 ? 1000 : $fortune;
                    }
                }
                //Đào Nhận Ore Than
                if($block->getId() == 14){
                    $ev->setDrops([]);
                    $item = Item::get(14, 0, isset($fortune) ? mt_rand(1, $fortune) : 1);
                    if($player->getInventory()->canAddItem($item)){
                        $player->getInventory()->addItem($item);                  
                    }
                    return true;
                }
                //Đào Nhận Ore Sắt
                if($block->getId() == 15){
                    $ev->setDrops([]);
                    $item = Item::get(15, 0, isset($fortune) ? mt_rand(1, $fortune) : 1);
                    if($player->getInventory()->canAddItem($item)){
                        $player->getInventory()->addItem($item);                
                    }
                    return true;
                }
                //Đào Nhận Ore Vàng
                if($block->getId() == 16){
                    $ev->setDrops([]);
                    $item = Item::get(16, 0, isset($fortune) ? mt_rand(1, $fortune) : 1);
                    if($player->getInventory()->canAddItem($item)){
                        $player->getInventory()->addItem($item);                   
                    }
                    return true;
                }
                //Đào Nhận Ore Diamond
                if($block->getId() == 56){
                   $e-v>setDrops([]);
                    $item = Item::get(56, 0, isset($fortune) ? mt_rand(1, $fortune) : 1);
                    if($player->getInventory()->canAddItem($item)){
                        $player->getInventory()->addItem($item);               
                    }
                    return true;
                }
                //Đào Nhận Ore Emerald
                if($block->getId() == 129){
                    $ev->setDrops([]);
                    $item = Item::get(129, 0, isset($fortune) ? mt_rand(1, $fortune) : 1);
                    if($player->getInventory()->canAddItem($item)){
                        $player->getInventory()->addItem($item);               
                    }
                    return true;
                }
                //Đào Nhận Ore Lapis
                if($block->getId() == 21){
                    $ev->setDrops([]);
                    $item = Item::get(21, 4, isset($fortune) ? mt_rand(1, $fortune) : 1);
                    if($player->getInventory()->canAddItem($item)){
                        $player->getInventory()->addItem($item);                   
                    }
                    return true;
                }
                //Đào Nhận Ore Redstone
                if($block->getId() == 73){
                    $ev->setDrops([]);
                    $item = Item::get(73, 0, isset($fortune) ? mt_rand(1, $fortune) : 1);
                    if($player->getInventory()->canAddItem($item)){
                        $player->getInventory()->addItem($item);                   
                    }
                    return true;
                }
                }else{
                return true;
                }
            }
        }
	}
    
    //Uống Thuốc Chống Virus
	public function onUse(PlayerInteractEvent $ev){
        $player = $ev->getPlayer();
        $name = $player->getName();
        $inv = $player->getInventory();
        $item = $inv->getItemInHand();
        $iditem = $item->getId();
        $idblock = $ev->getBlock()->getId();
        if($iditem ==  374){
            if(!in_array($idblock, array(8, 9)))return false;
            $newitem = Item::get(373, 0, 1);
            $newitem->setCustomName("§l§bThuốc Chống Virus"); 
            $newitem->setLore(array("§a§lTác dụng:§b Tăng Cường Sức Khỏe, Chống Lại Virus"));
            $inv->setItemInHand(Item::get(0, 0, 1));
            $inv->addItem($newitem);
        }
        if($iditem == 373){
            $virustime =  $this->virustime->get($name);
            if($virustime < 500){
                sleep(0.7);
                $virustime = $virustime + 250; 
                if($virustime > 500) $virustime = 1000;
                $inv->setItemInHand(Item::get(374, 0, 1));
                $this->virustime->set($name, $virustime); 
            }else{
                $ev->setCancelled(true);
            }
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
    	switch($cmd->getName()){
    		case "shire":
    		if(!$sender instanceof Player){
                $sender->sendMessage("§cHãy Sử Dụng Lệnh Trong Trò Chơi");
                return true;
            }
            if(!$sender->hasPermission("shire.command")){
             $sender->sendMessage("§l§c●§e Bạn Cần Mua Vé Qua§a Xứ Shire§e Để Qua§a Xứ Shire");
             $sender->sendPopup("§l§c●§e Mua Vé Bằng Lệnh§b /choden §c●");
            }else{
            $x = $this->plugin->getServer()->getLevelByName($this->getConfig()->get("shire-world"))->getSafeSpawn()->getFloorX();
            $y = $this->plugin->getServer()->getLevelByName($this->getConfig()->get("shire-world"))->getSafeSpawn()->getFloorY();
            $z = $this->plugin->getServer()->getLevelByName($this->getConfig()->get("shire-world"))->getSafeSpawn()->getFloorZ();
            $player->teleport(new Position($x, $y, $z, Server::getInstance()->getLevelByName($this->getConfig()->get("shire-world"))));
            $sender->sendMessage("§l§c●§e Bạn Đã Dịch Chuyển Qua§a Xứ Shire !");
            $sender->addTitle("§l§6✦§a Bạn Đã Tới Xứ Shire §6✦");
            }
    	    break;
    	    case "virus":
            if(!$sender instanceof Player){
                $sender->sendMessage("§cHãy Sử Dụng Lệnh Trong Trò Chơi");
                return true;
            }else{
                $this->VirtusForm($sender);
            }
            break;
            case "choden":
            if(!$sender instanceof Player){
                $sender->sendMessage("§cHãy Sử Dụng Lệnh Trong Trò Chơi");
                return true;
            }else{
            	$this->ChodenForm($sender);
            }
            break;
    	}
    }

    public function VirusMenu($player){
    	$form = new SimpleForm(function(Player $player, $data){
            if($data === null){
           	    return true;
            }
            switch($data){
           	    case 0:
           	    	$this->MuaThuocChongVirus($player);
           	    break;
           	    case 1:
           	        $this->TiemVaccine($player);
                break;
                case 2:
                break;
            }
    	});
    	$form->setTitle("§l§6✦§2 Virus §6✦");
    	$form->addButton("§l§3●§2 Mua Thuốc §3●", 0, "https://cdn-icons.flaticon.com/png/128/647/premium/647237.png?token=exp=1635902489~hmac=b5b84d1cc7d7b0ac6dc2a891c22975fa");
    	$form->addButton("§l§3●§2 Tiêm Vaccine §3●", 0, "https://cdn-icons.flaticon.com/png/128/4191/premium/4191422.png?token=exp=1635902581~hmac=09e9ebd842b7bfd30a2be190b54b6cd2");
    	$form->addButton("§l§3●§4 Thoát §3●", 0, "https://cdn-icons.flaticon.com/png/128/2168/premium/2168442.png?token=exp=1635902620~hmac=686df9229fe41278540d21863be85bea");
    }

    public function MuaThuocChongVirus($player){
    	$inv = $player->getInventory();
        $item = $inv->getItemInHand();
    	$money = $this->money->myMoney($player);
    	$cost = $this->getConfig()->get("medicine-cost");
    	if($money >= $cost){
    		$this->money->reduceMoney($player, $cost);
    		$medicine = Item::get(373, 0, 1);
            $medicine->setCustomName("§l§bThuốc Chống Virus"); 
            $medicine->setLore(array("§a§lTác dụng:§b Tăng Cường Sức Khỏe, Chống Lại Virus"));
            $inv->addItem($medicine);
            $player->sendMessage("§l§c●§e Bạn Đã Mua Mua§b Thuốc Chống Virus§a Thành Công !");
    	}else{
    		$player->sendMessage("§l§c●§e Bạn Không Đủ Tiền Để Mua§a Thuốc");
    	}
    }

    public function TiemVaccine($player){
    	$money = $this->money->myMoney($player);
    	$cost = $this->getConfig()->get("vaccine-cost");
    	if($money >= $cost){
    		$this->money->reduceMoney($player, $cost);
    		$this->virustime->set(strtolower($player->getName()), 1000);
    		$player->sendMessage("§l§c●§e Bạn Đã Mua Mua§b Vaccine§a Thành Công !");
    	}else{
    		$player->sendMessage("§l§c●§e Bạn Không Đủ Tiền Để Mua§a Vaccine");
    	}
    }

    public function ChodenForm($player){
        $form = new SimpleForm(function(Player $player, $data){
        if($data === null){
          return;
        }
        $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender, "setuperm ".$player->getName()." "$this->getConfig()->get(["Choden"]["Permissions"]));
        });
        for($i = 0;$i <= 20 ;$i++){
            if($this->getConfig()->exists($i)){
               $form->addButton($this->getConfig()->get(strtolower($i))["Choden"]["Button"]); 
            }
        }
        $form->setTitle("§l§6✦§2 Chợ Đen §6✦");
        $form->sendToPlayer($player);
    }
}