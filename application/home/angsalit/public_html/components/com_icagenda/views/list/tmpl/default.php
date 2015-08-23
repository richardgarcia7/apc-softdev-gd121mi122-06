<?php
/**
 *------------------------------------------------------------------------------
 *  iCagenda v3 by Jooml!C - Events Management Extension for Joomla! 2.5 / 3.x
 *------------------------------------------------------------------------------
 * @package     com_icagenda
 * @copyright   Copyright (c)2012-2014 Cyril Rezé, Jooml!C - All rights reserved
 *
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Cyril Rezé (Lyr!C)
 * @link        http://www.joomlic.com
 *
 * @version 	3.3.8 2014-07-01
 * @since       1.0
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();

?>
<!--
 * - - - - - - - - - - - - - -
 * iCagenda 3.3.8 by Jooml!C
 * - - - - - - - - - - - - - -
 * @copyright	Copyright (c)2012-2014 JOOMLIC - All rights reserved.
 *
-->
<?php

// Get Application
$app = JFactory::getApplication();

//
// Old function for template 1.2.x.
//
function convertColor($color)
{
	#convert hexadecimal to RGB
	if(!is_array($color) && preg_match("/^[#]([0-9a-fA-F]{6})$/",$color))
	{
		$hex_R = substr($color,1,2);
		$hex_G = substr($color,3,2);
		$hex_B = substr($color,5,2);
		$RGB = hexdec($hex_R).",".hexdec($hex_G).",".hexdec($hex_B);
		return $RGB;
	}
	#convert RGB to hexadecimal
	else
	{
		if(!is_array($color)){$color = explode(",",$color);}

		foreach($color as $value)
		{
			$hex_value = dechex($value);
			if(strlen($hex_value)<2){$hex_value="0".$hex_value;}
			$hex_RGB='';
			$hex_RGB.=$hex_value;
		}
		return "#".$hex_RGB;
	}
}

$RGB='$RGB';
$RGBa=$RGB[0];
$RGBb=$RGB[1];
$RGBc=$RGB[2];
$item_color = '';
if (isset($item->cat_color)) {$item_color = $item->cat_color;}
$js_list = "media/com_icagenda/js/jsevt.js";
$RGB = explode(",",convertColor($item_color)); $a = array($RGBa, $RGBa, $RGBa);
$somme = array_sum($a);
//
// End old function

$iCModeliChelper = new iCModeliChelper();

$icsetvar = 'components/com_icagenda/add/elements/icsetvar.php';

$navposition = $this->navposition;
$datesDisplay_menu = $this->datesDisplay;
$datesDisplay_global = $this->datesDisplay_global;

if ($datesDisplay_menu)
{
	$datesDisplay = $datesDisplay_menu;
}
else
{
	$datesDisplay = $datesDisplay_global;
}

$orderby = $this->orderby;
$dis_catDesc = $this->display_catDesc;
$catDesc_opts = $this->catDesc_opts;
$CatDesc_global = $this->CatDesc_global;
$CatDesc_global_opts = $this->CatDesc_global_opts;
$pagination = $this->pagination;

if ($dis_catDesc == 'global')
{
	$display_catDesc = $CatDesc_global;
	$cat_opts = $CatDesc_global_opts;
}
else
{
	$display_catDesc = $dis_catDesc;
	$cat_opts = $catDesc_opts;
}

if (!is_array($cat_opts)) $cat_opts = array();

// Header
?>
<div id="icagenda<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1 class="componentheading">
	<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<?php
	if(isset($this->data)) $stamp = $this->data;
	$stampitems = $stamp->items;
	$someObjectArr = (array)$stampitems;
	$control = empty($someObjectArr);

	$alldates_array = array();

	if($stampitems)
	{
		foreach ($stampitems AS $event)
		{
			$eventid = $event->id;
			$allDates = $event->AllDatesDisplay;
			for($i = 0; $i < count($allDates); $i++)
			{
				$date_evtid = $allDates[$i].'_'.$eventid;
				array_push($alldates_array, $date_evtid);
			}
		}
	}

	if ($orderby == 2)
	{
		sort($alldates_array);
	}
	else
	{
		rsort($alldates_array);
	}

	$all_dates = count($alldates_array);

	$allevents_total = $iCModeliChelper->count_Events();

	$getpage=JRequest::getVar('page', 1);

	$number_per_page = $this->number;
	$arrowtext = $this->arrowtext;

	$document	= JFactory::getDocument();

	$tpl_template_events	= JPATH_SITE . '/components/com_icagenda/themes/packs/'.$this->template.'/'.$this->template.'_events.php';
	$tpl_template_list		= JPATH_SITE . '/components/com_icagenda/themes/packs/'.$this->template.'/'.$this->template.'_list.php';
	$tpl_default_events		= JPATH_SITE . '/components/com_icagenda/themes/packs/'.$this->template.'/'.$this->template.'_events.php';
	$tpl_component_css		= JPATH_SITE . '/components/com_icagenda/themes/packs/'.$this->template.'/css/'.$this->template.'_component.css';


	// Setting component css file to load
	if ( file_exists($tpl_component_css) )
	{
		$css_component	= '/components/com_icagenda/themes/packs/'.$this->template.'/css/'.$this->template.'_component.css';
	}
	else
	{
		$css_component	= '/components/com_icagenda/themes/packs/default/css/default_component.css';
	}

	// New file to display all dates for each events
	if ( file_exists($tpl_template_events) )
	{
		$tpl_events		= $tpl_template_events;
	}
	elseif ( (!$this->template OR $this->template != 'default')
		AND file_exists($tpl_template_list)
		AND $datesDisplay == 1 )
	{
		$msg = 'iCagenda '.JText::_('PHPMAILER_FILE_ACCESS').' <strong>'.$this->template.'_events.php</strong>';
		$app->enqueueMessage($msg, 'warning');
		$tpl_events		= JPATH_SITE . '/components/com_icagenda/themes/packs/default/default_events.php';
		$css_component	= '/components/com_icagenda/themes/packs/default/css/default_component.css';
	}
	elseif ( (!$this->template OR $this->template != 'default')
		AND $datesDisplay != 1 )
	{
		$tpl_events		= $tpl_template_events;
	}
	else
	{
		$msg = 'iCagenda '.JText::_('PHPMAILER_FILE_OPEN').' <strong>'.$this->template.'_events.php</strong>';
		$app->enqueueMessage($msg, 'warning');
		return false;
	}

	// If theme pack is not having YOUR_THEME_events.php file, loading YOUR_THEME_list.php file to display list of events
	if ( file_exists($tpl_template_list)
		AND !file_exists($tpl_template_events) )
	{
		$tpl_list		= $tpl_template_list;
	}
	else
	{
		$tpl_list		= JPATH_SITE . '/components/com_icagenda/themes/packs/default/default_events.php';
	}

	// Add the media specific CSS to the document
	JLoader::register('iCagendaMediaCss', JPATH_ROOT . '/components/com_icagenda/helpers/media_css.class.php');
	iCagendaMediaCss::addMediaCss($this->template, 'component');

	if($stamp->container->header)
	{
		echo '<div>';
		echo $stamp->container->header;

		$catid_array = array();
		$catinfos_array = array();

		if($stampitems AND $display_catDesc)
		{
			foreach ($stampitems AS $event)
			{
				$cat_id = $event->cat_id;
				$cat_title = $event->cat_title;
				$cat_color = $event->cat_color;
				if ($event->cat_desc)
				{
					$cat_desc = $event->cat_desc;
				}
				else
				{
					$cat_desc = ' ';
				}
				$fontColor = $event->fontColor;

				array_push($catid_array, $cat_id);

				$array = array($cat_title, $cat_color, $cat_desc, $fontColor);
				$comma_separated = implode("::", $array);
				if (!in_array($comma_separated, $catinfos_array))
				{
					array_push($catinfos_array, $comma_separated);
				}
			}
		}
		$cat_result = array_unique($catid_array);

		for($i = 0; $i < count($catinfos_array); $i++)
		{
			$cat_getinfos = explode('::', $catinfos_array[$i]);
			if (in_array('1', $cat_opts))
			{
				echo '<div class="cat_header_title ' . $cat_getinfos['3'] . '" style="background: ' . $cat_getinfos['1'] . ';">' . $cat_getinfos['0'] . '</div>';
			}
			if (in_array('2', $cat_opts))
			{
			echo '<div class="cat_header_desc">' . $cat_getinfos['2'] . '</div>';
			}
			if (in_array('2', $cat_opts)) {	echo '<div style="clear:both"></div>'; }
		}

//		if (!in_array('2', $cat_opts)) {	echo '<div>&nbsp;</div>'; }

		if ($navposition == '0'
			OR $navposition == '2')
		{
			if (($datesDisplay == '1')
				AND (file_exists( $tpl_events )))
			{
				if ($display_catDesc)
				{
					echo '<div style="clear:both"></div><br />';
					if (($all_dates / $number_per_page) > 1)
					{
					echo $iCModeliChelper->pagination($all_dates, $getpage, $arrowtext, $number_per_page, $pagination);
					}
				}
				else
				{
					if (($all_dates / $number_per_page) > 1)
					{
						echo $iCModeliChelper->pagination($all_dates, $getpage, $arrowtext, $number_per_page, $pagination);
					}
				}
			}
			else
			{
				$ic_nav = $iCModeliChelper->pagination($allevents_total, $getpage, $arrowtext, $number_per_page, $pagination);
				if ($display_catDesc)
				{
					echo '<div style="clear:both"></div><br />';
					if (($allevents_total / $number_per_page) > 1)
					{
						echo $ic_nav;
					}
				}
				else
				{
					if (($allevents_total / $number_per_page) > 1)
					{
						echo $ic_nav;
					}
				}
			}
		}
		elseif ($display_catDesc)
		{
			echo '<div style="clear:both">&nbsp;</div>';
		}
		echo '</div>';
	}


	$mainframe = JFactory::getApplication();
	$isSef = $mainframe->getCfg( 'sef' );

	if(!$control)
	{

		if(file_exists($tpl_events) AND $datesDisplay == 1)
		{
			//---------------------------
			// All Dates - List View
			//---------------------------

			// Set number of events to be displayed per page
			$index=$number_per_page*($getpage-1);
			$recordsToBeDisplayed = array_slice($alldates_array,$index,$number_per_page, true);

			// Do for each dates to be displayed on this list of events, depending of menu and/or global options
			for($i = 0; $i < count($alldates_array); $i++)
			{
				// Get id and date for each date to be displayed
				$evt_date_id=$alldates_array[$i];
				$ex_alldates_array = explode('_', $evt_date_id);
				$evt = $ex_alldates_array['0'];
				$evt_id = $ex_alldates_array['1'];

				if (in_array($evt_date_id, $recordsToBeDisplayed))
				{
					foreach ($stamp->items as $item)
					{
						if ($evt_id == $item->id)
						{
							$evtDates = $item->AllDatesDisplay;
							$idevt = '';

							if (in_array($evt, $evtDates))
							{
								// Load Event Data
								$EVENT_DATE			= $iCModeliChelper->nextDate($evt, $item);
								$EVENT_SET_DATE		= $iCModeliChelper->EventUrlDate($evt);
								if ($isSef == '1')
								{
									$EVENT_URL			= $item->url.'?date='.$EVENT_SET_DATE;
								}
								else
								{
									$EVENT_URL			= $item->url.'&date='.$EVENT_SET_DATE;
								}
								$EVENT_DAY			= $this->day_display_global ? $iCModeliChelper->day($evt) : false;
								$EVENT_MONTHSHORT	= $this->month_display_global ? $iCModeliChelper->monthShortJoomla($evt) : false;
								$EVENT_YEAR			= $this->year_display_global ? $iCModeliChelper->year($evt) : false;
								$READ_MORE			= $this->shortdesc_display_global == 1 ? $iCModeliChelper->readMore($EVENT_URL, $item->desc, '[&#46;&#46;&#46;]') : false;

								// Load Events List/Event Details common Data variables
								require $icsetvar;

								// Load Template to display Event
								require $tpl_events;
							}
						}
					}
				}
			}
			echo '<div>';

			// List Bottom

			// AddThis buttons
			if ($this->atlist && isset($item))
			{
				echo '<div class="share">' . $item->share . '</div><div style="clear:both"></div>';
			}

			// List Bottom - Navigation & pagination
			if ($navposition == '1' OR $navposition == '2')
			{
				if (($all_dates / $number_per_page) > 1)
				{
					echo $iCModeliChelper->pagination($all_dates, $getpage, $arrowtext, $number_per_page, $pagination);
				}
			}

			echo '</div>';
			echo '<div style="clear:both"></div>';
		}
		else
		{
			//---------------------------
			// Next/Last Date - List View
			//---------------------------

			if (file_exists($tpl_events))
			{
				foreach ($stamp->items as $item)
				{
					// Load Event Data
					$EVENT_DATE			= $item->nextDate;
					$EVENT_DAY			= $this->day_display_global ? $item->day : false;
					$EVENT_MONTHSHORT	= $this->month_display_global ? $item->monthShortJoomla : false;
					$EVENT_YEAR			= $this->year_display_global ? $item->year : false;
					$READ_MORE			= $this->shortdesc_display_global == 1 ? $iCModeliChelper->readMore($item->url, $item->desc, '[&#46;&#46;&#46;]') : false;

					// Load Events List/Event Details common Data
					require $icsetvar;

					// Load Template to display Event
					require $tpl_events;
				}
			}
			else
			{
				require $tpl_list;
			}

			// List Bottom
			echo '<div>';

			if (file_exists($tpl_events))
			{
				// AddThis buttons
				if ($this->atlist && isset($item->share))
				{
					echo '<div class="share">' . $item->share . '</div><div style="clear:both"></div>';
				}
			}

			// List Bottom - Navigation & pagination
			if ($navposition == '1' OR $navposition == '2')
			{
				if (($allevents_total / $number_per_page) > 1)
				{
					echo $iCModeliChelper->pagination($allevents_total, $getpage, $arrowtext, $number_per_page, $pagination);
				}
			}

			echo '</div>';
			echo '<div style="clear:both"></div>';
		}
	}
	require_once $js_list;
	?>
</div>
<?php
$document->addStyleSheet( JURI::base( true ) . $css_component );
$document->addStyleSheet( JURI::base( true ) . '/components/com_icagenda/add/css/style.css' );
$document->addStyleSheet( JURI::base( true ) . '/media/com_icagenda/icicons/style.css' );
$document->addStyleSheet( JURI::base( true ) . '/media/com_icagenda/css/tipTip.css' );

if(version_compare(JVERSION, '3.0', 'lt'))
{
	JHTML::_('behavior.mootools');

	// load jQuery, if not loaded before (NEW VERSION IN 1.2.6)
	$scripts = array_keys($document->_scripts);
	$scriptFound = false;
	$scriptuiFound = false;
	$mapsgooglescriptFound = false;
	for ($i = 0; $i < count($scripts); $i++)
	{
		if (stripos($scripts[$i], 'jquery.min.js') !== false)
		{
			$scriptFound = true;
		}
		// load jQuery, if not loaded before as jquery - added in 1.2.7
		if (stripos($scripts[$i], 'jquery.js') !== false)
		{
			$scriptFound = true;
		}
		if (stripos($scripts[$i], 'jquery-ui.min.js') !== false)
		{
			$scriptuiFound = true;
		}
	}

	// jQuery Library Loader
	if (!$scriptFound)
	{
		// load jQuery, if not loaded before
		if (!JFactory::getApplication()->get('jquery'))
		{
			JFactory::getApplication()->set('jquery', true);
			// add jQuery
			$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
			$document->addScript( JURI::base( true ) . '/components/com_icagenda/js/jquery.noconflict.js');
		}
	}

	if (!$scriptuiFound)
	{
		$document->addScript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
	}

}
else
{
	jimport( 'joomla.environment.request' );

	JHtml::_('behavior.formvalidation');
	JHtml::_('bootstrap.framework');
	JHtml::_('jquery.framework');

	$document->addScript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
}

// Loading Script tipTip used for iCtips
$document->addScript( JURI::base( true ) . '/media/com_icagenda/js/jquery.tipTip.js');

$iCtip	 = array();
$iCtip[] = '	jQuery(document).ready(function(){';
$iCtip[] = '		jQuery(".icTip").tipTip({maxWidth: "200", defaultPosition: "top", edgeOffset: 1});';
$iCtip[] = '	});';

// Add the script to the document head.
JFactory::getDocument()->addScriptDeclaration(implode("\n", $iCtip));

// Add RSS Feeds
$menu = $app->getMenu()->getActive()->id;

$feed = 'index.php?option=com_icagenda&amp;view=list&amp;Itemid=' . (int) $menu . '&amp;format=feed';
$rss = array(
	'type'    =>  'application/rss+xml',
	'title'   =>   'RSS 2.0');

//$atom = array(
//	'type'    =>  'application/atom+xml',
//	'title'   =>   'Atom');

$document->addHeadLink(JRoute::_($feed.'&amp;type=rss'), 'alternate', 'rel', $rss);
//$document->addHeadLink(JRoute::_($feed.'&type=atom'), 'alternate', 'rel', $atom);
