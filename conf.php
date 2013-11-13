<?php
/*
 *      OSCLass – software for creating and publishing online classified
 *                           advertising platforms
 *
 *                        Copyright (C) 2010 OSCLASS
 *
 *       This program is free software: you can redistribute it and/or
 *     modify it under the terms of the GNU Affero General Public License
 *     as published by the Free Software Foundation, either version 3 of
 *            the License, or (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful, but
 *         WITHOUT ANY WARRANTY; without even the implied warranty of
 *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *             GNU Affero General Public License for more details.
 *
 *      You should have received a copy of the GNU Affero General Public
 * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

 if (Params::getParam('plugin_action') == 'clear')
                {
                deletespam_cron();
                echo '<div style="text-align:center; font-size:22px; background-color:#00bb00;"><p>' . __('The spam has been deleted', 'deletespam') . '.<a href="#" title="Close Message" onclick="parentNode.remove()" style="float:right;font-weight:bold;padding-right:50px;color:#FFFFFF;">' . __('x', 'deletespam') . '</a></p></div>';
                }

?>
<div>
    <div id="settings_form" style="width:100%; height:30px; padding:5px; border:1px solid #CCC; border-radius:5px; background:#EEE; font-size:18px; font-weight:bold;">
                                    <legend><?php
_e('Delete Spam Settings', 'deletespam');
?></legend>
    </div>
    <div style="padding:10px 10px 10px 0px;">
        <div style="float: left; width: 100%;">
     <pre> 
     <strong>WHAT THIS PLUGIN WILL DO</strong><br/>
      This plugin will delete all ads marked as spam by admin or, if you are using SpamKiller plugin, when the plugin mark the ad as spam,
      NOT when users mark as spam from item page.
      
      <strong>HOW TO SET THE CRON</strong><br/>      
      The cron is pre set to hourly.
      If you whant to change it you need to open the file index.php of the plugin and find //HOOKS FOR CRON at the end of the page then
      uncomment the cron you want.
      There are four types of hooks, the first three are cron releted, the fourth don't use cron, but delete the ad as soon is marked as spam.
      Just uncomment one of them and leave the other three commented to avoid server load.
      You can also leave all four commented and manually delete the spam.
      
      This plugin is usefull if you have installed the plugin SpamKiller.
      </pre>
          
                       
                    
                                <p style=" font-size:16px; font-weight:700;"><?php
_e('Delete Spam Manually', 'deletespam');
?></p>
                            <form name="deletespam_form" id="deletespam_form" action="<?php
echo osc_admin_base_url(true);
?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="page" value="plugins" />
                                <input type="hidden" name="action" value="renderplugin" />
                                <input type="hidden" name="file" value="<?php
echo osc_plugin_folder(__FILE__);
?>conf.php" />
                                <input type="hidden" name="plugin_action" value="clear" />
                                
                                                        
                                <p><button style="font-size:16px; font-weight:bold;" type="submit" ><?php
_e('Delete Spam', 'deletespam');
?></button></p>
                            </form>
                    
        </div>
        
    </div>
<div>
