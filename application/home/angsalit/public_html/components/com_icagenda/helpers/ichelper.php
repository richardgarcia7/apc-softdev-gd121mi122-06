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
 * @version     3.3.6 2014-05-04
 * @since       3.2.8
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();

jimport('joomla.application.component.modelitem');
jimport( 'joomla.html.parameter' );
jimport( 'joomla.registry.registry' );

jimport('joomla.user.helper');
jimport('joomla.access.access');

class iCModeliChelper extends JModelItem {

	/**
	 *
	 * ALL EVENTS DISPLAY
	 *
	 */

	public function count_Events ()
	{
		// Get Params Menu
		$app = JFactory::getApplication();
		$iCmenuParams = $app->getParams();

		// Get Data
		$db		= Jfactory::getDbo();
		$query	= $db->getQuery(true);
        $query->select('count(e.id) AS nbevents')->from('#__icagenda_events AS e');

		// Adding Filter if State Published
		$where= "(e.state = 1)";

		// Adding Filter per Category in Navigation
		$mcatid = $iCmenuParams->get('mcatid');
		if (is_array($mcatid)) {
			$selcat=implode(', ', $mcatid);
			if (!in_array('0', $mcatid)) {
				$where.= " AND (e.catid IN ($selcat))";
			}
		}

		// UTC datetime is converted in joomla config time zone
		// Get a date object based on UTC.
		$config = JFactory::getConfig();
		if(version_compare(JVERSION, '3.0', 'ge')) {
			$offset = $config->get('offset');
		} else {
			$offset = $config->getValue('config.offset');
		}
		$joomlaTZ_datetime = JFactory::getDate('now', $offset);
		$joomlaTZ_date = date('Y-m-d', strtotime($joomlaTZ_datetime));

		// Adding Filter per Time in Navigation
		$filter_time = $iCmenuParams->get('time');
//		if($filter_time==1) $where.=' AND e.next >= (CURDATE())';
//		if($filter_time==2) $where.=' AND e.next < (CURDATE())';
//		if($filter_time==3) $where.=' AND e.next >= (NOW())';
//		if($filter_time==4) $where.=' AND (e.next >= (CURDATE()) AND (e.next < (CURDATE() + INTERVAL 1 DAY)))';

		if($filter_time==1) $where.=' AND '.$db->qn('e.next').' >= '.$db->q($joomlaTZ_date).''; // COM_ICAGENDA_OPTION_TODAY_AND_UPCOMING
		if($filter_time==2) $where.=' AND '.$db->qn('e.next').' < '.$db->q($joomlaTZ_date).''; // COM_ICAGENDA_OPTION_PAST
		if($filter_time==3) $where.=' AND '.$db->qn('e.next').' > '.$db->q($joomlaTZ_datetime).''; // COM_ICAGENDA_OPTION_FUTURE
		if($filter_time==4) // COM_ICAGENDA_OPTION_TODAY
		{
			$where.=' AND ('.$db->qn('e.next').' >= '.$db->q($joomlaTZ_date).'';
			$where.=' AND ('.$db->qn('e.next').' < ('.$db->q($joomlaTZ_date).' + INTERVAL 1 DAY)))';
		}

		// Language Control
		$lang = JFactory::getLanguage();
		$langcur = $lang->getTag();
		$langcurrent = $langcur;
		$where.= " AND ((e.language = '$langcurrent') OR (e.language = '*') OR (e.language = NULL) OR (e.language = ''))" ;

		// Access Control
		$user = JFactory::getUser();
		$userID = $user->id;
		$userLevels = $user->getAuthorisedViewLevels();
		if(version_compare(JVERSION, '3.0', 'lt')) {
			$userGroups = $user->getAuthorisedGroups();
		} else {
			$userGroups = $user->groups;
		}
		$groupid = JComponentHelper::getParams('com_icagenda')->get('approvalGroups', array("8"));

		jimport( 'joomla.access.access' );
		$adminUsersArray = array();
		foreach ($groupid AS $gp) {
			$adminUsers = JAccess::getUsersByGroup($gp, False);
			$adminUsersArray = array_merge($adminUsersArray, $adminUsers);
		}
		// Test if user has Access Permissions
		if ( !in_array('8', $userGroups) )  {
			$useraccess = implode(', ', $userLevels);
			$where.=' AND e.access IN ('.$useraccess.')';
		}

		// Test if user logged-in has Approval Rights
		if (!in_array($userID, $adminUsersArray) AND !in_array('8', $userGroups)) {
			$where.=' AND e.approval <> 1';
		} else {
			$where.=' AND e.approval < 2';
		}

		$query->where($where);
		$db->setQuery($query);
		$result=$db->loadObject()->nbevents;

		return $result;
	}

	// Navigator Events list
	public function pagination ($dates, $getpage, $arrowtext, $number_per_page, $pagination)
	{
		// declare the controls
		$ctrlNext=NULL;
		$ctrlBack=NULL;

		$count_evt = $dates;

		// first check whether there are elements of those selected
		if ($count_evt > $number_per_page)$ctrlNext=1;

		if($getpage && $getpage>1)$ctrlBack=1;

		$num=$number_per_page;
		// No display if number not exist (checked in 1.2.8)
		if ($num == NULL) {
			$pages= 1;
		}
		else {
			$pages=ceil($count_evt / $number_per_page);
		}

		$nav='<div class="navigator">';

		// in the case of text next/prev
		if ($arrowtext==1){
			$textnext=JText::_( 'JNEXT' );
			$textback=JText::_( 'JPREV' );
		}

		$parentnav = JRequest::getInt('Itemid');

		$mainframe = JFactory::getApplication();
		$isSef = $mainframe->getCfg( 'sef' );

		if ($isSef == '1') {
			$urlpage=JRoute::_(JURI::current().'?');
		}
		if ($isSef == '0') {
			$urlpage='index.php?option=com_icagenda&view=list&Itemid='.(int)$parentnav.'&';
		}

		if ($pages>=2) {

			if ($ctrlBack!=NULL){
				if ($getpage && $getpage<$pages) {
					$pageBack=$getpage-1;
					$pageNext=$getpage+1;
					$nav.='<a class="icagenda_back" href="'.JRoute::_($urlpage.'page='.$pageBack).'"><span aria-hidden="true" class="iCicon-backic"></span> '.$textback.'&nbsp;</a>';
					$nav.='<a class="icagenda_next" href="'.JRoute::_($urlpage.'page='.$pageNext).'">&nbsp;'.$textnext.' <span aria-hidden="true" class="iCicon-nextic"></span></a>';
				}
				else {
					$pageBack=$getpage-1;
					$nav.='<a class="icagenda_back" href="'.JRoute::_($urlpage.'page='.$pageBack).'"><span aria-hidden="true" class="iCicon-backic"></span> '.$textback.'&nbsp;</a>';
				}
			}
			if ($ctrlNext!=NULL){
				if(!$getpage){
					$pageNext=2;
				}
				else{
					$pageNext=$getpage+1;
					$pageBack=$getpage-1;
				}
				if (empty($pageBack)) {
					$nav.='<a class="icagenda_next" href="'.JRoute::_($urlpage.'page='.$pageNext).'">&nbsp;'.$textnext.' <span aria-hidden="true" class="iCicon-nextic"></span></a>';
				}
			}
		}

		if ($pagination == 1) {

			/* Pagination */

			if (empty($pageBack)) {
				$nav.='<div style="text-align:left">[ ';
			} elseif (($getpage && $getpage==$pages)){
				$nav.='<div style="text-align:right">[ ';
			} else {
				$nav.='<div style="text-align:center">[ ';
			}

			/* Boucle sur les pages */
			for ($i = 1 ; $i <= $pages ; $i++) {

				if($i==1 || (($getpage-5)<$i && $i<($getpage+5)) || $i==$pages)
				{
					if($i==$pages && $getpage<($pages-5)) { $nav.='...'; }
					if ($i == $getpage) { $nav.=' <b>' . $i . '</b>'; }
					else { $nav.=' <a href="' . $urlpage . 'page=' . $i . '" title="' . JText::sprintf( 'COM_ICAGENDA_EVENTS_PAGE_PER_TOTAL', $i, $pages ) . '">' . $i . '</a>'; }
					if($i==1 && $getpage>6) { $nav.='...'; }
				}

			}
			$nav.=' ]</div>';

		}

		$nav.='</div>';

		return $nav;

	}


	protected function iCparam ($param){
		// Import params
		$app = JFactory::getApplication();
		$iCparams = $app->getParams();
		$iCparam = $iCparams->get($param);

		return $iCparam;
	}

	// Function to get Format Date (using option format, and translation)
	public function formatDate ($d)
	{
		$iCModeliChelper = new iCModeliChelper();
		$mkt_date= $iCModeliChelper->mkt($d);

		// get Format
		$for = '0';
		// Global Option for Date Format
		$date_format_global = JComponentHelper::getParams('com_icagenda')->get('date_format_global', 'Y - m - d');
		$date_format_global = $date_format_global ? $date_format_global : 'Y - m - d';

		$for = $iCModeliChelper->iCparam('format');

		// default
		if (($for == NULL) OR ($for == '0'))
		{
			$for = isset($date_format_global) ? $date_format_global : 'Y - m - d';
		}

		if (!is_numeric($for))
		{
			// update format values, from 2.0.x to 2.1
			if ($for == 'l, d Fnosep Y') {$for = 'l, _ d _ Fnosep _ Y';}
			elseif ($for == 'D d Mnosep Y') {$for = 'D _ d _ Mnosep _ Y';}
			elseif ($for == 'l, Fnosep d, Y') {$for = 'l, _ Fnosep _ d, _ Y';}
			elseif ($for == 'D, Mnosep d, Y') {$for = 'D, _ Mnosep _ d, _ Y';}

			// update format values, from release 2.1.6 and before, to 2.1.7 (using globalization)
			elseif ($for == 'd m Y') {$for = 'd * m * Y';}
			elseif ($for == 'd m y') {$for = 'd * m * y';}
			elseif ($for == 'Y m d') {$for = 'Y * m * d';}
			elseif ($for == 'Y M d') {$for = 'Y * M * d';}
			elseif ($for == 'd F Y') {$for = 'd * F * Y';}
			elseif ($for == 'd M Y') {$for = 'd * M * Y';}
			elseif ($for == 'd msepb') {$for = 'd * m';}
			elseif ($for == 'msepa d') {$for = 'm * d';}
			elseif ($for == 'Fnosep _ d, _ Y') {$for = 'F _ d , _ Y';}
			elseif ($for == 'Mnosep _ d, _ Y') {$for = 'M _ d , _ Y';}
			elseif ($for == 'l, _ d _ Fnosep _ Y') {$for = 'l , _ d _ F _ Y';}
			elseif ($for == 'D _ d _ Mnosep _ Y') {$for = 'D _ d _ M _ Y';}
			elseif ($for == 'l, _ Fnosep _ d, _ Y') {$for = 'l , _ F _ d, _ Y';}
			elseif ($for == 'D, _ Mnosep _ d, _ Y') {$for = 'D , _ M _ d, _ Y';}
			elseif ($for == 'd _ Fnosep') {$for = 'd _ F';}
			elseif ($for == 'Fnosep _ d') {$for = 'F _ d';}
			elseif ($for == 'd _ Mnosep') {$for = 'd _ M';}
			elseif ($for == 'Mnosep _ d') {$for = 'M _ d';}
			elseif ($for == 'Y. F d.') {$for = 'Y . F d .';}
			elseif ($for == 'Y. M. d.') {$for = 'Y . M . d .';}
			elseif ($for == 'Y. F d., l') {$for = 'Y . F d . , l';}
			elseif ($for == 'F d., l') {$for = 'F d . , l';}
		}

		// NEW DATE FORMAT GLOBALIZED 2.1.7

		$lang = JFactory::getLanguage();
		$langTag = $lang->getTag();
		$langName = $lang->getName();
		if(!file_exists(JPATH_ADMINISTRATOR.'/components/com_icagenda/globalization/'.$langTag.'.php')){

			$langTag='en-GB';
		}

		$globalize = JPATH_ADMINISTRATOR.'/components/com_icagenda/globalization/'.$langTag.'.php';
		$iso = JPATH_ADMINISTRATOR.'/components/com_icagenda/globalization/iso.php';

		if (is_numeric($for)) {
			require $globalize;
		} else {
			require $iso;
		}

		// Load Globalization Date Format if selected
		if ($for == '1') {$for = $datevalue_1;}
		elseif ($for == '2') {$for = $datevalue_2;}
		elseif ($for == '3') {$for = $datevalue_3;}
		elseif ($for == '4') {$for = $datevalue_4;}
		elseif ($for == '5') {
			if (($langTag == 'en-GB') OR ($langTag == 'en-US')) {
				$for = $datevalue_5;
			} else {
				$for = $datevalue_4;
			}
		}
		elseif ($for == '6') {$for = $datevalue_6;}
		elseif ($for == '7') {$for = $datevalue_7;}
		elseif ($for == '8') {$for = $datevalue_8;}
		elseif ($for == '9') {
			if ($langTag == 'en-GB') {
				$for = $datevalue_9;
			} else {
				$for = $datevalue_7;
			}
		}
		elseif ($for == '10') {
			if ($langTag == 'en-GB') {
				$for = $datevalue_10;
			} else {
				$for = $datevalue_8;
			}
		}
		elseif ($for == '11') {$for = $datevalue_11;}
		elseif ($for == '12') {$for = $datevalue_12;}

		// Explode components of the date
		$exformat = explode (' ', $for);
		$format='';
		$separator = ' ';

		// Day with no 0 (test if Windows server)
		$dayj = '%e';
		if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
    		$dayj = preg_replace('#(?<!%)((?:%%)*)%e#', '\1%#d', $dayj);
		}

		// Date Formatting using strings of Joomla Core Translations (update 3.1.4)
		$dateFormat=date('d-M-Y', $mkt_date);
		$separator = $iCModeliChelper->iCparam('date_separator');
		foreach($exformat as $k=>$val){
			switch($val){

				// day (v3)
				case 'd': $val=date("d", strtotime("$dateFormat")); break;
				case 'j': $val=strftime("$dayj", strtotime("$dateFormat")); break;
				case 'D': $val=JText::_(date("D", strtotime("$dateFormat"))); break;
				case 'l': $val=JText::_(date("l", strtotime("$dateFormat"))); break;
				case 'dS': $val=strftime(stristr(PHP_OS,"win") ? "%#d" : "%e", strtotime("$dateFormat")).'<sup>'.date("S", strtotime("$dateFormat")).'</sup>'; break;
				case 'jS': $val=strftime("$dayj", strtotime("$dateFormat")).'<sup>'.date("S", strtotime("$dateFormat")).'</sup>'; break;

				// month (v3)
				case 'm': $val=date("m", strtotime("$dateFormat")); break;
				case 'F': $val=JText::_(date("F", strtotime("$dateFormat"))); break;
				case 'M': $val=JText::_(date("F", strtotime("$dateFormat")).'_SHORT'); break;
				case 'n': $val=date("n", strtotime("$dateFormat")); break;

				// year (v3)
				case 'Y': $val=date("Y", strtotime("$dateFormat")); break;
				case 'y': $val=date("y", strtotime("$dateFormat")); break;

				// separators of the components (v2)
				case '*': $val=$separator; break;
				case '_': $val=' '; break;
				case '/': $val='/'; break;
				case '.': $val='.'; break;
				case '-': $val='-'; break;
				case ',': $val=','; break;
				case 'the': $val='the'; break;
				case 'gada': $val='gada'; break;
				case 'de': $val='de'; break;
				case 'г.': $val='г.'; break;
				case 'den': $val='den'; break;
				case 'ukp.': $val = '&#1088;.'; break;



				// day
				case 'N': $val=strftime("%u", strtotime("$dateFormat")); break;
				case 'w': $val=strftime("%w", strtotime("$dateFormat")); break;
				case 'z': $val=strftime("%j", strtotime("$dateFormat")); break;

				// week
				case 'W': $val=date("W", strtotime("$dateFormat")); break;

				// month
				case 'n': $val=$separator.date("n", strtotime("$dateFormat")).$separator; break;

				// time
				case 'H': $val=date("H", strtotime("$dateFormat")); break;
				case 'i': $val=date("i", strtotime("$dateFormat")); break;


				default: $val=''; break;
			}
			if($k!=0)$format.=''.$val;
			if($k==0)$format.=$val;
		}
		return $format;
	}


	// Set Date format for url
	public function EventUrlDate($evt)
	{
		$replace = array("-", " ", ":");
		$datedayclean = str_replace($replace, "", $evt);
		$evt_explode = explode(' ', $evt);
		$dateday = $evt_explode['0'].'-'.str_replace(':', '-', $evt_explode['1']);
		return $dateday;
	}


	// mktime with control
	protected function mkt($data)
	{
		$data = str_replace(' ', '-', $data);
		$data = str_replace(':', '-', $data);
		$ex_data = explode('-', $data);
		$hour = isset($ex_data['3']) ? $ex_data['3'] : '0';
		$min = isset($ex_data['4']) ? $ex_data['4'] : '0';
		$sec = '0';
		$day = isset($ex_data['2']) ? $ex_data['2'] : '0';
		$month = isset($ex_data['1']) ? $ex_data['1'] : '0';
		$year = isset($ex_data['0']) ? $ex_data['0'] : '0000';
		$ris = mktime($hour, $min, $sec, $month, $day, $year);

		return strftime($ris);
	}


	// Get Next Date (or Last Date)
	public function nextDate ($evt, $i){
		$iCModeliChelper = new iCModeliChelper();

		$today=time();
		$day= date('d');
		$m= date('m');
		$y= date('y');
		$hour= date('H');
		$min= date('i');
		$today=mktime(0,0,0,$m,$day,$y);
		$testDate = $iCModeliChelper->mkt($evt);

		if ($testDate == $today) {
			$nextDate = '<b>'.$iCModeliChelper->formatDate($evt).'<span class="evttime"> '.$iCModeliChelper->eventTime($evt, $i).'</span></b>';
		}
		else {
			$nextDate = $iCModeliChelper->formatDate($evt).'<span class="evttime"> '.$iCModeliChelper->eventTime($evt, $i).'</span>';
		}
			return $nextDate;
	}


	public function eventTime ($d, $i){
		$iCModeliChelper = new iCModeliChelper();

		$date_time = $iCModeliChelper->mkt($d);
 		$time_format = 'H:i';
 		$t_time=date($time_format, $date_time);
		$timeformat='1';
		$timeformat=$iCModeliChelper->iCparam('timeformat');

		if ($timeformat == 1) {
			$lang_time = strftime("%H:%M", strtotime("$t_time"));
		} else {
			$lang_time = strftime("%I:%M %p", strtotime("$t_time"));
		}

		if (isset($i->time)) {
			$oldtime = $i->time;
		} else {
			$oldtime = NULL;
		}
		if ($oldtime != NULL){
			$time = $i->time;
		} else {
			$time = JText::_($lang_time);
		}
		$displayTime=$i->displaytime;
		if (($displayTime == 1) AND($time != '23:59')) {
			return $time;
		} else {
			return NULL;
		}
	}

	/**
	 * DAY
	 */

	// Day
	public function day ($i){
		$iCModeliChelper = new iCModeliChelper();

		return date('d', $iCModeliChelper->mkt($i));
	}

	// Day of the week, Full - From Joomla language file xx-XX.ini (eg. Saturday)
	public function weekday ($i){
		$iCModeliChelper = new iCModeliChelper();

		$mkt_date = $iCModeliChelper->mkt($i);
		$l_full_weekday = date("l", $mkt_date);
		$weekday = JText::_($l_full_weekday);
		return $weekday;
	}

	// Day of the week, Short - From Joomla language file xx-XX.ini (eg. Sat)
	public function weekdayShort ($i){
		$iCModeliChelper = new iCModeliChelper();

		$mkt_date = $iCModeliChelper->mkt($i);
		$l_short_weekday = date("D", $mkt_date);
		$weekdayShort = JText::_($l_short_weekday);
		return $weekdayShort;
	}


	/**
	 * MONTHS
	 */

	// Function used for special characters
	function substr_unicode($str, $s, $l = null) {
    	return join("", array_slice(
		preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY), $s, $l));
	}

	// Format Month (eg. December)
	public function month ($i){
		$iCModeliChelper = new iCModeliChelper();

		$mkt_date = $iCModeliChelper->mkt($i);
//		$dateFormat=date('Y-m-d', $mkt_date);
//		$l_full_month = date("F", strtotime("$dateFormat"));
		$l_full_month = date("F", $mkt_date);
		$lang_month = JText::_($l_full_month);
		$month = $lang_month;
		return $month;
	}

	// Format Month Short - 3 first characters (eg. Dec.) OR Joomla Translation core
	public function monthShort ($i){
		$iCModeliChelper = new iCModeliChelper();

		$Jcore = '1';
		$mkt_date=$iCModeliChelper->mkt($i);
		$l_full_month = date("F", $mkt_date);
		if ($Jcore == '1') {
			return $this->monthShortJoomla($i);
		}
		else {
			$lang_month = JText::_($l_full_month);
			$monthShort = $this->substr_unicode($lang_month,0,3);
			$space='';
			$point='';
			if(strlen($l_full_month)>3){
				$space='&nbsp;';
				$point='.';
			}
			return $space.$monthShort.$point;
		}
	}

	// Format Month Short Core - From Joomla language file xx-XX.ini (eg. Dec)
	public function monthShortJoomla ($i){
		$iCModeliChelper = new iCModeliChelper();

		$mkt_date=$iCModeliChelper->mkt($i);
		$l_full_month = date("F", $mkt_date);
		$monthShortJoomla = JText::_($l_full_month.'_SHORT');
		return $monthShortJoomla;
	}

	// Format Month Numeric - (eg. 07)
	public function monthNum ($i){
		$iCModeliChelper = new iCModeliChelper();

		return $iCModeliChelper->formatDate($i, 'm');
	}


	/**
	 * YEAR
	 */

	// Format Year Numeric - (eg. 2013)
	public function year ($i){
		$iCModeliChelper = new iCModeliChelper();

		return date('Y', $iCModeliChelper->mkt($i));
	}

	// Format Year Short Numeric - (eg. 13)
	public function yearShort ($i){
		$iCModeliChelper = new iCModeliChelper();

		return date('y', $iCModeliChelper->mkt($i));
	}


	// Read More Button
	public function readMore ($url, $desc, $content = ''){
		$limit = '100';
		$iCparams = JComponentHelper::getParams('com_icagenda');
		$limitGlobal = $iCparams->get('limitGlobal', 0);

		if ($limitGlobal == 1) {
			$limit = $iCparams->get('ShortDescLimit');
		}
		if ($limitGlobal == 0) {
			$customlimit=$iCparams->get('limit');
			if (is_numeric($customlimit)){
				$limit=$customlimit;
			} else {
				$limit = $iCparams->get('ShortDescLimit');
			}
		}
		if (is_numeric($limit)) {
			$limit = $limit;
		} else {
			$limit = '1';
		}
		$readmore='';
		if ($limit <= 1) {
			$readmore='';
		} else {
			$readmore=$content;
		}
		$text=preg_replace('/<img[^>]*>/Ui', '', $desc);
		if(strlen($text)>$limit){
			$string_cut=substr($text, 0,$limit);
			$last_space=strrpos($string_cut,' ');
			$string_ok=substr($string_cut, 0,$last_space);
			$text=$string_ok.' ';
			$url=$url;
			$text='<a href="'.$url.'" class="more">'.$readmore.'</a>';
		}else{
			$text='';
		}
		return $text;
	}




}
