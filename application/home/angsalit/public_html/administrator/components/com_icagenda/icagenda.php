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
 * @version     3.3.4 2014-04-23
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

// No direct access to this file
defined('_JEXEC') or die();

// Joomla Version
$jversion = new JVersion();

// J3 DS Define :
if(!defined('DS')){
define('DS',DIRECTORY_SEPARATOR);
}

// Set Input J3
$iCinput =JFactory::getApplication()->input;

// Load Live Update & Joomla import
if( version_compare( $jversion->getShortVersion(), '3.O', 'lt' ) ) {
	require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'liveupdate'.DS.'liveupdate.php'; if(JRequest::getCmd('view','') == 'liveupdate') {
		LiveUpdate::handleRequest(); return;
	}
	jimport('joomla.application.component.controller');
} else {
	require_once JPATH_ADMINISTRATOR.'/components/com_icagenda/liveupdate/liveupdate.php'; if($iCinput->get('view') == 'liveupdate') {
		LiveUpdate::handleRequest(); return;
	}
}

// Set some global property
$document = JFactory::getDocument();
$document->addStyleDeclaration('.icon-48-icagenda {background-image: none);}');

// Load translations
$language = JFactory::getLanguage();
$language->load('com_icagenda', JPATH_ADMINISTRATOR, 'en-GB', true);
$language->load('com_icagenda', JPATH_ADMINISTRATOR, null, true);

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_icagenda')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Require helper file
JLoader::register('iCagendaHelper', dirname(__FILE__).'/helpers/icagenda.php');

// Get an instance of the controller prefixed by iCagenda
if( version_compare( $jversion->getShortVersion(), '2.5.6', 'lt' ) ) {
	$controller = JController::getInstance('iCagenda');
} else {
	$controller = JControllerLegacy::getInstance('iCagenda');
}

// Perform the Request task
if( version_compare( $jversion->getShortVersion(), '3.0', 'lt' ) ) {
	$controller->execute(JRequest::getCmd('task'));
} else {
	$controller->execute($iCinput->get('task'));
}

// Redirect if set by the controller
$controller->redirect();

