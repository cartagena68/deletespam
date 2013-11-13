<?php

/*
Plugin Name: Delete Spam
Plugin URI: http://www.osclass.org/
Description: Delete spam ads by cron!
Version: 0.0.1
Author: cartagena68
Author URI: https://github.com/cartagena68
Short Name: deletespam
Plugin update URI: delete-spam
*/

require_once('ModelDeleteSpam.php');


function deletespam_cron()
                {
                $allItems = ModelDeleteSpam::newInstance()->getSpamItemCron();
                
                foreach ($allItems as $itemA)
                                {
                                
                                $item = Item::newInstance()->listWhere("b_spam = 1");
                                if (count($item) >= 1)
                                                {
                                                $mItems  = new ItemActions(true);
                                                $success = $mItems->delete($item[0]['s_secret'], $item[0]['pk_i_id']);
                                                
                                                } 
                                }
                }

function deletespam_admin_configure()
                {
                osc_admin_render_plugin(osc_plugin_path(osc_plugin_folder(__FILE__)) . 'conf.php');
                }

function deletespam_admin_menu_old()
                {
                echo '<h3><a href="#">Delete Spam</a></h3>
                          <ul>
                          <li><a href="' . osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'conf.php') . '">&raquo; ' . __('Settings', 'deletespam') . '</a></li>
                  </ul>';
                }

function deletespam_admin_menu()
                {
                osc_add_admin_submenu_divider('plugins', 'Delete Spam', 'deletespam', $capability = null);
                osc_admin_menu_plugins(__('Settings', 'deletespam'), osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'conf.php'), 'deletespam-setings', $capability = null, $icon_url = null);
                
                }


// HOOKS PLUGIN ADMIN
osc_register_plugin(osc_plugin_path(__FILE__), '');
osc_add_hook(osc_plugin_path(__FILE__) . "_configure", 'deletespam_admin_configure');
osc_add_hook(osc_plugin_path(__FILE__) . "_uninstall", '');
osc_add_hook('admin_menu_init', 'deletespam_admin_menu');


// FANCY MENU
if (osc_version() < 320)
                {
                osc_add_hook('admin_menu', 'deletespam_admin_menu_old');
                }
else
                {
                osc_add_hook('admin_menu_init', 'deletespam_admin_menu');
                }
				
//HOOKS FOR CRON
// UNCOMMENT THE TYPE OF CRON YOU WANT
      osc_add_hook('cron_hourly', 'deletespam_cron');
    //osc_add_hook('cron_daily', 'deletespam_cron');
    //osc_add_hook('cron_weekly', 'deletespam_cron');
	
// UNCOMMENT IF YOU WANT TO DELETE THE AD AS SOON IS MARKED AS SPAM
	//osc_add_hook('item_spam_on', 'deletespam_cron').osc_run_hook('item_spam_on', 'deletespam_cron');

?>
