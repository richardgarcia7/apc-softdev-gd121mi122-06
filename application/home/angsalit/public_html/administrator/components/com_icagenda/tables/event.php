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
 * @version     3.3.3 2014-04-12
 * @since       1.0
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();

/**
 * event Table class
 */
class iCagendaTableevent extends JTable
{
	/**
	 * Constructor
	 *
	 * @param JDatabase A database connector object
	 */
	public function __construct(&$_db)
	{
		parent::__construct('#__icagenda_events', 'id', $_db);
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param	array		Named array
	 * @return	null|string	null is operation was satisfactory, otherwise returns an error
	 * @see		JTable:bind
	 * @since	1.3
	 */
	public function bind($array, $ignore = '')
	{

		/**
		 * Serialize Single Dates
		 */
		$dev_option = '0';

        if (iCagendaHelper::isSerialized($array['dates']))
		{
			$dates=unserialize($array['dates']);
		}
		elseif ($dev_option == '1')
		{
			$dates=$this->setDatesOptions($array['dates']);
		}
		else
		{
			$dates=$this->getDates($array['dates']);
		}
		rsort($dates);

		if ($dev_option == '1')
		{
			$array['dates']=$array['dates'];
		}
		else
		{
			$array['dates']=serialize($dates);
		}

		/**
		 * Serialize Period Dates
		 */
		$nodate='0000-00-00 00:00:00';

		// Calcul des dates d'une période.
		$startdate= ($array['startdate']);
		$enddate= ($array['enddate']);

		if ($startdate == NULL)
		{
			$startdate = $nodate;
		}
		if ($enddate == NULL)
		{
			$enddate = $nodate;
		}
		if (($startdate == $nodate) && ($enddate != $nodate))
		{
			$enddate = $nodate;
		}

		$startcontrol=$this->mkt($startdate);
		$endcontrol=$this->mkt($enddate);

		$errorperiod='';
		if ($startcontrol > $endcontrol)
		{
			$errorperiod='1';
		}
		else
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
		}

		// Serialize les dates de la période.
		if (($startdate != $nodate) && ($enddate != $nodate))
		{
			if ($errorperiod != '1')
			{
				$array['period'] = serialize($out);
				if(iCagendaHelper::isSerialized($array['period']))
				{
					$period = unserialize($array['period']);
				}
				else
				{
					$period = $this->getPeriod($array['period']);
				}
				rsort($period);
				$array['period'] = serialize($period);
			}
			else
			{
				$array['period']='';
			}
		}
		else
		{
			$array['period']='';
		}

		/**
		 * Set Week Days
		 */
		if (!isset($array['weekdays']))
		{
			$array['weekdays'] = '';
		}
		if (is_array($array['weekdays']))
		{
			$array['weekdays'] = implode(',', $array['weekdays']);
		}

		/**
		 * Create Next Date
		 */
		$todaytime=time();

		$NextDates=$this->getNextDates($dates);
		if (isset($period))
		{
			$NextPeriod=$this->getNextPeriod($period, $array['weekdays']);
		}
		else
		{
			$NextPeriod=$this->getNextDates($dates);
		}

		$today=time();
		$day= date('d');
		$m= date('m');
		$y= date('y');
		$hour= date('H');
		$min= date('i');
		$today=mktime(0,0,0,$m,$day,$y);

		$nextdmkt = strtotime($NextDates);

		$nextpmkt = strtotime($NextPeriod);


		$nextDmktdate = $this->mktdate($NextDates);
		$nextPmktdate = $this->mktdate($NextPeriod);
		$nextDmkttime = $this->mkttime($NextDates);
		$nextPmkttime = $this->mkttime($NextPeriod);

		// Controle Date à venir
		if (($nextDmktdate >= $today) && ($nextPmktdate >= $today))
		{
			if ($nextDmktdate < $nextPmktdate)
			{
				$array['next']=$this->getNextDates($dates);
			}
			if ($nextDmktdate > $nextPmktdate)
			{
				$array['next']=$this->getNextPeriod($period, $array['weekdays']);
			}
			if ($nextDmktdate == $nextPmktdate)
			{
				if ($nextDmkttime >= $nextPmkttime)
				{
					if (isset($period))
					{
						$array['next']=$this->getNextPeriod($period, $array['weekdays']);
					}
					else
					{
						$array['next']=$this->getNextDates($dates);
					}
				}
				else
				{
					$array['next']=$this->getNextDates($dates);
				}
			}
		}
		if (($nextDmktdate < $today) && ($nextPmktdate >= $today))
		{
			$array['next']=$this->getNextPeriod($period, $array['weekdays']);
		}
		if (($nextDmktdate >= $today) && ($nextPmktdate < $today))
		{
			$array['next']=$this->getNextDates($dates);
		}
		if (($nextDmktdate < $today) && ($nextPmktdate < $today))
		{
			if ($nextDmktdate < $nextPmktdate)
			{
				$array['next']=$this->getNextPeriod($period, $array['weekdays']);
			}
			if ($nextDmktdate >= $nextPmktdate)
			{
				$array['next']=$this->getNextDates($dates);
			}
		}

		// Control of dates if valid (EDIT SINCE VERSION 3.0 - update 3.1.4)
		if ((($nextdmkt>='943916400') AND ($nextdmkt<='944002800')) && ($errorperiod=='1'))
		{
			$array['next']= '-3600';
		}
		if ((($nextdmkt=='943916400') OR ($nextdmkt=='943920000')) && (($nextpmkt=='943916400') OR ($nextpmkt=='943920000')))
		{
			$array['next']= '-3600';
		}

		if ($array['next']=='-3600')
		{
			$state = 0;
			$this->_db->setQuery(
			'UPDATE `#__icagenda_events`' .
			' SET `state` = '.(int) $state .
			' WHERE `id` = '. (int) $array['id']
			);
			if(version_compare(JVERSION, '3.0', 'lt'))
			{
				$this->_db->query();
			}
			else
			{
				$this->_db->execute();
			}
		}


		/**
		 * Set Creator infos
		 */
		$user = JFactory::getUser();
		$userId	= $user->get('id');
		if ($array['created_by']=='0')
		{
			$array['created_by']=$userId;
		}

		if (isset($array['params']) && is_array($array['params']))
		{
			// Convert the params field to a string.
			$parameter = new JRegistry;
			$parameter->loadArray($array['params']);
			$array['params'] = (string)$parameter;
		}


		$username=$user->get('name');
		$array['username']=$username;

		/**
		 * Set File upload
		 */
		if (!isset($array['file']))
		{
			$file = JRequest::getVar('jform', null, 'files', 'array');
			$fileUrl = $this->upload($file);
			$array['file'] = $fileUrl;
		}

		/**
		 * Set Meta data
		 */
		if (isset($array['metadata']) && is_array($array['metadata']))
		{
			$registry = new JRegistry();
			$registry->loadArray($array['metadata']);
			$array['metadata'] = (string)$registry;
		}

		$mail_new_event = '0';
		$mail_new_event = JComponentHelper::getParams('com_icagenda')->get('mail_new_event', '0');
		$return[] = parent::bind($array, $ignore);

		if ($mail_new_event == 1)
		{
			$title = $array['title'];
			$id_event = $array['id'];
			$db = JFactory::getDbo();
			$query	= $db->getQuery(true);
			$query->select('id AS eventID')
					->from('#__icagenda_events')
//					->where(" id = '$id_event'")
					->order('id DESC');
			$db->setQuery($query);
			$eventID = $db->loadResult();

			$new_event = JRequest::getVar('new_event');

			$title = $array['title'];
			$description = $array['desc'];
			$venue = '';
			if ($array['place']) $venue.= $array['place'].' - ';
			if ($array['city']) $venue.= $array['city'];
			if ($array['city'] && $array['country']) $venue.= ', ';
			if ($array['country']) $venue.= $array['country'];

			if (strtotime($array['startdate']))
			{
				$date = 'Du '.$array['startdate'].' au '.$array['startdate'];
			}
			else
			{
				$date = $array['next'];
			}

			$baseURL = JURI::base();
			$baseURL = str_replace('/administrator', '', $baseURL);
			$baseURL = ltrim($baseURL, '/');

			if ($array['image']) $image = '<img src="'.$baseURL.'/'.$array['image'].'" />';


			if ($new_event == '1' && $eventID && $array['state'] == '1' && $array['approval'] == '0')
			{
					$return[] = self::notificationNewEvent(($eventID+1), $title, $description, $venue, $date, $image, $new_event);
			}
//			elseif ($new_event == '0')
//			{
//					$return[] = self::notificationNewEvent($array['id'], 'Edited Event', $new_event);
//			}
		}

		return $return;

	}


	function setDatesOptions ($dates)
	{
		$dates=str_replace('day=', '', $dates);
		$dates=str_replace('start=', '', $dates);
		$dates=str_replace('end=', '', $dates);
//		$dates=str_replace('+', ' ', $dates);
		$dates=str_replace('%3A', ':', $dates);
		$dates=str_replace('&', ',', $dates);
		$ex_dates=explode(',stop=stop', $dates);
		$singles_dates = array();
		foreach ($ex_dates AS $sd)
		{
			if ($sd != '')
			{
				array_push($singles_dates, $sd);
			}
		}

		return $singles_dates;
	}

	function getDates ($dates)
	{
		$dates=str_replace('d=', '', $dates);
		$dates=str_replace('+', ' ', $dates);
		$dates=str_replace('%3A', ':', $dates);
		$ex_dates=explode('&', $dates);
		return $ex_dates;
	}

	function getPeriod ($period)
	{
		$period=str_replace('d=', '', $period);
		$period=str_replace('+', ' ', $period);
		$period=str_replace('%3A', ':', $period);
		$ex_period=explode('&', $period);
		return $ex_period;
	}


	function getNextDates ($dates)
	{
		$nodate='0000-00-00 00:00:00';
		$today=time();
		$day= date('d');
		$m= date('m');
		$y= date('y');
		$today=mktime(0,0,0,$m,$day,$y);
		$next=JRequest::getVar('next');

		if(count($dates))
		{
			while ($next <= $today)
			{
				$dd = $this->mkt($dates[0]);
				$nextDate=$dd;
				foreach($dates as $d)
				{
					$d=$this->mkt($d);
					if ($d>=$today)
					{
						$nextDate=$d;
					}
				}

				return date('Y-m-d H:i', $nextDate);
			}
		}
	}


	function getNextPeriod ($period, $tWeekdays)
	{
		// Get today (GMT)
		$today=time();
		$day= date('d');
		$m= date('m');
		$y= date('y');
		$today=mktime(0,0,0,$m,$day,$y);

		// Function WeekDays Array
		if (isset($tWeekdays))
		{
			$weekdays = $tWeekdays;
		}
		else
		{
			$weekdays = '';
		}

		$weekdays = explode (',', $weekdays);
		$weekdaysarray = array();
		$allWeekDays = array(0,1,2,3,4,5,6);

		foreach ($weekdays as $wed)
		{
			array_push($weekdaysarray, $wed);
		}

		if (in_array('', $weekdaysarray))
		{
			$arrayWeekDays = $allWeekDays;
		}
		elseif ($tWeekdays != '')
		{
			$arrayWeekDays = $weekdaysarray;
		}
		else
		{
			$arrayWeekDays = $allWeekDays;
		}
		$WeeksDays = $arrayWeekDays;

		// Set Next Date for Period, if dates exist in Period
		if(count($period))
		{
			$firstDay = $this->mkt($period[0]);
			$nextPeriod = $firstDay;

			foreach ($period as $e)
			{
				if (in_array(date('w', strtotime($e)), $WeeksDays))
				{
					$e=strtotime($e);
					if ($e >= $today)
					{
						$nextPeriod = $e;
					}
				}
			}

			return date('Y-m-d H:i', $nextPeriod);

		}
	}


	function mkt($data)
	{
		$data=str_replace(' ', '-', $data);
		$data=str_replace(':', '-', $data);
		$ex_data=explode('-', $data);
		if (isset($ex_data['3']))$hour=$ex_data['3'];
		if (isset($ex_data['4']))$min=$ex_data['4'];
		if ((isset($hour)) && (isset($min)) && ($hour!='') && ($hour!=NULL) && ($min!='') && ($min!=NULL))
		{
			$result=mktime($ex_data['3'], $ex_data['4'], '00', $ex_data['1'], $ex_data['2'], $ex_data['0']);
		}
		else
		{
			$result=mktime('00', '00', '00', $ex_data['1'], $ex_data['2'], $ex_data['0']);
		}
		return $result;
	}

	function mktdate($data)
	{
		$data=str_replace(' ', '-', $data);
		$data=str_replace(':', '-', $data);
		$ex_data=explode('-', $data);
		$result=mktime('00', '00', '00', $ex_data['1'], $ex_data['2'], $ex_data['0']);
		return $result;
	}

	function mkttime($data)
	{
		$data=str_replace(' ', '-', $data);
		$data=str_replace(':', '-', $data);
		$ex_data=explode('-', $data);
		$result=mktime($ex_data['3'], $ex_data['4'], '00', '00', '00', '00');
		return $result;
	}

	/**
	 * upload
	 */

	function upload ($file)
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');

		$filename = JFile::makeSafe($file['name']['file']);

		if($filename!='')
		{
			$src = $file['tmp_name']['file'];
			$dest =  JPATH_SITE.'/images/icagenda/files/'.$filename;

			if(!is_dir($dest))
			{
				mkdir($intDir, 0755);
			}

			if ( JFile::upload($src, $dest, false) )
			{
				echo 'upload';
				return 'images/icagenda/files/'.$filename;
			}

			return 'images/icagenda/files/'.$filename;
		}
	}

	/**
	* Overloaded check function
	*/
	public function check()
	{
		//If there is an ordering column and this is a new row then get the next ordering value
		if (property_exists($this, 'ordering') && $this->id == 0)
		{
			$this->ordering = self::getNextOrder();
		}

		// URL
		jimport( 'joomla.filter.output' );
		if(empty($this->alias))
		{
			$this->alias = $this->title;
		}
		$this->alias = JFilterOutput::stringURLSafe($this->alias);

		return parent::check();
	}


	/**
	* Method to set the publishing state for a row or list of rows in the database
	* table.  The method respects checked out rows by other users and will attempt
	* to checkin rows that it can after adjustments are made.
	*
	* @param	mixed	An optional array of primary key values to update.  If not
	*					set the instance property value is used.
	* @param    integer The publishing state. eg. [0 = unpublished, 1 = published]
	* @param    integer The user id of the user performing the operation.
	* @return    boolean    True on success.
	* @since    1.0.4
	*/
	public function publish($pks = null, $state = 1, $userId = 0)
	{
		// Initialise variables.
		$k = $this->_tbl_key;

		// Sanitize input.
		JArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;

		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks))
		{
			if ($this->$k)
			{
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else
			{
				$this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
		}

		// Build the WHERE clause for the primary keys.
		$where = $k.'='.implode(' OR '.$k.'=', $pks);

		// Determine if there is checkin support for the table.
		if (!property_exists($this, 'checked_out') || !property_exists($this, 'checked_out_time'))
		{
			$checkin = '';
		}
		else
		{
			$checkin = ' AND (checked_out = 0 OR checked_out = '.(int) $userId.')';
		}

		// Update the publishing state for rows with the given primary keys.
		$this->_db->setQuery(
			'UPDATE `'.$this->_tbl.'`' .
			' SET `state` = '.(int) $state .
			' WHERE ('.$where.')' .
			$checkin
		);
// J2.5 :
		$this->_db->query();

// J3
//		$this->_db->setQuery($query);
//		$this->_db->execute();

		// Check for a database error.
		if ($this->_db->getErrorNum())
		{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// If checkin is supported and all rows were adjusted, check them in.
		if ($checkin && (count($pks) == $this->_db->getAffectedRows()))
		{
			// Checkin the rows.
			foreach($pks as $pk)
			{
				$this->checkin($pk);
			}
		}

		// If the JTable instance value is in the list of primary keys that were set, set the instance.
		if (in_array($this->$k, $pks))
		{
			$this->state = $state;
		}

		$this->setError('');
		return true;
	}


		/**
		* Overloaded load function
		*
		* @param       int $pk primary key
		* @param       boolean $reset reset data
		* @return      boolean
		* @see JTable:load
		*/
		public function load($pk = null, $reset = true)
		{
			if (parent::load($pk, $reset))
			{
			// Convert the params field to a registry.
				$params = new JRegistry;
				// loadJSON is @deprecated    12.1  Use loadString passing JSON as the format instead.
				// $params->loadString($this->item->params, 'JSON');
				// "item" should not be present.
				if(version_compare(JVERSION, '3.0', 'lt'))
				{
					$params->loadJSON($this->params);
				}
				else
				{
					$params->loadString($this->params);
				}
				$this->params = $params;
				return true;
			}
			else
			{
				return false;
			}
		}


	function notificationNewEvent ($eventid, $title, $description, $venue, $date, $image, $new_event)
	{
		// Load iCagenda Global Options
		$iCparams = JComponentHelper::getParams('com_icagenda');

		// Load Joomla Config
		$config = JFactory::getConfig();

		if (version_compare(JVERSION, '3.0', 'ge'))
		{
				// Get the site name
				$sitename = $config->get('sitename');

				// Get Global Joomla Contact Infos
				$mailfrom = $config->get('mailfrom');
				$fromname = $config->get('fromname');

				// Get default language
				$langdefault = $config->get('language');
		}
		else
		{
				// Get the site name
				$sitename = $config->getValue('config.sitename');

				// Get Global Joomla Contact Infos
				$mailfrom = $config->getValue('config.mailfrom');
				$fromname = $config->getValue('config.fromname');

				// Get default language
				$langdefault = $config->getValue('config.language');
		}

		$siteURL = JURI::base();
		$siteURL = rtrim($siteURL,'/');

		$iCmenuitem = false;

		// Itemid Request (automatic detection of the first iCagenda menu-link, by menuID, and depending of current language)

		$langFrontend = $langdefault;
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('id AS idm')
				->from('#__menu')
				->where( "(link = 'index.php?option=com_icagenda&view=list') AND (published > 0) AND (language = '$langFrontend')" );
		$db->setQuery($query);
		$idm = $db->loadResult();
		$mItemid = $idm;

		if ($mItemid == NULL)
		{
				$db = JFactory::getDbo();
				$query	= $db->getQuery(true);
				$query->select('id AS noidm')
						->from('#__menu')
						->where( "(link = 'index.php?option=com_icagenda&view=list') AND (published > 0) AND (language = '*')" );
				$db->setQuery($query);
				$noidm = $db->loadResult();
		}

		$nolink = '';

		if ($noidm == NULL && $mItemid == NULL)
		{
				$nolink = 1;
		}

		if (is_numeric($iCmenuitem))
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

		// Set Notification Email to each User groups allowed to receive a notification email when a new event created
		$groupid = $iCparams->get('newevent_Groups', array("8"));

		// Load Global Option for Autologin
//		$autologin = $iCparams->get('auto_login', 1);

		jimport( 'joomla.access.access' );
		$newevent_Groups_Array = array();
		foreach ($groupid AS $gp) {
			$GroupUsers = JAccess::getUsersByGroup($gp, False);
			$newevent_Groups_Array = array_merge($newevent_Groups_Array, $GroupUsers);
		}

//		if ($u_id == NULL) {
//				$u_id = 0;
//		}

		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);

//		if (!in_array($u_id, $newevent_Groups_Array)) {

//			$matches = implode(',', $adminUsersArray);
//			$query->select('ui.username AS username, ui.email AS email, ui.password AS passw, ui.block AS block, ui.activation AS activation')
//					->from('#__users AS ui')
//					->where( "ui.id IN ($matches) ");

//		} else {

//			$matches = $u_id;
			$matches = implode(',', $newevent_Groups_Array);
			$query->select('ui.username AS username, ui.email AS email, ui.password AS passw, ui.block AS block, ui.activation AS activation')
					->from('#__users AS ui')
					->where( "ui.id IN ($matches) ");
//					->where( "ui.id = $matches ");

//		}

		$db->setQuery($query);
		$users = $db->loadObjectList();

		// Get all users email and group except for senders
//		$db = JFactory::getDbo();
//		$query	= $db->getQuery(true)
//			->select('email')
//			->from('#__users');
//			->where('id != '.(int) $user->get('id'));
//		if ($grp !== 0)
//		{
//			if (empty($to))
//			{
//				$query->where('0');
//			} else {
//				$query->where('id IN (' . implode(',', $to) . ')');
//			}
//		}

//		if ($disabled == 0){
//			$query->where("block = 0");
//		}

//		$db->setQuery($query);
//		$rows = $db->loadColumn();

		foreach ($users AS $user)
		{
			// Create Notification Mailer
			$new_mailer = JFactory::getMailer();

			// Set Sender of Notification Email
			$new_mailer->setSender(array( $mailfrom, $fromname ));

        	$username = $user->username;
        	$passw = $user->passw;
        	$email = $user->email;

			// Set Recipient of Notification Email
			$new_recipient = $email;
			$new_mailer->addRecipient($email);

			// Set Subject of New Event Notification Email
//			$new_subject = JText::sprintf('COM_ICAGENDA_MAIL_NEW_EVENT_SUBJECT', $sitename);
			$new_subject = 'Nouvel évènement, '.$sitename;
			$new_mailer->setSubject($new_subject);



			// Set Url to preview new event
			$baseURL = JURI::base();
//			$subpathURL = JURI::base(true);

			$baseURL = str_replace('/administrator', '', $baseURL);
//			$subpathURL = str_replace('/administrator', '', $subpathURL);

			$urlpreview = str_replace('&amp;','&', JRoute::_($baseURL.'index.php?option=com_icagenda&view=list&layout=event&id='.(int)$eventid.'&Itemid='.(int)$lien));

			// Sub Path filtering
//			$subpathURL = ltrim($subpathURL, '/');

			// URL Event Preview filtering
//			$urlpreview = ltrim($urlpreview, '/');
//			if(substr($urlpreview,0,strlen($subpathURL)+1) == "$subpathURL/") $urlpreview = substr($urlpreview,strlen($subpathURL)+1);
//			$urlpreview = rtrim($baseURL,'/').'/'.ltrim($urlpreview,'/');


			/**
			 * Set Body of User Notification Email
			 */

			// Hello
//			$new_body_hello = JText::sprintf( 'COM_ICAGENDA_MAIL_NEW_EVENT_BODY_HELLO', $username);
			$new_body_hello = 'Bonjour,';
			$new_bodycontent = $new_body_hello.'<br /><br />';

			// Text
//			$new_body_text = JText::sprintf( 'COM_ICAGENDA_MAIL_NEW_EVENT_BODY_TEXT', $sitename);
			$new_body_text = $sitename.' vous propose un nouvel évènement :';
			$new_bodycontent.= $new_body_text.'<br /><br />';

			// Event Details
			$new_bodycontent.= $title ? 'Titre: '.$title.'<br />' : '';
			$new_bodycontent.= $description ? 'Description: '.$description.'<br />' : '';
			$new_bodycontent.= $venue ? 'Lieu: '.$venue.'<br />' : '';
			$new_bodycontent.= $date ? 'Date: '.$date.'<br /><br />' : '';
			$new_bodycontent.= $image.'<br /><br />';

			// Link to event details view
			$new_bodycontent.= '<a href="'.$urlpreview.'">'.$urlpreview.'</a><br /><br />';

			// Footer
			$new_body_footer = 'Do not answer to this e-mail notification as it is a generated e-mail. You are receiving this email message because you are registered at '.$sitename.'.';
			$new_bodycontent.= '<hr><small>'.$new_body_footer.'<small>';

			// Removes spaces (leading, ending) from Body
			$new_body = rtrim($new_bodycontent);

			// Authorizes HTML
			$new_mailer->isHTML(true);
			$new_mailer->Encoding = 'base64';

			// Set Body
			$new_mailer->setBody($new_body);

			// Send User Notification Email
			if (isset($email)) {
				if($user->block == '0' && empty($user->activation)){
					$send = $new_mailer->Send();
				}
			}
		}
	}

}
