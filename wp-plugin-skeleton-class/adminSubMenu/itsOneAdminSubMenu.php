<?php

namespace wpPluginSkeletonClass\adminSubMenu;
use wpPluginSkeletonClass\gear;

/**
 * @parent_slug = wp-plugin-skeleton
 * @slug = wp-ps-1
 * @page_title= One
 * @menu_title= Sub menu 1
 * @type =main_menu
 * @permission=manage_options
 * @position = 1
 */
class itsOneAdminSubMenu {
    public function ignite(){
        echo gear::renderAdminView('sub_menu/sub_menu_1');
    }
}