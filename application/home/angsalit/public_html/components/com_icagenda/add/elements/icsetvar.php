<?php
/**
 *------------------------------------------------------------------------------
 *	iCagenda Set Var for Theme Packs
 *------------------------------------------------------------------------------
 * @package     com_icagenda
 * @copyright   Copyright (c)2012-2014 Cyril Rezé, Jooml!C - All rights reserved
 *
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Cyril Rezé (Lyr!C)
 * @link        http://www.joomlic.com
 *
 * @version     3.3.6 2014-05-14
 * @since       3.2.8
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();

	$iCModeliChelper = new iCModeliChelper();

	$BACK_ARROW				= $item->BackArrow;
	$TEXT_FOR_NEXTDATE		= $item->dateText;

	$EVENT_SHARING			= $item->share_event;
	$EVENT_REGISTRATION		= $item->reg;

	$EVENT_TITLEBAR			= $item->titlebar;
	$EVENT_NEXT				= $item->next;
	$EVENT_NEXTDATE			= $item->nextDate;
//	$EVENT_DAY				= $item->day;
//	$EVENT_MONTHSHORT		= $item->monthShort;

	// Get var 'date_value' set to session in event details view
	$session = JFactory::getSession();
	$get_date = $session->get('date_value', '');
	if (!$get_date)
	{
		$get_date = JRequest::getVar('date');
	}

	if (isset($get_date))
	{
		$ex = explode('-', $get_date);
		$dateday = $ex['0'].'-'.$ex['1'].'-'.$ex['2'].' '.$ex['3'].':'.$ex['4'];
	}

	// loading params Menu
	$app = JFactory::getApplication();
	$iCmenuParams = $app->getParams();

	// loading Global Options
	$iC_global = JComponentHelper::getParams('com_icagenda');

	$timeformat = $iCmenuParams->get('timeformat');
	$timedisplay = '';
	$timedisplay = $item->displaytime;

	$lang_time = '';
	if (isset($get_date)) {
		if ($timedisplay == 1) {
			if ($timeformat == 1) {
				$lang_time = strftime('%H:%M', strtotime($dateday));
			} else {
				$lang_time = strftime('%I:%M %p', strtotime($dateday));
			}
		}
		$EVENT_THIS_DATE		= $iCModeliChelper->formatDate($dateday).' '.$lang_time;
	}

	$datesDisplay_menu = $iCmenuParams->get('datesDisplay', '');
	$datesDisplay_global = $iC_global->get('datesDisplay_global', 2);
	if ($datesDisplay_menu) {
		$datesDisplay = $datesDisplay_menu;
	} else {
		$datesDisplay = $datesDisplay_global;
	}


//	$EVENT_THIS_DATE = $iCModeliChelper->EventUrlDate($item);
	if ($datesDisplay == 1) {
//		$EVENT_URL				= $item->url.'?date='.$EVENT_SET_DATE;
		$EVENT_VIEW_DATE_TEXT	= JTEXT::_('COM_ICAGENDA_EVENT_DATE');
		if (isset($EVENT_THIS_DATE)) {
			$EVENT_VIEW_DATE		= $EVENT_THIS_DATE;
		} else {
			$EVENT_VIEW_DATE		= $EVENT_NEXTDATE;
		}
	} else {
		$EVENT_URL				= $item->url;
		$EVENT_VIEW_DATE_TEXT	= $TEXT_FOR_NEXTDATE;
		$EVENT_VIEW_DATE		= $EVENT_NEXTDATE;
	}

	$EVENT_TITLE			= $item->title;
	$EVENT_IMAGE			= $item->image;
	$EVENT_IMAGE_TAG		= $item->imageTag;
	$EVENT_DESC				= $item->desc;
	$EVENT_DESCRIPTION		= $item->description;
	$EVENT_META				= $item->metaAsShortDesc;

	$shortdesc_display_global = $iC_global->get('shortdesc_display_global', 1);
	if ($shortdesc_display_global == 1)
	{
		$EVENT_DESCSHORT		= $iC_global->get('shortdesc_display_global') ? $item->descShort : false;
	}
	elseif ($shortdesc_display_global == 2)
	{
		$EVENT_DESCSHORT		= $iC_global->get('shortdesc_display_global') ? $item->metaAsShortDesc : false;
	}
	else
	{
		$EVENT_DESCSHORT = false;
	}

	$EVENT_INFOS			= $item->infoDetails;

	$SEATS_AVAILABLE		= $item->placeLeft;
	$MAX_NB_OF_SEATS		= $item->maxNbTickets;

	$EVENT_VENUE			= $iC_global->get('venue_display_global') ? $item->place_name : false;
	$EVENT_CITY				= $iC_global->get('city_display_global') ? $item->city : false;
	$EVENT_COUNTRY			= $iC_global->get('country_display_global') ? $item->country : false;

	$EVENT_PHONE			= $item->phone;
	$EVENT_EMAIL			= $item->email;
	$EVENT_EMAIL_CLOAKING	= $item->emailLink;
	$EVENT_WEBSITE			= $item->website;
	$EVENT_WEBSITE_LINK		= $item->websiteLink;
	$EVENT_ADDRESS			= $item->address;
	$GOOGLEMAPS_COORDINATES	= $item->coordinate;
	$EVENT_MAP				= $item->map;

	$EVENT_SINGLE_DATES		= $item->datelistUl;
	$EVENT_PERIOD			= $item->periodDates;

	$PARTICIPANTS_DISPLAY	= $item->participantList;
	$PARTICIPANTS_HEADER	= $item->participantListTitle;
	$EVENT_PARTICIPANTS		= $item->registeredUsers;

	$EVENT_ATTACHEMENTS		= $item->file;
	$EVENT_ATTACHEMENTS_TAG	= $item->fileTag;

	$CATEGORY_TITLE			= $item->cat_title;
	$CATEGORY_COLOR			= $item->cat_color;
	$CATEGORY_FONTCOLOR		= $item->fontColor;
