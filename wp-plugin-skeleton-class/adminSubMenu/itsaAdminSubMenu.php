<?php

namespace wpPluginSkeletonClass\adminSubMenu;

/**
 * @parent_slug = wp-plugin-skeleton
 * @slug = wp-ps-2
 * @page_title= Two
 * @menu_title= Sub menu 2
 * @type =main_menu
 * @permission=manage_options
 * @icon_url = __plugin_URL__/assets/images/gear.png
 * @position = 2
 */
class itsaAdminSubMenu {
    public function ignite(){
        echo "@=Testing sub menu...";
    }
}