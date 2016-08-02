<?php

namespace wpPluginSkeletonClass\adminSubMenu;
use wpPluginSkeletonClass\gear;

/**
 * @parent_slug = wp-plugin-skeleton
 * @slug = dev-help
 * @page_title= Development Help
 * @menu_title= Help
 * @type =main_menu
 * @permission=manage_options
 * @position = 100
 */
class bAdminSubMenu {
    public function ignite(){
        echo gear::renderAdminView('dev_help');
    }
}