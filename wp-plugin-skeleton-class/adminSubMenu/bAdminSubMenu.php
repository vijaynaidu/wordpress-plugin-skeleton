<?php

namespace wpPluginSkeletonClass\adminSubMenu;
use wpPluginSkeletonClass\gear;

/**
 * @parent_slug = wp-plugin-skeleton
 * @slug = wp-ps-3
 * @page_title= Three
 * @menu_title= Sub menu 3
 * @type =main_menu
 * @permission=manage_options
 * @position = 3
 */
class bAdminSubMenu {
    public function ignite(){
        echo gear::renderAdminView('sub_menu/sub_menu_3');
    }
}