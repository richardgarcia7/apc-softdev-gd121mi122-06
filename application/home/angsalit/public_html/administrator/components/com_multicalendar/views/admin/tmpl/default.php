<?php 
/**
* @Copyright Copyright (C) 2010 CodePeople, www.codepeople.net
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
*
* This file is part of Multi Calendar for Joomla <www.joomlacalendars.com>.
* 
* Multi Calendar for Joomla is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Multi Calendar for Joomla  is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Multi Calendar for Joomla.  If not, see <http://www.gnu.org/licenses/>.
*
**/

defined('_JEXEC') or die('Restricted access'); 
require_once( JPATH_COMPONENT_SITE.'/DC_MultiViewCal/php/list.inc.php' );
global $arrayJS_list;
global $JC_JQUERY_SPECIAL ;
$mainframe  =& JFactory::getApplication();
?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
    $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
    $id = $cid[0];
    $db =& JFactory::getDBO();
    $db->setQuery( "select palettes,administration from #__dc_mv_configuration where id=1" );
    $rows = $db->loadObjectList();
    $palettes = unserialize($rows[0]->palettes);
    $admin = unserialize($rows[0]->administration);
    $newp = "";
    if (count($palettes) > $admin["paletteColor"])
    {
        $newp .= ", palette:".$admin["paletteColor"]."";   
        $newp .= ", paletteDefault:\"".$palettes[$admin["paletteColor"]]["default"]."\"";   
    }
    
    $query = 'select * from #__dc_mv_calendars'
        . ' WHERE id = '. $id  ;
    
    $db->setQuery( $query );    
    $rows = $db->loadObjectList();
    if (count($rows)>0){
	    JToolBarHelper::title(   $rows[0]->title . JText::_('COMMULTICALENDAR_TITLE_DASH_ADMIN'), "multicalendar-management" );
    }
	JToolBarHelper::cancel( 'cancel', JText::_('Close') );
    
	JToolBarHelper::help( 'screen.multicalendar.admin', true );
	
	$language = $mainframe->getCfg('language');
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return false;
		}
		if (pressbutton=='addMulti') {
			YAHOO.DC.MultiCalendar.showAddEvent('<?php echo $id?>','cal<?php echo $id?>Admin',-1);
		}
		if (pressbutton=='listMulti') {
			YAHOO.DC.MultiCalendar.showEventlist('<?php echo $id?>','cal<?php echo $id?>Admin',1);
		}
		return false;
	}
	<?php echo getlist("dc_subjects",$rows[0]->subjectlist,(isset($admin["subjectlist"])?$admin["subjectlist"]:"")).getlist("dc_locations",$rows[0]->locationlist,(isset($admin["locationlist"])?$admin["locationlist"]:""));?>
	
</script>
<?php if (JC_JQUERY_MV) {?>
<script language='JavaScript' type='text/javascript' src='../components/com_multicalendar/DC_MultiViewCal/js/jquery-1.7.2.min.js'></script>
<script language='JavaScript' type='text/javascript' src='../components/com_multicalendar/DC_MultiViewCal/js/jquery-ui-1.8.20.custom.min.js'></script>
<?php 
}
else
    for ($i=0;$i<count($JC_JQUERY_SPECIAL);$i++)
    {
        if(!empty($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"]!=="off"))
                    $JC_JQUERY_SPECIAL[$i] = str_replace("http://","https://",$JC_JQUERY_SPECIAL[$i]);
        echo "<script language='JavaScript' type='text/javascript' src='".$JC_JQUERY_SPECIAL[$i]."'></script>";
    }
?>
<script language='JavaScript' type='text/javascript' src='../components/com_multicalendar/DC_MultiViewCal/src/Plugins/underscore.js'></script>
<script language='JavaScript' type='text/javascript' src='../components/com_multicalendar/DC_MultiViewCal/src/Plugins/rrule.js'></script>
<script language='JavaScript' type='text/javascript' src='../components/com_multicalendar/DC_MultiViewCal/src/Plugins/Common.js'></script>
<?php if (file_exists("../components/com_multicalendar/DC_MultiViewCal/language/multiview_lang_".$mainframe->getCfg('language').".js")){?>
    <script language='JavaScript' type='text/javascript' src='../components/com_multicalendar/DC_MultiViewCal/language/multiview_lang_<?php echo $mainframe->getCfg('language');?>.js'></script>
<?php }else{ ?>
    <script language='JavaScript' type='text/javascript' src='../components/com_multicalendar/DC_MultiViewCal/language/multiview_lang_en-GB.js'></script>
<?php }?>
<script language='JavaScript' type='text/javascript' src='../components/com_multicalendar/DC_MultiViewCal/src/Plugins/jquery.calendar.js'></script>
<script language='JavaScript' type='text/javascript' src='../components/com_multicalendar/DC_MultiViewCal/src/Plugins/jquery.alert.js'></script>
<script language='JavaScript' type='text/javascript' src='../components/com_multicalendar/DC_MultiViewCal/src/Plugins/multiview.js'></script>

<?php
if (file_exists("../components/com_multicalendar/DC_MultiViewCal/css/".$admin["cssStyle"]."/calendar.css")){
?>
<link rel="stylesheet" href="../components/com_multicalendar/DC_MultiViewCal/css/<?php echo $admin["cssStyle"]?>/calendar.css" type="text/css" />
<?php }else{ ?>
<link rel="stylesheet" href="../components/com_multicalendar/DC_MultiViewCal/css/cupertino/calendar.css" type="text/css" />
<?php }?>
<link rel="stylesheet" href="../components/com_multicalendar/DC_MultiViewCal/css/main.css" type="text/css" />

<div id="multicalendar"><div id="cal<?php echo $id?>" class="multicalendar"></div></div>
<script type="text/javascript">
var pathCalendarRootPic = "<?php echo JURI::root();?>";
initMultiViewCal("cal<?php echo $id?>",<?php echo $id?>,
{viewDay:<?php echo (in_array("viewDay",$admin["views"]))?"true":"false"?>,
viewWeek:<?php echo (in_array("viewWeek",$admin["views"]))?"true":"false"?>,
viewMonth:<?php echo (in_array("viewMonth",$admin["views"]))?"true":"false"?>,
viewNMonth:<?php echo (in_array("viewNMonth",$admin["views"]))?"true":"false"?>,
viewList:<?php echo (in_array("viewList",$admin["views"]))?"true":"false"?>,
viewdefault:"<?php echo $admin["viewdefault"]?>",
numberOfMonths:<?php echo $admin["numberOfMonths"]?>,
showtooltip:<?php echo ($admin["sample0"]=="1")?"true":"false"?>,
tooltipon:<?php echo ($admin["sample1"]!="mouseover")?"1":"0"?>,
shownavigate:<?php echo ($admin["sample2"]=="1")?"true":"false"?>,
url:"<?php echo $admin["sample3"]?>",
target:<?php echo ($admin["sample4"]!="new_window")?"1":"0"?>,
start_weekday:<?php echo $admin["start_weekday"]?>,
language:"<?php echo $mainframe->getCfg('language');?>",
cssStyle:"<?php echo $admin["cssStyle"]?>",
edition:true,
btoday:<?php echo ($admin["btoday"]=="1")?"true":"false"?>,
bnavigation:<?php echo ($admin["bnavigation"]=="1")?"true":"false"?>,
brefresh:<?php echo ($admin["brefresh"]=="1")?"true":"false"?>,
bnew:true,
path:"<?php echo  JURI::root()?>",
<?php if (isset($admin["additional_parameters"]) && $admin["additional_parameters"]!="") echo $admin["additional_parameters"].",";?>
userAdd:true,
            userEdit:true,
            userDel:true,
            userEditOwner:true,
            userDelOwner:true,
            userOwner:-1 <?php echo $newp;?>});
</script>

<form action="index.php?option=com_multicalendar" method="post" name="adminForm" id="adminForm">
    <input type="hidden" name="task" value="" />
	<input type="hidden" name="option" value="com_multicalendar" />
	<input type="hidden" name="id" value="<?php echo $this->calendar->id; ?>" />
	<input type="hidden" name="cid[]" value="<?php echo $this->calendar->id; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>