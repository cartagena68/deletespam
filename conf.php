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

if (Params::getParam('plugin_action') == 'done')
{
	osc_set_preference('cron_time', Params::getParam('cron_time') , 'deletespam', 'STRING');
	echo '<div style="text-align:center; font-size:22px; background-color:#00bb00;"><p>' . __('Congratulations. The plugin is now configured', 'deletespam') . '.<a href="#" title="Close Message" onclick="parentNode.remove()" style="float:right;font-weight:bold;padding-right:50px;color:#FFFFFF;">' . __('x', 'deletespam') . '</a></p></div>';
	osc_reset_preferences();
}
else if (Params::getParam('plugin_action') == 'clear')
{
	delete_spam_cron();
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

            

                        <fieldset>

                            <form name="deletespam_form" id="deletespam_form" action="<?php
echo osc_admin_base_url(true);
?>" method="POST" enctype="multipart/form-data" >

                                <div style="float: left; width: 100%;">

                                    <input type="hidden" name="page" value="plugins" />

                                    <input type="hidden" name="action" value="renderplugin" />

                                    <input type="hidden" name="file" value="<?php
echo osc_plugin_folder(__FILE__);
?>conf.php" />

                                    <input type="hidden" name="plugin_action" value="done" />

                                    <label for="cron_time" style="font-weight:700;font-size:16px;"><?php
_e('Set Cron Job', 'deletespam');
?></label>

                                            <br/><br/>

                                    <?php
$selectCron = osc_get_preference('cron_time', 'deletespam');
?>

                                   <input type="radio" name="cron_time" id="cron_time" value="cron_hourly" <?php
if ($selectCron == 'cron_hourly')
{
	echo ' checked';
}
?> /><span>Cron Hourly</span>

                                    <input type="radio" name="cron_time" id="cron_time" value="cron_daily" <?php
if ($selectCron == 'cron_daily')
{
	echo ' checked';
}
?> /><span>Cron Daily</span>

                                    <input type="radio" name="cron_time" id="cron_time" value="cron_weekly" <?php
if ($selectCron == 'cron_weekly')
{
	echo ' checked';
}
?> /><span>Cron Weekly</span>
							<br/>
                            <br/>
<strong>OR YOU CAN</strong><br/><br/>

									<input type="radio" name="cron_time" id="cron_time" value="immediately" <?php
if ($selectCron == 'immediately')
{
	echo ' checked';
}
?> /><span>Delete the ad as soon is marked as spam</span><br/>

									<input type="radio" name="cron_time" id="cron_time" value="disable" <?php
if ($selectCron == 'disable')
{
	echo ' checked';
}
?> /><span>Disable all cron</span>

                                            <br/>
                                            <br/>

                                            <br/>

                                    

                                </div>

                                <p><button style="font-size:16px; font-weight:700;" type="submit" ><?php
_e('Update', 'deletespam');
?></button></p>

                                            <br/>

                            </form>

                        </fieldset>

                    

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
                            <br/><br/>
                            <table style="font-size:16px" border="0">
                            <tr>
                            <td align="left">                           
                            <strong>Next hourly cron will run at:</strong>
                            </td>
                            <td align="left">
                            &nbsp;&nbsp;<?php echo get_cron_time_Hourly(); ?>
                            </td>
                            </tr>
                            <tr>
                            <td align="left">
                            <strong>Next daily cron will run at: </strong>
                            </td>
                            <td align="left">
							&nbsp;&nbsp;<?php echo get_cron_time_Daily(); ?>
                            </td>
                            </tr>
                            <tr>
                            <td align="left">
                            <strong>Next weekly cron will run at: </strong>
                            </td>
                            <td align="left">
                            &nbsp;&nbsp;<?php echo get_cron_time_weekly(); ?>
                            </td>
                            </tr>
                            </table>
                 </div>

        </div>

<div>
