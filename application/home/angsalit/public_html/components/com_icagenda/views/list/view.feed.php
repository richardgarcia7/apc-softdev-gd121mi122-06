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
 * @version     3.3.8 2014-07-01
 * @since       3.3.8
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();

/**
 * HTML View class - iCagenda - RSS Feeds.
 */
class icagendaViewList extends JViewLegacy
{
	function display($cachable = false, $urlparams = false)
	{
		$app		= JFactory::getApplication();
		$document	= JFactory::getDocument();

		$items		= $this->get('Records');
//		$Itemid		= $app->input->getInt('Itemid');
		$Itemid		= JRequest::getInt('Itemid');

		foreach ($items as $item)
		{
			// Load individual item creator class.
			$feeditem				= new JFeedItem;
			$feeditem->title		= $item->title;
			$feeditem->link			= JROUTE::_('index.php?option=com_icagenda&view=list&layout=event&Itemid='. (int) $Itemid .'&id='. (int) $item->id);
//			$feeditem->image		= iCagendaThumb::sizeMedium($item->image);
//			$feeditem->description	= '<img src="' . $feeditem->image . '" alt="" style="margin: 5px; float: left;">' . $item->desc;
			$feeditem->description	= $item->desc;
			$feeditem->date			= $item->next;
			$feeditem->category		= $item->catid;

			// Loads item information into RSS array
			$document->addItem($feeditem);
		}
	}
}
