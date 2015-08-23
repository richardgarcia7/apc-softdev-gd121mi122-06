<?php
/**
 *	Plugin Search - iCagenda :: Search
 *----------------------------------------------------------------------------
 * @package     com_icagenda
 * @copyright   Copyright (c)2012-2014 Cyril Rezé, Jooml!C - All rights reserved

 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Cyril Rezé (Lyr!C)
 * @link        http://www.joomlic.com
 *
 * @update      3.3.3 2014-04-18
 * @version		1.1
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
 *----------------------------------------------------------------------------
*/


// No direct access to this file
defined('_JEXEC') or die( 'Restricted access' );

// Require the component's router file
require_once JPATH_SITE .  '/components/com_icagenda/router.php';

/**
 * All functions need to get wrapped in class PlgSearchiCagenda
 */
class PlgSearchiCagenda extends JPlugin
{
		/**
		 * Constructor
		 *
		 * @access      protected
		 * @param       object  $subject The object to observe
		 * @param       array   $config  An array that holds the plugin configuration
		 * @since       1.6
		 */
		public function __construct(& $subject, $config)
		{
				parent::__construct($subject, $config);
				$this->loadLanguage();
		}

		// Define a function to return an array of search areas.
		// Note the value of the array key is normally a language string
		function onContentSearchAreas()
		{
				$search_name = $this->params->get('search_name', JText::_('ICAGENDA_PLG_SEARCH_SECTION_EVENTS') );
				if ($search_name == 'ICAGENDA_PLG_SEARCH_SECTION_EVENTS') $search_name = 'Events';
//				static $areas = array(
//					'icagenda' => 'ICAGENDA_PLG_SEARCH_EVENTS'
//				);
				return array('icagenda' => $search_name);
		}

		// The real function has to be created. The database connection should be made.
		// The function will be closed with an } at the end of the file.
		/**
		 * The sql must return the following fields that are used in a common display
		 * routine: href, title, section, created, text, browsernav
		 *
		 * @param string Target search string
		 * @param string mathcing option, exact|any|all
		 * @param string ordering option, newest|oldest|popular|alpha|category
		 * @param mixed An array if the search it to be restricted to areas, null if search all
		 */
		function onContentSearch( $text, $phrase='', $ordering='', $areas=null )
		{
				$db     = JFactory::getDBO();
				$app = JFactory::getApplication();
				$tag = JFactory::getLanguage()->getTag();
				$user   = JFactory::getUser();
				$groups = implode(',', $user->getAuthorisedViewLevels());

				// If the array is not correct, return it:
				if (is_array( $areas ))
				{
						if (!array_intersect( $areas, array_keys( $this->onContentSearchAreas() ) ))
						{
								return array();
						}
				}

				// Now retrieve the plugin parameters
				$search_name = $this->params->get('search_name', JText::_('ICAGENDA_PLG_SEARCH_SECTION_EVENTS') );
				if ($search_name == 'ICAGENDA_PLG_SEARCH_SECTION_EVENTS') $search_name = 'Events';
				$search_limit = $this->params->get('search_limit', '50' );
				$search_target = $this->params->get('search_target', '0' );

				// Use the PHP function trim to delete spaces in front of or at the back of the searching terms
				$text = trim( $text );

				// Return Array when nothing was filled in.
				if ($text == '')
				{
						return array();
				}

				// Database part.
				$wheres = array();
				switch ($phrase)
				{
						// Search exact
						case 'exact':
								$text           = $db->Quote( '%'.$db->escape( $text, true ).'%', false );
								$wheres2        = array();
								$wheres2[]      = 'LOWER(a.title) LIKE '.$text;
								$wheres2[]      = 'LOWER(a.desc) LIKE '.$text;
								$wheres2[]      = 'LOWER(a.place) LIKE '.$text;
								$wheres2[]      = 'LOWER(a.city) LIKE '.$text;
								$wheres2[]      = 'LOWER(a.country) LIKE '.$text;
								$wheres2[]      = 'LOWER(a.address) LIKE '.$text;
								$wheres2[]      = 'LOWER(c.title) LIKE '.$text;
								$where          = '(' . implode( ') OR (', $wheres2 ) . ')';
								break;

						// Search all or any
						case 'all':
						case 'any':

						// Set default
						default:
								$words  = explode( ' ', $text );
								$wheres = array();
								foreach ($words as $word)
								{
										$word           = $db->Quote( '%'.$db->escape( $word, true ).'%', false );
										$wheres2        = array();
										$wheres2[]      = 'LOWER(a.title) LIKE '.$word;
										$wheres2[]      = 'LOWER(a.desc) LIKE '.$word;
										$wheres2[]      = 'LOWER(a.place) LIKE '.$word;
										$wheres2[]      = 'LOWER(a.city) LIKE '.$word;
										$wheres2[]      = 'LOWER(a.country) LIKE '.$word;
										$wheres2[]      = 'LOWER(a.address) LIKE '.$word;
										$wheres2[]      = 'LOWER(c.title) LIKE '.$word;
										$wheres[]       = implode( ' OR ', $wheres2 );
								}
								$where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
								break;
				}

				// Ordering of the results
				switch ( $ordering )
				{
						//Alphabetic, ascending
						case 'alpha':
								$order = 'a.title ASC';
								break;

						// Oldest first
						case 'oldest':
								$order = 'a.next ASC';
								break;

						// Popular first
						case 'popular':

						// Newest first
						case 'newest':
								$order = 'a.next DESC';
								break;

						// Category
						case 'category':
								$order = 'c.title ASC';
								break;

						// Default setting: alphabetic, ascending
						default:
								$order = 'a.title ASC';
				}

				// Section
				$section = $search_name;

				// Request Itemid
				$query = $db->getQuery(true);
						$query->select('m.id AS idm');
						$query->from('#__menu AS m');
						$query->where(' m.link = "index.php?option=com_icagenda&view=list" AND m.published > 0 ');

				// Filter by language.
				if ($app->isSite() && JLanguageMultilang::isEnabled())
				{
						$query->where('m.language in (' . $db->quote($tag) . ',' . $db->quote('*') . ')');
				}

				$db->setQuery($query);
				$idlangtag = $db->loadResult();
				$iCmenu = $idlangtag ? $idlangtag : false;

				// Get User groups allowed to approve event submitted
				$userID = $user->id;
				$userLevels = $user->getAuthorisedViewLevels();
				if(version_compare(JVERSION, '3.0', 'lt'))
				{
						$userGroups = $user->getAuthorisedGroups();
				}
				else
				{
						$userGroups = $user->groups;
				}
				$groupid = JComponentHelper::getParams('com_icagenda')->get('approvalGroups', array("8"));

				jimport( 'joomla.access.access' );
				$adminUsersArray = array();
				foreach ($groupid AS $gp)
				{
						$adminUsers = JAccess::getUsersByGroup($gp, false);
						$adminUsersArray = array_merge($adminUsersArray, $adminUsers);
				}

				// The database query;
				$query  = $db->getQuery(true);
						$query->select('a.title AS title, a.created AS created, a.desc AS text, a.id AS eventID, a.language AS language');
						$query->select($query->concatenate(array($db->Quote($section), 'c.title'), " / ").' AS section');
						$query->select('"'.$search_target.'" AS browsernav');
						$query->from('#__icagenda_events AS a');
						$query->innerJoin('#__icagenda_category as c ON c.id = a.catid');
						$query->where('('. $where .')' . 'AND a.state = 1 AND a.access IN ('. $groups .') ');

						// if user logged-in has no Approval Rights, not approved events won't be displayed.
						if (!in_array($userID, $adminUsersArray)
							AND !in_array('8', $userGroups))
						{
								$query->where(' a.approval <> 1 ');
						}

						// Filter by language.
//						if ($app->isSite())
						if ($app->isSite() && JLanguageMultilang::isEnabled())
						{
							$query->where('a.language in (' . $db->quote($tag) . ',' . $db->quote('*') . ')');
						}
						$query->order($order);

				// Set query
				$db->setQuery( $query, 0, $search_limit );
				$iCevents = $db->loadObjectList();
//				$limit -= count($list);

				// The 'output' of the displayed link.
				if (isset($iCevents))
				{
						foreach($iCevents as $key => $iCevent)
						{
								$iCevents[$key]->href = 'index.php?option=com_icagenda&view=list&layout=event&id='.$iCevent->eventID.'&Itemid='.$iCmenu;
						}
				}

				// If menu item iCagenda list of events exists, returns events found.
				if ($iCmenu)
				{
						//Return the search results in an array
						return $iCevents;
				}
				else
				{
						// Displays a warning that no menu item to the list of events is published.
						$app->enqueueMessage(JText::_( 'ICAGENDA_PLG_SEARCH_ALERT_NO_ICAGENDA_MENUITEM' ), 'warning');
				}
		}
}
