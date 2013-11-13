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
require_once ('ModelDeleteSpam.php');

function deletespam_install()
{
	osc_set_preference('cron_time', 'cron_hourly', 'deletespam', 'STRING');
}
function deletespam_uninstall()
{
	osc_delete_preference('cron_time', 'deletespam');
}
function deletespam_cron()
{
	$allItems = ModelDeleteSpam::newInstance()->getSpamItemCron();
	foreach($allItems as $itemA)
	{
		$item = Item::newInstance()->listWhere("i.pk_i_id = '%s' AND ((i.s_secret = '%s') OR (i.fk_i_user_id = '%d')) AND b_spam = 1", $itemA['pk_i_id'], $itemA['s_secret'], $itemA['fk_i_user_id']);
		if (count($item) == 1)
		{
			$mItems = new ItemActions(true);
			$success = $mItems->delete($item[0]['s_secret'], $item[0]['pk_i_id']);
		}
	}
}
function get_cron_time_Hourly()
{
	$allHourlyTimes = ModelDeleteSpam::newInstance()->GetCronTimeHourly();
	foreach($allHourlyTimes as $allHourlyTime)
	{
		$Hourlytime = $allHourlyTime['d_next_exec'];
	}
	return $Hourlytime;
}
function get_cron_time_Daily()
{
	$allDailyTimes = ModelDeleteSpam::newInstance()->GetCronTimeDaily();
	foreach($allDailyTimes as $allDailyTime)
	{
		$Dailytime = $allDailyTime['d_next_exec'];
	}
	return $Dailytime;
}
function get_cron_time_Weekly()
{
	$allWeeklyTimes = ModelDeleteSpam::newInstance()->GetCronTimeWeekly();
	foreach($allWeeklyTimes as $allWeeklyTime)
	{
		$Weeklytime = $allWeeklyTime['d_next_exec'];
	}
	return $Weeklytime;
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
	osc_admin_menu_plugins(__('Settings', 'deletespam') , osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'conf.php') , 'deletespam-setings', $capability = null, $icon_url = null);
}
// HOOKS FOR CRON
$cronSetting = osc_get_preference('cron_time', 'deletespam');
if ($cronSetting == "cron_hourly")
{
	osc_add_hook('cron_hourly', 'deletespam_cron');
}
elseif ($cronSetting == "cron_daily")
{
	osc_add_hook('cron_daily', 'deletespam_cron');
}
elseif ($cronSetting == "cron_weekly")
{
	osc_add_hook('cron_weekly', 'deletespam_cron');
}
elseif ($cronSetting == "immediately")
{
	osc_add_hook('item_spam_on', 'deletespam_cron') . osc_run_hook('item_spam_on', 'deletespam_cron');
}
elseif ($cronSetting == "disable")
{
	'';
}
// HOOKS FOR PLUGIN INSTALL
osc_register_plugin(osc_plugin_path(__FILE__) , 'deletespam_install');
osc_add_hook(osc_plugin_path(__FILE__) . "_configure", 'deletespam_admin_configure');
osc_add_hook(osc_plugin_path(__FILE__) . "_uninstall", 'deletespam_uninstall');
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
?>
