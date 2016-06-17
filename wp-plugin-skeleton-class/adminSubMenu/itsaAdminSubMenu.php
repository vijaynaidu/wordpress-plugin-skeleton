<?php

namespace wpPluginSkeletonClass\adminSubMenu;
use wpPluginSkeletonClass\gear;

/**
 * @parent_slug = wp-plugin-skeleton
 * @slug = wp-ps-2
 * @page_title= Two
 * @menu_title= Sub menu 2
 * @type =main_menu
 * @permission=manage_options
 * @position = 2
 */
class itsaAdminSubMenu {
    public function ignite(){
        echo gear::renderAdminView('sub_menu/sub_menu_2');
    }
}