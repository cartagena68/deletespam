Delete Spam for OsClass
=======================
<strong>WHAT THIS PLUGIN WILL DO</strong><br/>

This plugin will delete all ads marked as spam by admin or, if you are using SpamKiller plugin, when the plugin
mark the ad as spam,NOT when users mark as spam from item page.
      
<strong>HOW TO SET THE CRON</strong><br/> 

The cron is pre set to hourly.
If you whant to change it you need to open the file index.php of the plugin and find //HOOKS FOR CRON at the end
of the page then uncomment the cron you want.
There are four types of hooks, the first three are cron releted, the fourth don't use cron, but delete the ad as
soon is marked as spam.
Just uncomment one of them and leave the other three commented to avoid server load.
You can also leave all four commented and manually delete the spam.
      
This plugin is usefull if you have installed the plugin SpamKiller.

