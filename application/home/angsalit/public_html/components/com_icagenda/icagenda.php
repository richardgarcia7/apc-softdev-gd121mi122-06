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
 * @version     3.2.13 2014-01-26
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

// Test if translation is missing, set to en-GB by default
$language = JFactory::getLanguage();
$language->load('com_icagenda', JPATH_SITE, 'en-GB', true);
$language->load('com_icagenda', JPATH_SITE, null, true);

// Require the base controller
if( version_compare( $jversion->getShortVersion(), '3.O', 'lt' ) ) {

	require_once( JPATH_COMPONENT.DS.'controller.php' );

	// Require specific controller if requested
	if ( $controller = JRequest::getVar( 'controller' ) )
	{
	    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	    if ( file_exists( $path ) ) { require_once $path; }
	    else { $controller = ''; }
	}

} else {

	require_once( JPATH_COMPONENT.'/controller.php' );

	// Require specific controller if requested
	if ( $controller = $iCinput->get( 'controller' ) )
	{
	    $path = JPATH_COMPONENT.'/controllers/'.$controller.'.php';
	    if ( file_exists( $path ) ) { require_once $path; }
	    else { $controller = ''; }
	}

}

// Create the controller
$classname    = 'icagendaController'.ucfirst($controller);
$controller   = new $classname( );

// Perform the Requested task
if(version_compare(JVERSION, '3.0', 'lt')) {
	$controller->execute( JRequest::getVar( 'task' ) );
} else {
	$controller->execute( $iCinput->get( 'task' ) );
}

// Redirect if set by the controller
$controller->redirect();

?>

