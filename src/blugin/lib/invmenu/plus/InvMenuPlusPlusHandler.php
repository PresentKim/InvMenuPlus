<?php

/*
 *
 *  ____  _             _         _____
 * | __ )| |_   _  __ _(_)_ __   |_   _|__  __ _ _ __ ___
 * |  _ \| | | | |/ _` | | '_ \    | |/ _ \/ _` | '_ ` _ \
 * | |_) | | |_| | (_| | | | | |   | |  __/ (_| | | | | | |
 * |____/|_|\__,_|\__, |_|_| |_|   |_|\___|\__,_|_| |_| |_|
 *                |___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  Blugin team
 * @link    https://github.com/Blugin
 * @license https://www.gnu.org/licenses/lgpl-3.0 LGPL-3.0 License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace blugin\lib\invmenu\plus;

use blugin\lib\invmenu\plus\metadata\DoubleBlockInvMenuPlusMetadata;
use blugin\lib\invmenu\plus\metadata\SingleBlockInvMenuPlusPlusMetadata;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIds;
use pocketmine\network\mcpe\protocol\types\WindowTypes;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\tile\Tile;

class InvMenuPlusPlusHandler{
    public const TYPE_CHEST = "invmenuplus:chest";
    public const TYPE_DOUBLE_CHEST = "invmenuplugs:double_chest";
    public const TYPE_HOPPER = "invmenuplus:hopper";

    /** @var bool */
    private static $registered = false;

    public static function isRegistered() : bool{
        return self::$registered;
    }

    public static function register(Plugin $plugin) : void{
        if(!InvMenuHandler::isRegistered()){
            InvMenuHandler::register($plugin);
        }

        if(self::isRegistered())
            return;

        InvMenuHandler::registerMenuType(new SingleBlockInvMenuPlusPlusMetadata(self::TYPE_CHEST, 27, WindowTypes::CONTAINER, BlockFactory::get(BlockIds::CHEST), Tile::CHEST));
        InvMenuHandler::registerMenuType(new DoubleBlockInvMenuPlusMetadata(self::TYPE_DOUBLE_CHEST, 54, WindowTypes::CONTAINER, BlockFactory::get(BlockIds::CHEST), Tile::CHEST));
        InvMenuHandler::registerMenuType(new SingleBlockInvMenuPlusPlusMetadata(self::TYPE_HOPPER, 5, WindowTypes::HOPPER, BlockFactory::get(BlockIds::HOPPER_BLOCK), "Hopper"));

        Server::getInstance()->getPluginManager()->registerEvents(InvMenuPlusEventHandler::getInstance(), $plugin);
    }
}
