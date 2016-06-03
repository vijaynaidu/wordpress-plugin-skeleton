<?php

namespace wpPluginSkeletonClass\adminMainMenu;
use wpPluginSkeletonClass\gear;

/**
 * @slug = wp-plugin-skeleton
 * @page_title= Wordpress Plugin Skeleton
 * @menu_title= Wordpress Plugin Skeleton
 * @type =main_menu
 * @permission=manage_options
 * @icon_url = __plugin_URL__/assets/images/gear.png
 * @position = null
 */
class wpPluginSkeletonAdminMainMenu {
    public function ignite(){
        echo gear::renderAdminView('wp-plugin-skeleton');
        //echo "@=Testing...";
    }
}