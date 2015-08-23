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
 * @version     3.3.6 2014-05-14
 * @since       3.1.9 (1.0)
 *------------------------------------------------------------------------------
*/

/**
 *	iCagenda - iC calendar
 */


// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.methods' );
jimport( 'joomla.environment.request' );
jimport('joomla.application.component.helper');

// classe du Module
class modiCcalendarHelper
{

	private function construct($params)
	{
		$this->modid				= $params->get('id');
		$this->template				= $params->get('template');
		$this->format				= $params->get('format');
		$this->date_separator		= $params->get('date_separator');
		$this->setTodayTimezone		= $params->get('setTodayTimezone');
		$this->displayDatesTimezone	= $params->get('displayDatesTimezone');
		$this->filtering_shortDesc	= $params->get('filtering_shortDesc', '');
		$this->catid				= $params->get('mcatid');
		$this->number				= $params->get('number');
		$this->onlyStDate			= $params->get('onlyStDate');

		$mItemid					= JRequest::getInt('Itemid');
		$iccaldate					= JRequest::getVar('iccaldate'); // Get date set in month/year navigation

		$this->itemid				= $mItemid;
		$this->mod_iccalendar		= '#mod_iccalendar_'.$this->modid;


		// First day of the current month
		$this_month = date('Y-m-01');

		if ( isset($iccaldate)
			&& !empty($iccaldate) )
		{
			// This should be the first day of a month
			$this->date_start = date('Y-m-01', strtotime($iccaldate));
		}
		else
		{
			$this->date_start	= $this_month;
		}

		// Add filter to restrict the number of events using the 'next' date
		if ($this->date_start > $this_month)
		{
			// Month to be displayed is in the future
			// Events required start from the current month
			$filter_start = $this_month;
		}
		else
		{
			// Month to be displayed is current or past
			// Events required start from the display month
			$filter_start = $this->date_start;
		}

        $this->addFilter('e.next', ''.$filter_start.'','>=');

		// An end date for selection is not possible because it may prevent display of past events where the next
		// scheduled instance of an event is after the end of the display month
//		$filter_end = date('Y-m-d', strtotime('+1 month', strtotime($this->date_start)));
//		$this->addFilter('e.next', "'$filter_end'",'<');


		// Get Array of categories to be displayed
		if ( isset($this->catid)
			&& !empty($this->catid) )
		{
			$cat_filter_param = $this->catid;

			if (!is_array($cat_filter_param))
			{
				$catFilter = array($cat_filter_param);
			}
			else
			{
				$catFilter = $cat_filter_param;
			}
			$cats_option = implode(', ', $catFilter);

			if ($catFilter != array(0))
			{
				$this->addFilter('e.catid', '('.$cats_option.')', ' IN ');
			}
		}
	}


	function start($params)
	{
		$this->construct($params);
	}


	function addFilter($key, $var, $for=NULL)
	{
		if($for==NULL) $for='=';
		$this->filter[]=' AND '.$key.$for.$var;
	}


	function getDatesPeriod($startdate, $enddate)
	{
		if (class_exists('DateInterval'))
		{
			// Create array with all dates of the period - PHP 5.3+
			$start = new DateTime($startdate);

			$interval = '+1 days';
			$date_interval = DateInterval::createFromDateString($interval);

			$timestartdate = date('H:i', strtotime($startdate));
			$timeenddate = date('H:i', strtotime($enddate));

			if ($timeenddate <= $timestartdate)
			{
				$end = new DateTime("$enddate +1 days");
			}
			else
			{
				$end = new DateTime($enddate);
			}

			// Retourne toutes les dates.
			$perioddates = new DatePeriod($start, $date_interval, $end);
			$out = array();

		}
		else
		{
			// Create array with all dates of the period - PHP 5.2
			if (($startdate != $nodate) && ($enddate != $nodate))
			{
				$start = new DateTime($startdate);

				$timestartdate = date('H:i', strtotime($startdate));
				$timeenddate = date('H:i', strtotime($enddate));

				if ($timeenddate <= $timestartdate)
				{
					$end = new DateTime("$enddate +1 days");
				}
				else
				{
					$end = new DateTime($enddate);
				}

				while($start < $end)
				{
					$out[] = $start->format('Y-m-d H:i');
					$start->modify('+1 day');
				}
			}
		}

		// Prépare serialize.
		if (!empty($perioddates))
		{
			foreach($perioddates as $dt)
			{
				$out[] = (
				$dt->format('Y-m-d H:i')
				);
			}
		}

		$dates = $out;

		return $dates;
	}


	// function to get number of registered people to an event
	public function registered ($eventID)
	{
		// Preparing connection to db
		$db = JFactory::getDBO();

		// Preparing the query
		$query = $db->getQuery(true);
		$query->select(' sum(r.people) AS registered')->from('#__icagenda_registration AS r')->where('(r.eventId='.(int)$eventID.') AND (r.state > 0)');
		$db->setQuery($query);
		$people = $db->loadObjectList();

		$nbreg = $people[0]->registered;

		return $nbreg;

	}


	// Class Method
	function getStamp($params)
	{
		// iCthumb generator pre-settings
		include_once JPATH_ROOT.'/media/com_icagenda/scripts/icthumb.php';

		$iC_params = JComponentHelper::getParams('com_icagenda');

		// Check if GD is enabled on the server
		if (extension_loaded('gd') && function_exists('gd_info'))
		{
			$thumb_generator = $iC_params->get('thumb_generator', 1);
		}
		else
		{
			$thumb_generator = 0;
		}

		$timeformat='1';
		$timeformat=$iC_params->get('timeformat', 1);
		if ($timeformat == 1) {
			$lang_time = 'H:i';
		} else {
			$lang_time = 'h:i A';
		}

		// Check if fopen is allowed
		$fopen = true;
		$result = ini_get('allow_url_fopen');
		if (empty($result))
		{
			$fopen = false;
		}
		$this->start($params);

		// Get the database
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		// Build the query
		$query->select('e.*,
				e.place as place_name,
				c.title as cat_title,
				c.alias as cat_alias,
				c.color as cat_color,
				c.ordering as cat_order
			')
    		->from($db->qn('#__icagenda_events').' AS e')
			->leftJoin($db->qn('#__icagenda_category').' AS c ON '.$db->qn('c.id').' = '.$db->qn('e.catid'));

		// Where State is 'published'
		$where = $db->qn('e.state').' = '.$db->q('1');

		// Where event is 'approved'
		$where.= ' AND '.$db->qn('e.approval').' = '.$db->q('0');

		// Add filters
		if(isset($this->filter))
		{
			foreach ($this->filter as $filter)
			{
				$where.= $filter;
			}
		}

		// Check Access Levels
		$user = JFactory::getUser();
		$userID = $user->id;
		$userLevels = $user->getAuthorisedViewLevels();
		if (version_compare(JVERSION, '3.0', 'lt')) {
			$userGroups = $user->getAuthorisedGroups();
		} else {
			$userGroups = $user->groups;
		}

//		$user = JFactory::getUser();
//		$userLevels = $user->getAuthorisedViewLevels();
		$userAccess = implode(', ', $userLevels);
		if (!in_array('8', $userGroups))
		{
			$where.=' AND '.$db->qn('e.access').' IN ('.$userAccess.')';
		}

		// Where
		$query->where($where);

//		$query.=' LIMIT 0, 1000';

		// Run the query
		$db->setQuery($query);

		// Invoke the query
		$res = $db->loadObjectList();

		$days=$this->getDays($this->date_start, 'Y-m-d H:i');

		foreach ($res as $r)
		{
			// liste dates calendrier
			if (isset($next)) {$next=$next;} else {$next='';}

			$datemultiplelist=$this->getDatelist($r->dates, $next);
			$datelist=$datemultiplelist;

			$AllDates = array();
			if (isset($r->weekdays)) {$weekdays = $r->weekdays;} else {$weekdays = '';}

			$weekdays = explode (',', $weekdays);
			$weekdaysarray = array();

			foreach ($weekdays as $wed)
			{
				array_push($weekdaysarray, $wed);
			}

			if (in_array('', $weekdaysarray))
			{
				$arrayWeekDays = array(0,1,2,3,4,5,6);
			}
			elseif ($r->weekdays)
			{
				$arrayWeekDays = $weekdaysarray;
			}
			elseif (in_array('0', $weekdaysarray))
			{
				$arrayWeekDays = $weekdaysarray;
			}
			else
			{
				$arrayWeekDays = array(0,1,2,3,4,5,6);
			}
			$WeeksDays = $arrayWeekDays;

			// If Single Dates, added to all dates for this event
			$singledates = unserialize($r->dates);
			if ((isset ($datemultiplelist)) AND ($datemultiplelist!=NULL) AND (!in_array('0000-00-00 00:00:00', $singledates)))
			{
				$AllDates = array_merge($AllDates, $datemultiplelist);
			}

			$StDate = date('Y-m-d H:i', $this->mkttime($r->startdate));
			$EnDate = date('Y-m-d H:i', $this->mkttime($r->enddate));
			$perioddates = $this->getDatesPeriod($StDate, $EnDate);

			$onlyStDate='';
			if (isset($this->onlyStDate)) $onlyStDate=$this->onlyStDate;

			if ((isset ($perioddates)) AND ($perioddates!=NULL))
			{
				if ($onlyStDate==1)
				{
					array_push($AllDates, $StDate);
				}
				else
				{
					foreach ($perioddates as $Dat)
					{
						if (in_array(date('w', strtotime($Dat)), $WeeksDays))
						{
							$SingleDate = date('Y-m-d H:i', $this->mkttime($Dat));
							array_push($AllDates, $SingleDate);
						}
					}
				}
			}

			rsort($AllDates);

			//liste dates next
			$datemlist=$this->getmlist($r->dates, $next);
			$dateplist=$this->getplist($r->period, $next);
			if ($dateplist)
			{
				$datelistcal=array_merge($datemlist, $dateplist);
			}
			else
			{
				$datelistcal=$datemlist;
			}

			$todaytime=time();

			rsort($datelist);
			rsort($datelistcal);

			// requête Itemid
 			$lang = JFactory::getLanguage();
			$langcur = $lang->getTag();
			$langcurrent = $langcur;
			$noidm='';

			$db = JFactory::getDbo();
			$query	= $db->getQuery(true);
			$query->select('id AS idm')->from('#__menu')->where( "(link = 'index.php?option=com_icagenda&view=list') AND (published > 0) AND (language = '$langcurrent')" );
			$db->setQuery($query);
			$idm=$db->loadResult();
			$mItemid=$idm;

			if ($mItemid == NULL) {
			$db = JFactory::getDbo();
			$query	= $db->getQuery(true);
			$query->select('id AS noidm')->from('#__menu')->where( "(link = 'index.php?option=com_icagenda&view=list') AND (published > 0) AND (language = '*')" );
			$db->setQuery($query);
			$noidm=$db->loadResult();
			$noidm=$noidm;
			}
			$nolink = '';
			if ($noidm == NULL && $mItemid == NULL)
			{
				$nolink = 1;
			}

			$iCmenuitem='';
			$iCmenuitem=$params->get('iCmenuitem');

			if(is_numeric($iCmenuitem))
			{
				$lien = $iCmenuitem;
			}
			else
			{
				if ($mItemid == NULL)
				{
					$lien = $noidm;
				}
				else
				{
					$lien = $mItemid;
				}
			}

			$eventnumber = NULL;
			$eventnumber = $r->id;

			if ($nolink == 1)
			{
				$urlevent = '#';
			}
			else
			{
				$urlevent = JRoute::_('index.php?option=com_icagenda&amp;view=list&amp;layout=event&amp;id=' . (int)$eventnumber . '&amp;Itemid=' . (int)$lien);
			}


			// Gets Short Description limit, set in global options of the component iCagenda
			$limit = JComponentHelper::getParams('com_icagenda')->get('ShortDescLimit', '100');

			// Html tags removal Global Option (component iCagenda) - Short Description
			$Filtering_ShortDesc_Global = JComponentHelper::getParams('com_icagenda')->get('Filtering_ShortDesc_Global', '');
			$HTMLTags_ShortDesc_Global = JComponentHelper::getParams('com_icagenda')->get('HTMLTags_ShortDesc_Global', array());

			// Get Module Option
			$Filtering_ShortDesc_Local = $this->filtering_shortDesc;

			/**
			 * START Filtering HTML method
			 */
			$limit = is_numeric($limit) ? $limit : false;

			$descdata = $r->desc;
			$desc_full = deleteAllBetween('{', '}', $descdata);

			// Gets length of the short desc, when not filtered
			$limit_not_filtered = substr($desc_full, 0, $limit);
			$text_length = strlen($limit_not_filtered);

			// Gets length of the short desc, after html filtering
			$limit_filtered = preg_replace('/[\p{Z}\s]{2,}/u', ' ', $limit_not_filtered);
			$limit_filtered = strip_tags($limit_filtered);
			$text_short_length = strlen($limit_filtered);

			// Sets Limit + special tags authorized
			$limit_short = $limit + ($text_length - $text_short_length);

			// Replaces all authorized html tags with tag strings
			if (empty($Filtering_ShortDesc_Local)
				&& ($Filtering_ShortDesc_Global == '1') )
			{
				$desc_full = str_replace('+', '@@', $desc_full);
				$desc_full = in_array('1', $HTMLTags_ShortDesc_Global) ? str_replace('<br>', '+@br@', $desc_full) : $desc_full;
				$desc_full = in_array('1', $HTMLTags_ShortDesc_Global) ? str_replace('<br/>', '+@br@', $desc_full) : $desc_full;
				$desc_full = in_array('1', $HTMLTags_ShortDesc_Global) ? str_replace('<br />', '+@br@', $desc_full) : $desc_full;
				$desc_full = in_array('2', $HTMLTags_ShortDesc_Global) ? str_replace('<b>', '+@b@', $desc_full) : $desc_full;
				$desc_full = in_array('2', $HTMLTags_ShortDesc_Global) ? str_replace('</b>', '@bc@', $desc_full) : $desc_full;
				$desc_full = in_array('3', $HTMLTags_ShortDesc_Global) ? str_replace('<strong>', '@strong@', $desc_full) : $desc_full;
				$desc_full = in_array('3', $HTMLTags_ShortDesc_Global) ? str_replace('</strong>', '@strongc@', $desc_full) : $desc_full;
				$desc_full = in_array('4', $HTMLTags_ShortDesc_Global) ? str_replace('<i>', '@i@', $desc_full) : $desc_full;
				$desc_full = in_array('4', $HTMLTags_ShortDesc_Global) ? str_replace('</i>', '@ic@', $desc_full) : $desc_full;
				$desc_full = in_array('5', $HTMLTags_ShortDesc_Global) ? str_replace('<em>', '@em@', $desc_full) : $desc_full;
				$desc_full = in_array('5', $HTMLTags_ShortDesc_Global) ? str_replace('</em>', '@emc@', $desc_full) : $desc_full;
				$desc_full = in_array('6', $HTMLTags_ShortDesc_Global) ? str_replace('<u>', '@u@', $desc_full) : $desc_full;
				$desc_full = in_array('6', $HTMLTags_ShortDesc_Global) ? str_replace('</u>', '@uc@', $desc_full) : $desc_full;
			}
			elseif ( $Filtering_ShortDesc_Local == '2'
				|| (($Filtering_ShortDesc_Global == '') && empty($Filtering_ShortDesc_Local)) )
			{
				$desc_full = '@i@'.$desc_full.'@ic@';
				$limit_short = $limit_short + 7;
			}
			else
			{
				$desc_full = $desc_full;
			}

			// Removes HTML tags
			$desc_nohtml	= strip_tags($desc_full);

			// Replaces all sequences of two or more spaces, tabs, and/or line breaks with a single space
			$desc_nohtml	= preg_replace('/[\p{Z}\s]{2,}/u', ' ', $desc_nohtml);

			// Replaces all spaces with a single +
			$desc_nohtml	= str_replace(' ', '+', $desc_nohtml);

			if(strlen($desc_nohtml) > $limit_short)
			{
				// Cuts full description, to get short description
				$string_cut	= substr($desc_nohtml, 0, $limit_short);

				// Detects last space of the short description
				$last_space	= strrpos($string_cut, '+');

				// Cuts the short description after last space
				$string_ok	= substr($string_cut, 0, $last_space);

				// Counts number of tags converted to string, and returns lenght
				$nb_br			= substr_count($string_ok, '+@br@');
				$nb_plus		= substr_count($string_ok, '@@');
				$nb_bopen		= substr_count($string_ok, '@b@');
				$nb_bclose		= substr_count($string_ok, '@bc@');
				$nb_strongopen	= substr_count($string_ok, '@strong@');
				$nb_strongclose	= substr_count($string_ok, '@strongc@');
				$nb_iopen		= substr_count($string_ok, '@i@');
				$nb_iclose		= substr_count($string_ok, '@ic@');
				$nb_emopen		= substr_count($string_ok, '@em@');
				$nb_emclose		= substr_count($string_ok, '@emc@');
				$nb_uopen		= substr_count($string_ok, '@u@');
				$nb_uclose		= substr_count($string_ok, '@uc@');

				// Replaces tag strings with html tags
				$string_ok	= str_replace('@br@', '<br />', $string_ok);
				$string_ok	= str_replace('@b@', '<b>', $string_ok);
				$string_ok	= str_replace('@bc@', '</b>', $string_ok);
				$string_ok	= str_replace('@strong@', '<strong>', $string_ok);
				$string_ok	= str_replace('@strongc@', '</strong>', $string_ok);
				$string_ok	= str_replace('@i@', '<i>', $string_ok);
				$string_ok	= str_replace('@ic@', '</i>', $string_ok);
				$string_ok	= str_replace('@em@', '<em>', $string_ok);
				$string_ok	= str_replace('@emc@', '</em>', $string_ok);
				$string_ok	= str_replace('@u@', '<u>', $string_ok);
				$string_ok	= str_replace('@uc@', '</u>', $string_ok);
				$string_ok	= str_replace('+', ' ', $string_ok);
				$string_ok	= str_replace('@@', '+', $string_ok);

				$text = $string_ok;

				// Close html tags if not closed
				if ($nb_bclose < $nb_bopen) $text = $string_ok.'</b>';
				if ($nb_strongclose < $nb_strongopen) $text = $string_ok.'</strong>';
				if ($nb_iclose < $nb_iopen) $text = $string_ok.'</i>';
				if ($nb_emclose < $nb_emopen) $text = $string_ok.'</em>';
				if ($nb_uclose < $nb_uopen) $text = $string_ok.'</u>';

				$ic_readmore = '[&#46;&#46;&#46;]';
				$return_text = $text.' '.$ic_readmore;

				$descShort	= $limit ? $return_text : '';
			}
			else
			{
				$desc_full	= $desc_nohtml;
				$desc_full	= str_replace('@br@', '<br />', $desc_full);
				$desc_full	= str_replace('@b@', '<b>', $desc_full);
				$desc_full	= str_replace('@bc@', '</b>', $desc_full);
				$desc_full	= str_replace('@strong@', '<strong>', $desc_full);
				$desc_full	= str_replace('@strongc@', '</strong>', $desc_full);
				$desc_full	= str_replace('@i@', '<i>', $desc_full);
				$desc_full	= str_replace('@ic@', '</i>', $desc_full);
				$desc_full	= str_replace('@em@', '<em>', $desc_full);
				$desc_full	= str_replace('@emc@', '</em>', $desc_full);
				$desc_full	= str_replace('@u@', '<u>', $desc_full);
				$desc_full	= str_replace('@uc@', '</u>', $desc_full);
				$desc_full	= str_replace('+', ' ', $desc_full);
				$desc_full	= str_replace('@@', '+', $desc_full);

				$descShort	= $limit ? $desc_full : '';
			}
			/** END Filtering HTML function */


	/**
	 * To be moved to a special library
	 */
						// START iCthumb

						// Initialize Vars
						$Image_Link 			= '';
						$Thumb_Link 			= '';
						$Display_Thumb 			= false;
						$No_Thumb_Option		= false;
						$Default_Thumb			= false;
						$MimeTypeOK 			= true;
						$MimeTypeERROR			= false;
						$Invalid_Link 			= false;
						$Invalid_Img_Format		= false;
						$fopen_bmp_error_msg	= false;

						// SETTINGS ICTHUMB
						$FixedImageVar 			= $r->image;

						// Set if run iCthumb
						if (($FixedImageVar) AND ($thumb_generator == 1)) {

							$params_media = JComponentHelper::getParams('com_media');
							$image_path = $params_media->get('image_path', 'images');

							// Set folder vars
							$fld_icagenda 		= 'icagenda';
							$fld_thumbs 		= 'thumbs';
							$fld_copy	 		= 'copy';

							// SETTINGS ICTHUMB
							$thumb_width		= '100';
							$thumb_height		= '200';
							$thumb_quality		= '100';
							$thumb_destination	= 'themes/w'.$thumb_width.'h'.$thumb_height.'q'.$thumb_quality.'_';

							// Get Image File Infos
							$url = $FixedImageVar;
							$decomposition = explode( '/' , $url );
							// in each parent
							$i = 0;
							while ( isset($decomposition[$i]) )
								$i++;
							$i--;
							$imgname = $decomposition[$i];
							$fichier = explode( '.', $decomposition[$i] );
							$imgtitle = $fichier[0];
							$imgextension = strtolower($fichier[1]); // fixed 3.1.10

							// Clean file name
							jimport( 'joomla.filter.output' );
							$cleanFileName = JFilterOutput::stringURLSafe($imgtitle) . '.' . $imgextension;
							$cleanTitle = JFilterOutput::stringURLSafe($imgtitle);

//							$cleanFileName2 = cleanString($imgtitle) . '.' . $imgextension;
//							$cleanTitle2 = cleanString($imgtitle);

							// Paths to thumbs and copy folders
							$thumbsPath 			= $image_path.'/'.$fld_icagenda.'/'.$fld_thumbs.'/';
							$copyPath	 			= $image_path.'/'.$fld_icagenda.'/'.$fld_thumbs.'/'.$fld_copy.'/';

							// Image pre-settings
							$imageValue 			= $FixedImageVar;
							$Image_Link 			= $FixedImageVar;
							$Invalid_LinkMsg		= '<i class="icon-warning"></i><br /><span style="color:red;"><strong>' . JText::_('COM_ICAGENDA_INVALID_PICTURE_LINK') . '</strong></span>';
							$Wrong_img_format		= '<i class="icon-warning"></i><br/><span style="color:red;"><strong>' . JText::_('COM_ICAGENDA_NOT_AUTHORIZED_IMAGE_TYPE') . '</strong><br/>' . JText::_('COM_ICAGENDA_NOT_AUTHORIZED_IMAGE_TYPE_INFO') . '</span>';
							$fopen_bmp_error		= '<i class="icon-warning"></i><br/><span style="color:red;"><strong>' . JText::_('COM_ICAGENDA_PHP_ERROR_FOPEN_COPY_BMP') . '</strong><br/>' . JText::_('COM_ICAGENDA_PHP_ERROR_FOPEN_COPY_BMP_INFO') . '</span>';

							// Mime-Type pre-settings
							$errorMimeTypeMsg 		= '<i class="icon-warning"></i><br /><span style="color:red;"><strong>' . JText::_('COM_ICAGENDA_ERROR_MIME_TYPE') . '</strong><br/>' . JText::_('COM_ICAGENDA_ERROR_MIME_TYPE_NO_THUMBNAIL');

							// url to thumbnails already created
							$Thumb_Link 			= $image_path.'/'.$fld_icagenda.'/'.$fld_thumbs.'/'.$thumb_destination . $cleanFileName;
							$Thumb_aftercopy_Link 	= $image_path.'/'.$fld_icagenda.'/'.$fld_thumbs.'/'.$thumb_destination . $cleanTitle . '.jpg';

							// Check if thumbnails already created
							if ((file_exists(JPATH_ROOT . '/' . $Thumb_Link)) AND (!file_exists(JPATH_ROOT . '/' . $Thumb_aftercopy_Link))) {
								$Thumb_Link = $Thumb_Link;
								$Display_Thumb = true;
							}
							elseif (file_exists(JPATH_ROOT . '/' . $Thumb_aftercopy_Link)) {
								$Thumb_Link = $Thumb_aftercopy_Link;
								$Display_Thumb = true;
							}
							// if thumbnails not already created, create thumbnails
							else {

								if (filter_var($imageValue, FILTER_VALIDATE_URL)) {
									$linkToImage = $imageValue;
								} else {
									$linkToImage = JPATH_ROOT . '/' . $imageValue;
								}

								if (file_exists($linkToImage)) {

									// Test Mime-Type
									$fileinfos = getimagesize($linkToImage);
									$mimeType = $fileinfos['mime'];
									$extensionType = 'image/'.$imgextension;

									// Message Error Mime-Type info
									$errorMimeTypeInfo = '<span style="color:black;"><br/>' . JText::sprintf('COM_ICAGENDA_ERROR_MIME_TYPE_INFO', $imgextension, $mimeType);

									// Error message if Mime-Type is not the same as extension
									if (($imgextension == 'jpeg') OR ($imgextension == 'jpg')) {
										if (($mimeType != 'image/jpeg') AND ($mimeType != 'image/jpg')) {
											$MimeTypeOK 	= false;
											$MimeTypeERROR 	= true;
										}
									}
									elseif ($imgextension == 'bmp') {
										if (($mimeType != 'image/bmp') AND ($mimeType != 'image/x-ms-bmp')) {
											$MimeTypeOK 	= false;
											$MimeTypeERROR 	= true;
										}
									}
									else {
										if ($mimeType != $extensionType) {
											$MimeTypeOK 	= false;
											$MimeTypeERROR 	= true;
										}
									}
								}

								// If Error mime-type, no thumbnail creation
								if ($MimeTypeOK) {


									// Call function and create image thumbnail for events list in admin

									// If Image JPG, JPEG, PNG or GIF
									if (($imgextension == "jpg") OR ($imgextension == "jpeg") OR ($imgextension == "png") OR ($imgextension == "gif")) {

										$Thumb_Link = $Thumb_Link;

										if (!file_exists(JPATH_ROOT . '/' . $Thumb_Link)) {

											if (filter_var($imageValue, FILTER_VALIDATE_URL)) {

												if ((url_exists($imageValue)) AND ($fopen)) {

													$testFile = JPATH_ROOT . '/' . $copyPath . $cleanFileName;
													if (!file_exists($testFile)) {
														//Get the file
														$content = file_get_contents($imageValue);
														//Store in the filesystem.
														$fp = fopen(JPATH_ROOT . '/' . $copyPath . $cleanFileName, "w");
														fwrite($fp, $content);
														fclose($fp);
													}

													$linkToImage = JPATH_ROOT . '/' . $copyPath . $cleanFileName;
													$imageValue = $copyPath . $cleanFileName;

												} else {
													$linkToImage = $imageValue;
												}

											} else {
												$linkToImage = JPATH_ROOT . '/' . $imageValue;
											}

											if ((url_exists($linkToImage)) OR (file_exists($linkToImage))) {
												createthumb($linkToImage, JPATH_ROOT . '/' . $Thumb_Link, $thumb_width, $thumb_height, $thumb_quality);

											} else {
												$Invalid_Link = true;

											}
										}
									}

									// If Image BMP
									elseif ($imgextension == "bmp") {

										$Image_Link = $copyPath . $cleanTitle . '.jpg';

										$Thumb_Link = $Thumb_aftercopy_Link;

										if (!file_exists(JPATH_ROOT . '/' . $Thumb_Link)) {

											if (filter_var($imageValue, FILTER_VALIDATE_URL)) {

												if ((url_exists($imageValue)) AND ($fopen)) {

													$testFile = JPATH_ROOT . '/' . $copyPath . $cleanTitle . '.jpg';
													if (!file_exists($testFile)) {
														//Get the file
														$content = file_get_contents($imageValue);
														//Store in the filesystem.
														$fp = fopen(JPATH_ROOT . '/' . $copyPath . $cleanFileName, "w");
														fwrite($fp, $content);
														fclose($fp);
														$imageNewValue = JPATH_ROOT . '/' . $copyPath . $cleanFileName;
														imagejpeg(icImageCreateFromBMP($imageNewValue), JPATH_ROOT . '/' . $copyPath . $cleanTitle . '.jpg', 100);
														unlink($imageNewValue);
													}

												} else {
													$linkToImage = $imageValue;
												}

											} else {
												imagejpeg(icImageCreateFromBMP(JPATH_ROOT . '/' . $imageValue), JPATH_ROOT . '/' . $copyPath . $cleanTitle . '.jpg', 100);
											}

											$imageValue = $copyPath . $cleanTitle . '.jpg';
											$linkToImage = JPATH_ROOT . '/' . $imageValue;

											if (!$fopen) {
												$fopen_bmp_error_msg = true;
											}
											elseif ((url_exists($linkToImage)) OR (file_exists($linkToImage))) {
												createthumb($linkToImage, JPATH_ROOT . '/' . $Thumb_Link, $thumb_width, $thumb_height, $thumb_quality);
											}
											else {
												$Invalid_Link = true;
											}
										}
									}

									// If Not authorized Image Format
									else {
										if ((url_exists($linkToImage)) OR (file_exists($linkToImage))) {
											$Invalid_Img_Format = true;
										} else {
											$Invalid_Link = true;
										}
									}

									if (!$Invalid_Link) {
										$Display_Thumb = true;
									}
								}
								// If error Mime-Type
								else {
									if (($imgextension == "jpg") OR ($imgextension == "jpeg") OR ($imgextension == "png") OR ($imgextension == "gif") OR ($imgextension == "bmp")) {
										$MimeTypeERROR = true;
									} else {
										$Invalid_Img_Format = true;
										$MimeTypeERROR = false;
									}
								}
							}

						}
						elseif (($FixedImageVar) AND ($thumb_generator == 0)) {
							$No_Thumb_Option = true;
						}
						else {
							$Default_Thumb = true;
						}

						// END iCthumb



						// Set Thumbnail
						$default_thumbnail = 'media/com_icagenda/images/nophoto.jpg';
						if ($Invalid_Img_Format) {
							$thumb_img = $default_thumbnail;
						}

						if ($Invalid_Link) {
							$thumb_img = $default_thumbnail;
						}

						if ($MimeTypeERROR) {
							$thumb_img = $default_thumbnail;
						}

						if ($fopen_bmp_error_msg) {
							$thumb_img = $default_thumbnail;
						}

						if ($Display_Thumb) {
							$thumb_img = $Thumb_Link;
						}

						if ($No_Thumb_Option) {
							$thumb_img = $FixedImageVar;
						}

						if ($Default_Thumb) {
							if ($r->image) {
								$thumb_img = $default_thumbnail;
							} else {
								$thumb_img = '';
							}
						}

						if ((!file_exists(JPATH_ROOT . '/' . $Thumb_Link)) AND ($r->image)) {
							$thumb_img = $default_thumbnail;
						}

			$evtParams = '';
			$evtParams = new JRegistry($r->params);

			// Display Time
			$dp_time = $params->get('dp_time', 1);
			if ($dp_time == 1) {
				$r_time = true;
			} else {
				$r_time = false;
			}

			// Display City
			$dp_city = $params->get('dp_city', 1);
			if ($dp_city == 1) {
				$r_city = $r->city;
			} else {
				$r_city = false;
			}

			// Display Country
			$dp_country = $params->get('dp_country', 1);
			if ($dp_country == 1) {
				$r_country = $r->country;
			} else {
				$r_country = false;
			}

			// Display Venue Name
			$dp_venuename = $params->get('dp_venuename', 1);
			if ($dp_venuename == 1) {
				$r_place = $r->place_name;
			} else {
				$r_place = false;
			}

			// Display Short Description
			$dp_shortDesc = $params->get('dp_shortDesc', '');
			if (!$dp_shortDesc)
			{
				$descShort = false;
			}
			elseif ($dp_shortDesc == 2)
			{
				$descShort = $r->metadesc;
			}

			// Display Registration Infos
			$dp_regInfos = $params->get('dp_regInfos', 1);
			if ($dp_regInfos == 1) {
				$registered = $this->registered($r->id);
				$maxTickets = $evtParams->get('maxReg');
				$TicketsLeft = ($maxTickets - $registered);
			} else {
				$registered = false;
				$maxTickets = false;
				$TicketsLeft = false;
			}

			$event=array(
				'id' => (int)$r->id,
				'registered' => (int)$registered,
				'maxTickets' => (int)$maxTickets,
				'TicketsLeft' => (int)$TicketsLeft,
				'Itemid' => (int)$mItemid,
				'url'=> $urlevent,
				'title' => $r->title,
				'next' => $this->formatDate($r->next),
//				'image' => $r->image,
				'image' => $thumb_img,
				'address' => $r->address,
				'city' => $r_city,
				'country' => $r_country,
				'place' => $r_place,
				'description' => $r->desc,
				'descShort' => $descShort,
				'cat_title' => $r->cat_title,
				'cat_order' => $r->cat_order,
				'cat_color' => $r->cat_color,
				'nb_events' => count($r->id),
				'no_image' => JTEXT::_('MOD_ICCALENDAR_NO_IMAGE'),
				'params' => $r->params,
			);

			// Initialize
			$access='0';
			$control='';

			// Access Control
			$user = JFactory::getUser();
			$userLevels = $user->getAuthorisedViewLevels();
			$access=$r->access;
			if ($access == '0') { $access='1'; }

			if ( in_array($access, $userLevels) OR in_array('8', $userGroups) )
			{
				$control = $access;
			}

			// Language Control
			$lang = JFactory::getLanguage();
			$eventLang = '';
			$langTag = '';
			$langTag = $lang->getTag();

			if(isset($r->language)) $eventLang=$r->language;
			if($eventLang=='') $eventLang=$langTag;
			if($eventLang=='*') $eventLang=$langTag;

			$events_per_day = array();

			$displaytime	= '';
			if(isset($r->displaytime)) $displaytime = $r->displaytime;

			// Get List of Dates
			if ($control == $access)
			{
				if ($eventLang == $langTag)
				{
					if (is_numeric($lien) && is_numeric($eventnumber) && !is_array($lien) && !is_array($eventnumber))
					{
						if (is_array($event))
						{
							foreach ($AllDates as $d)
							{
								if ($r_time)
								{
									$time = array(
										'time' => date($lang_time, $this->mkttime($d)),
										'displaytime' => $displaytime
									);
								}
								else
								{
									$time = array(
										'time' => '',
										'displaytime' => ''
									);
								}
								$event = array_merge($event, $time);
								foreach ($days as $k=>$dy)
								{
									if(date('Y-m-d', strtotime($d))==date('Y-m-d', strtotime($dy['date'])))
									{
										array_push ($days[$k]['events'], $event);
									}
								}
							}
						}
					}
				}
			}
		}

		$i='';

 		$lang = JFactory::getLanguage();
		$langcur = $lang->getTag();
		$langcurrent = $langcur;

		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('id AS idm')->from('#__menu')->where( "(link = 'index.php?option=com_icagenda&view=list') AND (published > 0) AND (language = '$langcurrent')" );
		$db->setQuery($query);
		$idm=$db->loadResult();
		$mItemid=$idm;

		if ($mItemid == NULL) {
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('id AS noidm')->from('#__menu')->where( "(link = 'index.php?option=com_icagenda&view=list') AND (published > 0) AND (language = '*')" );
		$db->setQuery($query);
		$noidm=$db->loadResult();
		$noidm=$noidm;
		}
		$nolink = '';
		if ($noidm == NULL && $mItemid == NULL) {
			$nolink = 1;
		}
		if ($nolink == 1) {
			do {
				echo '<div style="color:#a40505; text-align: center;"><b>info :</b></div><div style="color:#a40505; font-size: 0.8em; text-align: center;">'.JText::_( 'MOD_ICCALENDAR_COM_ICAGENDA_MENULINK_UNPUBLISHED_MESSAGE' ).'</div>';
			} while ($i > 0);
  		}

		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('id AS nbevt')->from('`#__icagenda_events` AS e')->where('e.state > 0');
		$db->setQuery($query);
		$nbevt=$db->loadResult();
		$nbevt=count($nbevt);
		if ($nbevt == NULL) {
//			do {
				echo '<div style="font-size: 0.8em; text-align: center;">'.JText::_( 'MOD_ICCALENDAR_NO_EVENT' ).'</div>';
//			} while ($i = 0);
  		}

		return $days;

	}

	// test
	function clickDate ($eventdate, $d)
	{
		$eventdate = $d;
		return $eventdate;
	}


	/**
	 * To be moved to a special library
	 */
	// Function to get Format Date (using option format, and translation)
	protected function formatDate ($d)
	{
		$mkt_date=$this->mkt($d);

		$for = '0';
		// Global Option for Date Format
		$date_format_global = JComponentHelper::getParams('com_icagenda')->get('date_format_global', 'Y - m - d');
		$date_format_global = $date_format_global ? $date_format_global : 'Y - m - d';

		// Menu Option for Date Format
		if(isset($this->format)) $for = $this->format;

		// default
		if (($for == NULL) OR ($for == '0'))
		{
			$for = isset($date_format_global) ? $date_format_global : 'Y - m - d';
		}

		if (!is_numeric($for))
		{
			//update default value, from 2.0.x to 2.1
			if ($for == '%d.%m.%Y') {$for = 'd m Y'; $separator = '.';}
			elseif ($for == '%d.%m.%y') {$for = 'd m y'; $separator = '.';}
			elseif ($for == '%Y.%m.%d') {$for = 'Y m d'; $separator = '.';}
			elseif ($for == '%Y.%b.%d') {$for = 'Y M d'; $separator = '.';}

			elseif ($for == '%d-%m-%Y') {$for = 'd m Y'; $separator = '-';}
			elseif ($for == '%d-%m-%y') {$for = 'd m y'; $separator = '-';}
			elseif ($for == '%Y-%m-%d') {$for = 'Y m d'; $separator = '-';}
			elseif ($for == '%Y-%b-%d') {$for = 'Y M d'; $separator = '-';}

			elseif ($for == '%d/%m/%Y') {$for = 'd m Y'; $separator = '/';}
			elseif ($for == '%d/%m/%y') {$for = 'd m y'; $separator = '/';}
			elseif ($for == '%Y/%m/%d') {$for = 'Y m d'; $separator = '/';}
			elseif ($for == '%Y/%b/%d') {$for = 'Y M d'; $separator = '/';}

			elseif ($for == '%d %B %Y') {$for = 'd F Y';}
			elseif ($for == '%d %b %Y') {$for = 'd M Y';}

			elseif ($for == '%A, %d %B %Y') {$for = 'l, _ d _ Fnosep _ Y';}
			elseif ($for == '%a %d %b %Y') {$for = 'D _ d _ Mnosep _ Y';}
			elseif ($for == '%A, %B %d, %Y') {$for = 'l, _ Fnosep _ d, _ Y';}
			elseif ($for == '%a, %b %d, %Y') {$for = 'D, _ Mnosep _ d, _ Y';}


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
		}


		// NEW DATE FORMAT GLOBALIZED 2.1.7

		$lang = JFactory::getLanguage();
		$langTag = $lang->getTag();
		$langName = $lang->getName();
		if(!file_exists(JPATH_ADMINISTRATOR.'/components/com_icagenda/globalization/'.$langTag.'.php'))
		{
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
		$dateFormat=date('Y-m-d H:i', $mkt_date);
		if (isset($this->date_separator)) $separator = $this->date_separator;
		foreach($exformat as $k=>$val){
			switch($val){

				// day (v3)
				case 'd': $val=date("d", strtotime("$dateFormat")); break;
				case 'j': $val=strftime("$dayj", strtotime("$dateFormat")); break;
				case 'D': $val=JText::_(date("D", strtotime("$dateFormat"))); break;
				case 'l': $val=JText::_(date("l", strtotime("$dateFormat"))); break;
//				case 'dS': $val=strftime("%d", strtotime("$dateFormat")).'<sup>'.date("S", strtotime("$dateFormat")).'</sup>'; break;
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


	// Function to get TimeZone offset
	function get_timezone_offset($remote_tz, $origin_tz = null)
	{
		if($origin_tz === null)
		{
			if(!is_string($origin_tz = date_default_timezone_get()))
			{
				return false; // A UTC timestamp was returned -- bail out!
			}
		}
		$origin_dtz = new DateTimeZone($origin_tz);
		$remote_dtz = new DateTimeZone($remote_tz);
		$origin_dt = new DateTime("now", $origin_dtz);
		$remote_dt = new DateTime("now", $remote_dtz);
		$offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
		return $offset;
	}


	// Génération des jours du mois
	function getDays ($d, $f)
	{
		//update default value, from 1.2.2 to 1.2.3
		if ($f == 'd-m-Y') {
			$f = '%d-%m-%Y';
		}

		// détermine le mois et l'année
		$ex_data=explode('-', $d);
		$month=$ex_data[1];
		$year=$ex_data[0];
		$jour=$ex_data[2];

		// Génération du Calendrier
		$days = date("d", mktime(0, 0, 0, $month+1, 0, $year));
		$list = array();


		//
		// Setting function of the visitor Time Zone
		//
		$today=time();

		$config = JFactory::getConfig();
		if(version_compare(JVERSION, '3.0', 'ge')) {
			$joomla_offset = $config->get('offset');
		} else {
			$joomla_offset = $config->getValue('config.offset');
		}

		$opt_TimeZone = '';
		$displayDatesTimezone = '0';
		if (isset($this->setTodayTimezone)) $opt_TimeZone = $this->setTodayTimezone;
//		if (isset($this->displayDatesTimezone)) $displayDatesTimezone = $this->displayDatesTimezone;

		$gmt_today = gmdate('Y-m-d H:i:s', $today);
		$today_timestamp = strtotime($gmt_today);

		$GMT_timezone = 'Etc/UTC';

		if($opt_TimeZone == 'SITE')
		{
			// Joomla Server Time Zone
			$visitor_timezone = $joomla_offset;
			$offset = $this->get_timezone_offset($GMT_timezone, $visitor_timezone);
			$visitor_today = date('Y-m-d H:i:s', ($today_timestamp+$offset));
			$UTCsite = $offset / 3600;
			if ($UTCsite > 0) $UTCsite = '+'.$UTCsite;
			if ($displayDatesTimezone == '1') {
				echo '<small>'.JHtml::date('now', 'Y-m-d H:i:s', true).' UTC'.$UTCsite.'</small><br />';
			}
		}
		elseif ($opt_TimeZone == 'UTC')
		{
			// UTC Time Zone
			$offset = 0;
			$visitor_today = date('Y-m-d H:i:s', ($today_timestamp+$offset));
			$UTC = $offset / 3600;
			if ($UTC > 0) $UTC = '+'.$UTC;
			if ($displayDatesTimezone == '1') {
				echo '<small>'.gmdate('Y-m-d H:i:s', $today).' UTC'.$UTC.'</small><br />';
			}
		}
		else
		{
			$visitor_today = date('Y-m-d H:i:s', ($today_timestamp));
		}

		$date_today=str_replace(' ', '-', $visitor_today);
		$date_today=str_replace(':', '-', $date_today);
		$ex_data=explode('-', $date_today);
		$v_month=$ex_data[1];
		$v_year=$ex_data[0];
		$v_day=$ex_data[2];
		$v_hours=$ex_data[3];
		$v_minutes=$ex_data[4];

		for($a=1; $a<=$days; $a++)
		{
			if (($a == $v_day) && ($month == $v_month) && ($year == $v_year))
			{
				$classDay = 'style_Today';
			}
			else
			{
				$classDay = 'style_Day';
			}

			$datejour = date('Y-m-d', mktime(0, 0, 0, $month, $a, $year));

			$list[$a]['date'] = date('Y-m-d H:i', mktime(0, 0, 0, $month, $a, $year));
			$list[$a]['dateFormat'] = strftime($f, mktime(0, 0, 0, $month, $a, $year));
			$list[$a]['dateTitle'] =  $this->formatDate($datejour);
			$list[$a]['week'] = date('N', mktime(0, 0, 0, $month, $a, $year));

			$list[$a]['day'] = "<div class='".$classDay."'>".$a."</div>";

			// Set cal_date
			$list[$a]['this_day'] = substr($list[$a]['date'], 0, 10);

			// Added in 2.1.2 (change in NAME_day.php)
			$list[$a]['ifToday'] = $classDay;
			$list[$a]['Days'] = $a;
			//
			$list[$a]['month'] = $month;
			$list[$a]['year'] = $year;
			$list[$a]['events']=array();
//			$list[$a]['plus'] = "$stamp->events[1]['cat_color']";

		}

		return $list;
	}
	/***/

	/**
	 * liste des dates pour un évènement
	 */
	private function getDatelist($dates, $next)
	{

		$dates=unserialize($dates);
		$da=array();
		foreach($dates as $d){
			$d=$this->mkttime($d);
			if($d>=$next){
				array_push($da, date('Y-m-d H:i', $d));
			}
		}
		return $da;
	}

	private function getPeriodlist($period, $next)
	{

		if ($period) {
			$period=unserialize($period);
			$da=array();
			foreach($period as $d){
				$d=$this->mkttime($d);
				if($d>=$next){
					array_push($da, date('Y-m-d H:i', $d));
				}
			}
		} else {
			$da = NULL;
		}
		return $da;
	}

	private function getmlist($dates, $next)
	{

		$dates=unserialize($dates);
		$da=array();
		foreach($dates as $d){
			$d=$this->mkttime($d);
			if($d>=$next){
				array_push($da, date('Y-m-d H:i', $d));
			}
		}
		return $da;
	}

	private function getplist($period, $next)
	{

		if ($period) {
			$period=unserialize($period);
			$da=array();
			foreach($period as $d){
				$d=$this->mkttime($d);
				if($d>=$next){
					array_push($da, date('Y-m-d H:i', $d));
				}
			}
		} else {
			$da = NULL;
		}
		return $da;
	}

	// Format Date
	private function mkt($data)
	{
		$data=str_replace(' ', '-', $data);
		$data=str_replace(':', '-', $data);
		$ex_data=explode('-', $data);
		$ris=mktime('0', '0', '0', $ex_data['1'], $ex_data['2'], $ex_data['0']);
		return strftime($ris);
	}

	private function mkttime($data)
	{
		$data=str_replace(' ', '-', $data);
		$data=str_replace(':', '-', $data);
		$ex_data=explode('-', $data);
		if (isset($ex_data['3'])) {
			$ris=mktime($ex_data['3'], $ex_data['4'], '00', $ex_data['1'], $ex_data['2'], $ex_data['0']);
		} else {
			$ris=mktime('00', '00', '00', $ex_data['1'], $ex_data['2'], $ex_data['0']);
		}
		return strftime($ris);
	}

	//
	private function addDay ($mkt)
	{
		return $mkt+82800;
	}



	/***/

	/** Systeme de navigation **/
	function getNav($date_start, $modid)
	{
		// Return Current URL
		$view='';
		$layout='';
		$Itemid='';
		$id='';
		$option = 'index.php?option='.JRequest::getVar('option');
		if(JRequest::getVar('view'))$view = '&view='.JRequest::getVar('view');
		if(JRequest::getVar('layout'))$layout = '&layout='.JRequest::getVar('layout');
		if(JRequest::getInt('Itemid'))$Itemid = '&Itemid='.JRequest::getInt('Itemid');
		if(JRequest::getInt('id'))$id = '&id='.JRequest::getVar('id');
				$Aurl = JURI::root().$option.$view.$layout.$Itemid.$id;

		$ex_date=explode('-', $date_start);
		$mkt_date=$this->mkt($date_start);
		$year=$ex_date[0];
		$month=$ex_date[1];
		$day=1;

		if($month!=1){$backMonth=$month-1; $backYear=$year;}
		if($month==1){$backMonth=12; $backYear=$year-1;}
		if($month!=12){$nextMonth=$month+1; $nextYear=$year;}
		if($month==12){$nextMonth=1; $nextYear=$year+1;}
		$backYYear = $year-1;
		$nextYYear = $year+1;


		$backY='<a class="backicY icagendabtn_'.$modid.'" href="'.JRoute::_($Aurl.'&iccaldate='.$backYYear.'-'.$month.'-'.$day).'" rel="nofollow"><span aria-hidden="true" class="iCicon-backicY"></span></a>';
		$back='<a class="backic icagendabtn_'.$modid.'" href="'.JRoute::_($Aurl.'&iccaldate='.$backYear.'-'.$backMonth.'-'.$day).'" rel="nofollow"><span aria-hidden="true" class="iCicon-backic"></span></a>';

		$next='<a class="nextic icagendabtn_'.$modid.'" href="'.JRoute::_($Aurl.'&iccaldate='.$nextYear.'-'.$nextMonth.'-'.$day).'" rel="nofollow"><span aria-hidden="true" class="iCicon-nextic"></span></a>';
		$nextY='<a class="nexticY icagendabtn_'.$modid.'" href="'.JRoute::_($Aurl.'&iccaldate='.$nextYYear.'-'.$month.'-'.$day).'" rel="nofollow"><span aria-hidden="true" class="iCicon-nexticY"></span></a>';


	/** translate the month in the calendar module -- Leland Vandervort **/
		$dateFormat=date('d-M-Y', $mkt_date);

		// split out the month and year to obtain translation key for JText using joomla core translation
		$t_day = strftime("%d", strtotime("$dateFormat"));
		$t_month = date("F", strtotime("$dateFormat"));
		$t_year = strftime("%Y", strtotime("$dateFormat"));

		$lang = JFactory::getLanguage();
		$langTag = $lang->getTag();
		$yearBeforeMonth = array('ar-AA', 'ja-JP');
		if (in_array($langTag, $yearBeforeMonth))
		{
			$monthBeforeYear = 0;
		}
		else
		{
			$monthBeforeYear = 1;
		}
		/**
		 * Get monthBeforeYear metadata param from Current Language xml file
		 *
		 * This will load strings from language packs to set prefix, suffix, separator for month and year if needed.
		 * If not needed by a language, the translation string could be empty, or a copy/paste of en-GB source translation
		 * (usage of a sentence to help understanding on a translation platform such as Transifex)
		 *
		 * This feature has been proposed to Joomla core recently, so not yet available officially : https://github.com/joomla/joomla-cms/pull/2809
		 */

//		if(version_compare(JVERSION, '3.2', 'ge')) {
//			$monthBeforeYear = JFactory::getLanguage()->getMonthBeforeYear();
//		} else {
//			$monthBeforeYear = 1;
//		}

		/**
		 * Get prefix, suffix and separator for month and year in calendar title
		 */

		// Separator Month/Year
		$separator_month_year = JText::_('SEPARATOR_MONTH_YEAR');
		if ($separator_month_year == 'CALENDAR_SEPARATOR_MONTH_YEAR_FACULTATIVE')
		{
			$separator_month_year = ' ';
		}
		elseif ($separator_month_year == 'NO_SEPARATOR')
		{
			$separator_month_year = '';
		}

		// Prefix Month (Facultative)
		$prefix_month = JText::_('PREFIX_MONTH');
		if ($prefix_month == 'CALENDAR_PREFIX_MONTH_FACULTATIVE')
		{
			$prefix_month = '';
		}

		// Suffix Month (Facultative)
		$suffix_month = JText::_('SUFFIX_MONTH');
		if ($suffix_month == 'CALENDAR_SUFFIX_MONTH_FACULTATIVE')
		{
			$suffix_month = '';
		}

		// Prefix Year (Facultative)
		$prefix_year = JText::_('PREFIX_YEAR');
		if ($prefix_year == 'CALENDAR_PREFIX_YEAR_FACULTATIVE')
		{
			$prefix_year = '';
		}

		// Suffix Year (Facultative)
		$suffix_year = JText::_('SUFFIX_YEAR');
		if ($suffix_year == 'CALENDAR_SUFFIX_YEAR_FACULTATIVE')
		{
			$suffix_year = '';
		}

		$SEP	= $separator_month_year;
		$PM		= $prefix_month;
		$SM		= $suffix_month;
		$PY		= $prefix_year;
		$SY		= $suffix_year;

		// Get MONTH_CAL string or if not translated, use MONTHS
		$array_months = array(
			'JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE',
			'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'
		);

		$cal_string = $t_month.'_CAL';
//		$missing_cal_string = function_exists('mb_strtoupper') ? JText::_(mb_strtoupper($cal_string, 'UTF-8')) : JText::_(strtoupper($cal_string));
		$missing_cal_string = stringToJText($cal_string);


		if ( in_array( $missing_cal_string, $array_months) )
		{
			// if MONTHS_CAL strings not translated in current language, use MONTHS strings
			$month_J = JText::_( $t_month );
		}
		else
		{
			// Use MONTHS_CAL strings when translated in current language
			$month_J = JText::_( $t_month.'_CAL' );
		}

		// Set Calendar Title
		if ($monthBeforeYear == 0) {
			$title = $PY . $t_year . $SY . $SEP . $PM . $month_J . $SM;
		} else {
			$title = $PM . $month_J . $SM . $SEP . $PY . $t_year . $SY;
		}

		// Set Nav Bar for calendar
		$html='<div class="icnav">'.$backY.$back.$nextY.$next.'<div class="titleic">'.$title.'</div></div>';
		$html.='<div style="clear:both"></div>';

		return $html;
	}

//	public function getMonthBeforeYear()
//	{
//		return (int) (isset($this->metadata['monthBeforeYear']) ? $this->metadata['monthBeforeYear'] : 1);
//	}


}

/**
 * This method processes a string and replaces all accented UTF-8 characters by unaccented
 * ASCII-7 "equivalents" and the string is uppercase.
 *
 * @param   string  $string  String to process
 *
 * @return  string  Processed string
 *
 * @since   3.3.3
 */


function deleteAllBetween($start, $end, $string)
{
	$startPos = strpos($string, $start);
	$endPos = strpos($string, $end);
	if (!$startPos || !$endPos)
	{
		return $string;
	}

	$textToDelete = substr($string, $startPos, ($endPos + strlen($end)) - $startPos);

	return str_replace($textToDelete, '', $string);
}

function stringToJText($string)
{
	// Remove any '-' from the string since they will be used as concatenaters
	$str = str_replace('_', ' ', $string);

	$lang = JFactory::getLanguage();
	$str = $lang->transliterate($str);

	// Trim white spaces at beginning and end of alias and make lowercase
	$str = trim(JString::strtoupper($str));

	// Remove any duplicate whitespace, and ensure all characters are alphanumeric
	$str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '_', $str);

	// Trim spaces at beginning and end of alias
	$str = trim($str, '_');

	return $str;
}


function activeColor($color)
{
	#convert hexadecimal to RGB
	if(!is_array($color) && preg_match("/^[#]([0-9a-fA-F]{6})$/",$color)){
		$hex_R = substr($color,1,2);
		$hex_G = substr($color,3,2);
		$hex_B = substr($color,5,2);
		$RGB = hexdec($hex_R).",".hexdec($hex_G).",".hexdec($hex_B);
		return $RGB;
	}
}



class cal
{

	public $data;
	public $template;
	public $t_calendar;
	public $t_day;
	public $nav;
	public $fontcolor;
	private $header_text;

	function __construct ($data, $t_calendar, $t_day, $nav,
		$mon, $tue, $wed, $thu, $fri, $sat, $sun,
		$firstday,
		$calfontcolor, $OneEventbgcolor, $Eventsbgcolor, $bgcolor, $bgimage, $bgimagerepeat,
		$na, $nb, $nc, $nd, $ne, $nf, $ng,
		$moduleclass_sfx, $modid, $template, $ictip_ordering, $header_text)
	{
		$this->data = $data;
		$this->t_calendar = $t_calendar;
		$this->t_day = $t_day;
		$this->nav = $nav;
		$this->mon = $mon;
		$this->tue = $tue;
		$this->wed = $wed;
		$this->thu = $thu;
		$this->fri = $fri;
		$this->sat = $sat;
		$this->sun = $sun;
		$this->na = $na;
		$this->nb = $nb;
		$this->nc = $nc;
		$this->nd = $nd;
		$this->ne = $ne;
		$this->nf = $nf;
		$this->ng = $ng;
		$this->firstday = $firstday;
		$this->calfontcolor = $calfontcolor;
		$this->OneEventbgcolor = $OneEventbgcolor;
		$this->Eventsbgcolor = $Eventsbgcolor;
		$this->bgcolor = $bgcolor;
		$this->bgimage = $bgimage;
		$this->bgimagerepeat = $bgimagerepeat;
		$this->moduleclass_sfx = $moduleclass_sfx;
		$this->modid = $modid;
		$this->template = $template;
		$this->ictip_ordering = $ictip_ordering;
		$this->header_text = $header_text;


	}

	function days ()
	{
		$this_calfontcolor	= str_replace(' ', '', $this->calfontcolor);
		$calfontcolor		= !empty($this_calfontcolor) ? 'color:'.$this->calfontcolor.';' : '';
		$this_bgcolor		= str_replace(' ', '', $this->bgcolor);
		$bgcolor			= !empty($this_bgcolor) ? 'background-color:'.$this->bgcolor.';' : '';
		$this_bgimage		= str_replace(' ', '', $this->bgimage);
		$bgimage			= !empty($this_bgimage) ? 'background-image:url(\''.$this->bgimage.'\');' : '';
		$this_bgimagerepeat	= str_replace(' ', '', $this->bgimagerepeat);
		$bgimagerepeat		= !empty($this_bgimagerepeat) ? 'background-repeat:'.$this->bgimagerepeat.';' : '';
		$iCcal_style = '';
		if ( !empty($this_calfontcolor)
			OR !empty($this_bgcolor)
			OR !empty($this_bgimage)
			OR !empty($this_bgimagerepeat) )
		{
			$iCcal_style.= 'style="';
		}
		if ( !empty($this_calfontcolor) )
		{
			$iCcal_style.= $calfontcolor;
		}
		if ( !empty($this_bgcolor) )
		{
			$iCcal_style.= $bgcolor;
		}
		if ( !empty($this_bgimage) )
		{
			$iCcal_style.= $bgimage;
		}
		if ( !empty($this_bgimagerepeat)
			&& !empty($this_bgimage) )
		{
			$iCcal_style.= $bgimagerepeat;
		}
		if (empty($this_bgcolor)
			&& empty($this_bgimage))
		{
			$iCcal_style.= 'background-color: transparent; background-image: none';
		}
		$iCcal_style.= '"';

		// Verify Hex color strings
		$OneEventbgcolor = preg_match('/^#[a-f0-9]{6}$/i', $this->OneEventbgcolor) ? $this->OneEventbgcolor : '';
		$Eventsbgcolor = preg_match('/^#[a-f0-9]{6}$/i', $this->Eventsbgcolor) ? $this->Eventsbgcolor : '';


		echo '<div class="'.$this->template.' iccalendar '.$this->moduleclass_sfx.'" '.$iCcal_style.' id="'.$this->modid.'">';


		if ($this->firstday=='0') {
			echo '<div id="mod_iccalendar_'.$this->modid.'">
			<div class="icagenda_header">'.$this->header_text.'
			</div>'.$this->nav.'
			<table id="icagenda_calendar" style="width:100%;">
				<thead>
					<tr>
						<th style="width:14.2857143%;background:'.$this->sun.';">'.JText::_('SUN').'</th>
						<th style="width:14.2857143%;background:'.$this->mon.';">'.JText::_('MON').'</th>
						<th style="width:14.2857143%;background:'.$this->tue.';">'.JText::_('TUE').'</th>
						<th style="width:14.2857143%;background:'.$this->wed.';">'.JText::_('WED').'</th>
						<th style="width:14.2857143%;background:'.$this->thu.';">'.JText::_('THU').'</th>
						<th style="width:14.2857143%;background:'.$this->fri.';">'.JText::_('FRI').'</th>
						<th style="width:14.2857143%;background:'.$this->sat.';">'.JText::_('SAT').'</th>
					</tr>
				</thead>
		';
		}
		elseif ($this->firstday=='1') {
			echo '<div id="mod_iccalendar_'.$this->modid.'">
			<div class="icagenda_header">'.$this->header_text.'
			</div>'.$this->nav.'
			<table id="icagenda_calendar" style="width:100%;">
				<thead>
					<tr>
						<th style="width:14.2857143%;background:'.$this->mon.';">'.JText::_('MON').'</th>
						<th style="width:14.2857143%;background:'.$this->tue.';">'.JText::_('TUE').'</th>
						<th style="width:14.2857143%;background:'.$this->wed.';">'.JText::_('WED').'</th>
						<th style="width:14.2857143%;background:'.$this->thu.';">'.JText::_('THU').'</th>
						<th style="width:14.2857143%;background:'.$this->fri.';">'.JText::_('FRI').'</th>
						<th style="width:14.2857143%;background:'.$this->sat.';">'.JText::_('SAT').'</th>
						<th style="width:14.2857143%;background:'.$this->sun.';">'.JText::_('SUN').'</th>
					</tr>
				</thead>
		';
		}

		switch ($this->data[1]['week']){
			case $this->na:
				break;
			default:
				echo '<tr><td colspan="'.($this->data[1]['week']-$this->firstday).'"></td>';
				break;
		}

		foreach ($this->data as $d){
			$stamp= new day($d);

			if ($this->firstday=='0') {
				switch($stamp->week){
					case $this->na:
						echo '<tr><td style="background:'.$this->sun.';">';
						break;
					case $this->nb:
						echo '<td style="background:'.$this->mon.';">';
						break;
					case $this->nc:
						echo '<td style="background:'.$this->tue.';">';
						break;
					case $this->nd:
						echo '<td style="background:'.$this->wed.';">';
						break;
					case $this->ne:
						echo '<td style="background:'.$this->thu.';">';
						break;
					case $this->nf:
						echo '<td style="background:'.$this->fri.';">';
						break;
					case $this->ng:
						echo '<td style="background:'.$this->sat.';">';
						break;
					default:
						echo '<td>';
						break;
				}
			}

			if ($this->firstday=='1') {
				switch($stamp->week){
					case $this->na:
						echo '<tr><td style="background:'.$this->mon.';">';
						break;
					case $this->nb:
						echo '<td style="background:'.$this->tue.';">';
						break;
					case $this->nc:
						echo '<td style="background:'.$this->wed.';">';
						break;
					case $this->nd:
						echo '<td style="background:'.$this->thu.';">';
						break;
					case $this->ne:
						echo '<td style="background:'.$this->fri.';">';
						break;
					case $this->nf:
						echo '<td style="background:'.$this->sat.';">';
						break;
					case $this->ng:
						echo '<td style="background:'.$this->sun.';">';
						break;
					default:
						echo '<td>';
						break;
				}
			}
			$count_events = count($stamp->events);

			if ($OneEventbgcolor
				AND $OneEventbgcolor != ' '
				AND $count_events == '1')
			{
				$bg_day = $OneEventbgcolor;
			}
			elseif ($Eventsbgcolor
				AND $Eventsbgcolor != ' '
				AND $count_events > '1')
			{
				$bg_day = $Eventsbgcolor;
			}
			else
			{
				$bg_day = isset($stamp->events[0]['cat_color']) ? $stamp->events[0]['cat_color'] : '#d4d4d4';
			}

			$bgcolor ='';
			if (isset($bg_day)) {
				$RGB = explode(",",activeColor($bg_day));
				$c = array($RGB[0], $RGB[1], $RGB[2]);
				$bgcolor = array_sum($c);
			}
			if ($bgcolor > '600') {
				$bgcolor='bright';
			} else {
				$bgcolor='';
			}
			$order='first';

			$multi_events = isset($stamp->events[1]['cat_color']) ? 'icmulti' : '';

			// Ordering by time New Theme Packs (since 3.2.9)
			$events = $stamp->events;

			// Option for Ordering is not yet finished. This developpement is in brainstorming...
			$ictip_ordering = '1';
			$ictip_ordering = $this->ictip_ordering;

			if ($ictip_ordering == '1_ASC-1_ASC' OR $ictip_ordering == '1_ASC-1_DESC') $ictip_ordering = '1_ASC';
			if ($ictip_ordering == '2_ASC-2_ASC' OR $ictip_ordering == '2_ASC-2_DESC') $ictip_ordering = '2_ASC';
			if ($ictip_ordering == '1_DESC-1_ASC' OR $ictip_ordering == '1_DESC-1_DESC') $ictip_ordering = '1_DESC';
			if ($ictip_ordering == '2_DESC-2_ASC' OR $ictip_ordering == '2_DESC-2_DESC') $ictip_ordering = '2_DESC';

			// Create Functions for Ordering
			$newfunc_1_ASC_2_ASC = create_function('$a, $b', 'if ($a["time"] == $b["time"]){ return strcasecmp($a["cat_title"], $b["cat_title"]); } else { return strcasecmp($a["time"], $b["time"]); }');
			$newfunc_1_ASC_2_DESC = create_function('$a, $b', 'if ($a["time"] == $b["time"]){ return strcasecmp($b["cat_title"], $a["cat_title"]); } else { return strcasecmp($a["time"], $b["time"]); }');
			$newfunc_1_DESC_2_ASC = create_function('$a, $b', 'if ($a["time"] == $b["time"]){ return strcasecmp($a["cat_title"], $b["cat_title"]); } else { return strcasecmp($b["time"], $a["time"]); }');
			$newfunc_1_DESC_2_DESC = create_function('$a, $b', 'if ($a["time"] == $b["time"]){ return strcasecmp($b["cat_title"], $a["cat_title"]); } else { return strcasecmp($b["time"], $a["time"]); }');

			$newfunc_2_ASC_1_ASC = create_function('$a, $b', 'if ($a["cat_title"] == $b["cat_title"]){ return strcasecmp($a["time"], $b["time"]); } else { return strcasecmp($a["cat_title"], $b["cat_title"]); }');
			$newfunc_2_ASC_1_DESC = create_function('$a, $b', 'if ($a["cat_title"] == $b["cat_title"]){ return strcasecmp($b["time"], $a["time"]); } else { return strcasecmp($a["cat_title"], $b["cat_title"]); }');
			$newfunc_2_DESC_1_ASC = create_function('$a, $b', 'if ($a["cat_title"] == $b["cat_title"]){ return strcasecmp($a["time"], $b["time"]); } else { return strcasecmp($b["cat_title"], $a["cat_title"]); }');
			$newfunc_2_DESC_1_DESC = create_function('$a, $b', 'if ($a["cat_title"] == $b["cat_title"]){ return strcasecmp($b["time"], $a["time"]); } else { return strcasecmp($b["cat_title"], $a["cat_title"]); }');

			$newfunc_1_ASC = create_function('$a, $b', 'return strcasecmp($a["time"], $b["time"]);');
			$newfunc_2_ASC = create_function('$a, $b', 'return strcasecmp($a["cat_title"], $b["cat_title"]);');

			$newfunc_1_DESC = create_function('$a, $b', 'return strcasecmp($b["time"], $a["time"]);');
			$newfunc_2_DESC = create_function('$a, $b', 'return strcasecmp($b["cat_title"], $a["cat_title"]);');

			// Order by time - Old Theme Packs (before 3.2.9) : Update Theme Pack to get all options
			usort($stamp->events, $newfunc_1_ASC_2_ASC);

			// Time ASC and if same time : Category Title ASC (default)
			if ($ictip_ordering == '1_ASC-2_ASC')
			{
				usort($events, $newfunc_1_ASC_2_ASC);
			}
			// Time ASC and if same time : Category Title DESC
			if ($ictip_ordering == '1_ASC-2_DESC')
			{
				usort($events, $newfunc_1_ASC_2_DESC);
			}
			// Time DESC and if same time : Category Title ASC
			if ($ictip_ordering == '1_DESC-2_ASC')
			{
				usort($events, $newfunc_1_DESC_2_ASC);
			}
			// Time DESC and if same time : Category Title DESC
			if ($ictip_ordering == '1_DESC-2_DESC')
			{
				usort($events, $newfunc_1_DESC_2_DESC);
			}

			// Category Title ASC and if same category : Time ASC
			if ($ictip_ordering == '2_ASC-1_ASC')
			{
				usort($events, $newfunc_2_ASC_1_ASC);
			}
			// Category Title ASC and if same category : Time DESC
			if ($ictip_ordering == '2_ASC-1_DESC')
			{
				usort($events, $newfunc_2_ASC_1_DESC);
			}
			// Category Title DESC and if same category : Time ASC
			if ($ictip_ordering == '2_DESC-1_ASC')
			{
				usort($events, $newfunc_2_DESC_1_ASC);
			}
			// Category Title DESC and if same category : Time DESC
			if ($ictip_ordering == '2_DESC-1_DESC')
			{
				usort($events, $newfunc_2_DESC_1_DESC);
			}

			// If main ordering and sub-ordering on Time : set TIME ASC (with no sub-ordering)
			if ($ictip_ordering == '1_ASC')
			{
				usort($events, $newfunc_1_ASC);
			}
			// If main ordering and sub-ordering on Category Title : set CATEGORY TITLE ASC (with no sub-ordering)
			if ($ictip_ordering == '2_ASC')
			{
				usort($events, $newfunc_2_ASC);
			}


			// Load tempalte for day infotip
			require $this->t_day;

			switch('week'){
				case $this->ng:
					echo '</td></tr>';
					break;
				default:
					echo '</td>';
					break;
			}
		}

		switch ($stamp->week){
			case $this->ng:
				break;
			default:
				echo '<td colspan="'.(7-$stamp->week).'"></td></tr>';
				break;
		}

		echo '</table></div>';

		echo '</div>';

	}

}

class day
{
	public $date;
	public $week;
	public $day;
	public $month;
	public $year;
	public $events;
	public $fontcolor;

	function __construct ($day)
	{
		foreach ($day as $k=>$v){
			$this->$k=$v;
		}
	}
}
