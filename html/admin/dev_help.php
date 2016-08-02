<div class="wrap">
    <table class="table">
        <thead>
            <tr> <th>For</th> <th>Description</th> </th>
        </thead>
        <tbody>
            <tr>
                <td>
                    Creating Admin Main Menu Page
                </td>
                <td>
                    <ol>
                        <li>
                            Creating Admin `Main Menu`
                            <ol>
                                <li>
                                    Create file with respect to inside the class folder `adminMainMenu`
                                </li>
                                <li>
                                    Use copy of existing file
                                </li>
                            </ol>
                        </li>
                        <li>
                            Page for admin main menu
                            <ol>
                                <li></li>
                            </ol>
                        </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td>
                    Creating Ajax Url
                </td>
                <td>
                    <?php
                        $ajaxActionName = \wpPluginSkeletonClass\skull::retrieve('ajax_action');
                    ?>
                    <ol>
                        <li>Knowing ajax action
                            <br /> Current ajax action is: <?php echo "<b>".$ajaxActionName."</b>"; ?> <i>(Can able to change by editing variable "$pluginName" in main plugin file)</i>
                        </li>
                        <li>
                            Creating do action file and setting permission
                            <ol>
                                <li>Create file with respect to `plugin class` folder inside `ajaxAction`<br /> Eg. <?php echo plugin_dir_path(dirname(dirname(__FILE__))); ?>wp-plugin-skeleton-class<?php echo DIRECTORY_SEPARATOR; ?>ajaxAction<?php echo DIRECTORY_SEPARATOR; ?><b>public</b>AjaxAction.php (Whereas "public" is `do action`)</li>
                            </ol>
                        </li>
                        <li>
                            Generating Wordpress Nonce to prevent un authorized access
                            <ol>
                                <li>site_url(wp_nonce_url('/wp-admin/admin-ajax.php?action=<?php echo $ajaxActionName; ?>&do=public', '<?php echo $ajaxActionName; ?>'))<br />Eg. <span><?php echo site_url(wp_nonce_url('/wp-admin/admin-ajax.php?action='.$ajaxActionName.'&do=public', $ajaxActionName)); ?></span></li>
                            </ol>
                        </li>
                    </ol>
                </td>
            </tr>
        </tbody>
    </table>
</div>