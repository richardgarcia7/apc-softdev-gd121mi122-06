<?php
/**
 *------------------------------------------------------------------------------
 *  iCagenda v3 by Jooml!C - Events Management Extension for Joomla! 2.5 / 3.x
 *------------------------------------------------------------------------------
 * @package     com_icagenda - mod_iccalendar
 * @copyright   Copyright (c)2012-2014 Cyril Rezé, Jooml!C - All rights reserved
 *
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Cyril Rezé (Lyr!C) - doorknob
 * @link        http://www.joomlic.com
 *
 * @version     3.3.3 2014-04-11
 * @since       1.0
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *------------------------------------------------------------------------------
*/

/**
 *	iCagenda - iC calendar
 */


// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.environment.request' );

// Get Document
$document	= JFactory::getDocument();

// Test if translation is missing, set to en-GB by default
$language= JFactory::getLanguage();
$language->load( 'mod_iccalendar', JPATH_SITE, 'en-GB', true );
$language->load( 'mod_iccalendar', JPATH_SITE, null, true );

// Include the class of the syndicate functions only once
if(!class_exists('modiCcalendarHelper'))require_once(dirname(__FILE__).'/helper.php');

// Module ID
$modid		= $module->id;

// Module
$cal		= new modiCcalendarHelper;
$data		= $cal->getStamp($params);
$url_date	= JRequest::getVar('date');
$iccaldate	= JRequest::getVar('iccaldate');


//function GetNbDays ($month = null, $year = null)
//{
//	$month = ($month) ? $month : date('m');
//	$year = ($year) ? $year : date('Y');

//	return intval(date("t",strtotime("$year-$month-01")));
//}


// First day of the current month
$this_month = date('Y-m-01');

if (isset($iccaldate)&&(!empty($iccaldate)))
{
	// This should be the first day of a month
	$date_start = date('Y-m-01', strtotime($iccaldate));
}
//elseif (isset($url_date)&&(!empty($url_date)))
//{
//	$dateget = explode ('-', $url_date);
//	$year_ajust = $dateget['0'];
//	$month_ajust = $dateget['1'];
//	$day_ajust = $dateget['2'];
//	$dateget = $year_ajust.'-'.$month_ajust.'-'.$day_ajust;
//	$time = strtotime($dateget);
//	$nbMdays = GetNbDays($month_ajust, $year_ajust);
//	echo $nbMdays;
//	$date_return = date("Y-m-d", strtotime("+1 month", $time));
//
//	$date_start = $dateget;
//}
else
{
	$date_start	= $this_month;
}

$nav = $cal->getNav($date_start, $modid);

// Params of the Module iC Calendar
$moduleclass_sfx	= htmlspecialchars($params->get('moduleclass_sfx'));
$mouseover			= $params->get('mouseover');
$mon				= $params->get('mon', ' ');
$tue				= $params->get('tue', ' ');
$wed				= $params->get('wed', ' ');
$thu				= $params->get('thu', ' ');
$fri				= $params->get('fri', ' ');
$sat				= $params->get('sat', ' ');
$sun				= $params->get('sun', ' ');
$firstday			= $params->get('firstday');
$calfontcolor		= $params->get('calfontcolor', ' ');
$OneEventbgcolor	= $params->get('OneEventbgcolor', ' ');
$Eventsbgcolor		= $params->get('Eventsbgcolor', ' ');
$bgcolor			= $params->get('bgcolor', ' ');
$bgimage			= $params->get('bgimage');
$bgimagerepeat		= $params->get('bgimagerepeat');
$closebutton		= $params->get('calendarclosebtn', 1);
$closebutton_custom	= $params->get('calendarclosebtn_Content', 'X');
$template			= $params->get('template', 'default');

$setTodayTimezone	= $params->get('setTodayTimezone', '');

// Ordering set by default (time/category) - Option in developpement (Not used)
$events_ordering_first	= $params->get('events_ordering_first', '1_ASC');
$events_ordering_second	= $params->get('events_ordering_second', '2_ASC');
$ictip_ordering			= $events_ordering_first.'-'.$events_ordering_second;

$header_text			= $params->get('header_text', '');
$padding				= $params->get('padding', '0');

// Set first day
if ($firstday == NULL) {
	$firstday = '1';
}
if ($firstday == '0') {
	$na=7;$nb=1;$nc=2;$nd=3;$ne=4;$nf=5;$ng=6;
}

if ($firstday == '1') {
	$na=1;$nb=2;$nc=3;$nd=4;$ne=5;$nf=6;$ng=7;
}

// Search template of iC Calendar from the selected Theme Pack
if(!file_exists(JPATH_ROOT.'/components/com_icagenda/themes/packs/'.$template.'/'.$template.'_calendar.php')){
	$template='default';
}
$t_calendar = JPATH_BASE.'/components/com_icagenda/themes/packs/'.$template.'/'.$template.'_calendar.php';

// ToolTip 2 in developpement (Not used)
$tip_type = '1';
if ($tip_type == 1) {
	$t_day = JPATH_BASE.'/components/com_icagenda/themes/packs/'.$template.'/'.$template.'_day.php';
} elseif ($tip_type == 2) {
	$t_day = JPATH_BASE.'/components/com_icagenda/themes/packs/'.$template.'/'.$template.'_calendar_tip.php';
}

// Load Theme Pack css
$document->addStyleSheet( 'components/com_icagenda/themes/packs/'.$template.'/css/'.$template.'_module.css' );

// Add the media specific CSS to the document
JLoader::register('iCagendaMediaCss', JPATH_ROOT . '/components/com_icagenda/helpers/media_css.class.php');
iCagendaMediaCss::addMediaCss($template, 'module');

// Load Vector iC icons font (navigation arrows)
$document->addStyleSheet( 'media/com_icagenda/icicons/style.css' );


if(version_compare(JVERSION, '3.0', 'ge'))
{
	// Request Joomla to load jQuery in no conflict mode
	JHtml::_('behavior.formvalidation');
	JHtml::_('bootstrap.framework');
	JHtml::_('jquery.framework');
}
else
{
	//Load JS
	JHTML::_('behavior.mootools');

	$header = $document->getHeadData();
	$loadJquery = true;
	switch($params->get('loadJquery',"auto"))
	{
		case "0":
			$loadJquery = false;
			break;
		case "1":
			$loadJquery = true;
			break;
		case "auto":
			foreach($header['scripts'] as $scriptName => $scriptData)
			{
				if(substr_count($scriptName,'jquery'))
				{
					$loadJquery = false;
					break;
				}
			}
			break;
	}

	//Add js
	$app = JFactory::getApplication();
	if($loadJquery && !$app->get('jquery')) {
		$document->addScript( 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js' );
		$app->set('jquery', true);
	}
	$document->addScript( 'modules/mod_iccalendar/js/jquery.noconflict.js' );
}

if (ini_get('allow_url_fopen')) {
	$file = file_get_contents($t_day);
	if(!strpos($file, "data-cal-date")) {
		$server_date = false;
		echo "<div class='alert alert-error'>'data-cal-date' not found in your Custom Theme Pack!</div>";
	} else {
		$server_date = true;
	}
}
else
{
	$server_date = true;
}

if (!$setTodayTimezone AND $server_date) {
	$document->addScript( 'modules/mod_iccalendar/js/jQuery.highlightToday.min.js' );
}


$icclasstip		= '.icevent a';
$icclass		= '.iccalendar';
$icagendabtn	= '.icagendabtn_'.$modid;
$mod_iccalendar	= '#mod_iccalendar_'.$modid;

if ($closebutton == 1) {
	$close_btn	= $closebutton_custom;
} else {
	$close_btn	= JText::_('MOD_ICCALENDAR_CLOSE');
}

// Minimum popup width for mobile phone mode
$mobile_min_width = 320;

//unset($stamp);

$stamp = new cal($data, $t_calendar, $t_day, $nav, $mon, $tue, $wed, $thu, $fri, $sat, $sun, $firstday, $calfontcolor,
		$OneEventbgcolor, $Eventsbgcolor, $bgcolor, $bgimage, $bgimagerepeat, $na, $nb, $nc, $nd, $ne, $nf, $ng,
		$moduleclass_sfx, $modid, $template, $ictip_ordering, $header_text);

// Joomla 2.5 < 3.0
//if(version_compare(JVERSION, '3.0', 'ge')
//	AND $attribs['style'] != 'xhtml')
//{
//	echo '<div class="' . $attribs['style'] . ' ' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
//	if ($module->showtitle)
//	{
//		echo '<h3 class="page-header">' . $module->title . '</h3>';
//	}
//}
//else
//{
//	echo '<div>';
//}

require $t_calendar;

//echo '</div>';

// Prepare the component parameter set to get the threshold width for mobile phone devices
jimport('joomla.application.component.helper');
$com_params = JComponentHelper::getParams('com_icagenda');
?>

<script type="text/javascript">
(function($){
	var icmouse = '<?php echo $mouseover; ?>';
	var icclasstip = '<?php echo $icclasstip; ?>';
	var icclass = '<?php echo $icclass; ?>';
	var position = '<?php echo $params->get('position', 'center'); ?>';
	var posmiddle = '<?php echo $params->get('posmiddle', 'top'); ?>';
	var modid = '<?php echo $modid; ?>';
	var modidid = '<?php echo '#'.$modid; ?>';
	var icagendabtn = '<?php echo $icagendabtn; ?>';
	var mod_iccalendar = '<?php echo $mod_iccalendar; ?>';
	var template = '<?php echo '.'.$template; ?>';
	var loading = '<?php echo JText::_('MOD_ICCALENDAR_LOADING'); ?>';
	var closetxt = '<?php echo $close_btn; ?>';
	var tip_type = '<?php echo $tip_type; ?>';
	var tipwidth = <?php echo (int)$params->get('tipwidth', 390) ?>;
	var smallwidththreshold = <?php echo (int) $com_params->get('smallwidththreshold', 0) ?>;
	var verticaloffset = <?php echo (int)$params->get('verticaloffset', 0) ?>;
	var css_position = '';
	var mobile_min_width = <?php echo $mobile_min_width; ?>;
	var extra_css = '';

	$(document).on('click touchend', icagendabtn, function(e){<?php // Refresh the current month ?>
		e.preventDefault();

		url=$(this).attr('href');

		$(modidid).html('<div class="icloading_box"><div style="text-align:center;">' + loading + '<\/div><div class="icloading_img"><\/div><\/div>').load(url + ' ' + mod_iccalendar, function(){$('<?php echo $mod_iccalendar ?>').highlightToday();});

	});

	if (tip_type=='2') {<?php // Not used ?>
	$(document).on(icmouse, this, function(e){
		e.preventDefault();

		$(".iCaTip").tipTip({maxWidth: "400", defaultPosition: "top", edgeOffset: 1, activation:"hover", keepAlive: true});
	});
	}

	if (tip_type=='1') {<?php // Display the events popup ?>
		$view_width=$(window).width();<?php // Get the viewport width ?>
		if($view_width<smallwidththreshold){<?php // Mobile phones do not support 'hover' or 'click' in the conventional way ?>
			icmouse='click touchend';
		}

		$(document).on(icmouse, modidid+' '+icclasstip, function(e){
			$view_height=$(window).height();<?php // Get the viewport height ?>
			$view_width=$(window).width();<?php // Get the viewport width ?>
			e.preventDefault();
			$('#ictip').remove();
			$parent=$(this).parent();
			$tip=$($parent).children(modidid+' .spanEv').html();


			if($view_width<smallwidththreshold){<?php // Mobile phone style - fill the viewport ?>
				css_position='fixed';
				$width_px=Math.max(mobile_min_width,$view_width);<?php // Popup width is screen width (minimum 320px) ?>
				$width='100%';
				$pos='0px';
				$top='0px';
				extra_css='border:0;border-radius:0;height:100%;box-shadow:none;margin:0px;padding:10px;min-width:'+mobile_min_width+'px;overflow-y:scroll;padding:<?php echo $padding ?>;';<?php // iPhone friendly size and allow scrolling if the page overflows ?>
			}else{
				css_position='absolute';
				$width_px=Math.min($view_width, tipwidth);
				$width=$width_px+'px';

				switch(position){<?php // Horizontal positioning ?>
				case 'left':
					$pos=Math.max(0,$(modidid).offset().left-$width_px-10)+'px';
					break;
				case 'right':
					$pos=Math.max(0,Math.min($view_width-$width_px,$(modidid).offset().left+$(modidid).width()+10))+'px';
					break;
				default:<?php //Centre ?>
					$pos=Math.ceil(($view_width-$width_px)/2)+'px';
					break;
				}

				if(posmiddle==='top') {<?php // Vertical positioning ?>
					$top=Math.max(0,$(modidid).offset().top-verticaloffset)+'px';<?php // Top ?>
				}else{
					$top=Math.max(0,$(modidid).offset().top+$(modidid).height()-verticaloffset)+'px';<?php // Bottom ?>
				}
			}


			$('body').append('<div style="display:block; position:'+css_position+'; width:'+$width+'; left:'+$pos+'; top:'+$top+';'+extra_css+'" id="ictip"> '+$(this).parent().children('.date').html()+'<a class="close" style="cursor: pointer;"><div style="display:block; width:auto; height:50px; text-align:right;">' + closetxt + '<\/div></a><span class="clr"></span>'+$tip+'<\/div>');
			$(document).on('click touchend', '.close', function(e){
				e.preventDefault();
				$('#ictip').remove();
			});
		});
	}

}) (jQuery);
jQuery(document).ready(function($){
	$('<?php echo $mod_iccalendar ?>').highlightToday('show_today');
});
</script>
