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


$EventID = JRequest::getInt('id');

// Preparing the query
$db		= Jfactory::getDbo();
$query	= $db->getQuery(true);
$query->select('e.state AS evtState, e.approval AS evtApproval, e.access AS evtAccess')
    ->from($db->qn('#__icagenda_events').' AS e')
	->where($db->qn('e.id').' = '.$db->q($EventID));
$query->select('v.title AS accessName')
	->join('LEFT', $db->quoteName('#__viewlevels') . ' AS v ON v.id = e.access');
$db->setQuery($query);
$evtState=$db->loadObject()->evtState;
$evtApproval=$db->loadObject()->evtApproval;
$evtAccess=$db->loadObject()->evtAccess;
$accessName=$db->loadObject()->accessName;


/**
 * Access Control
 */
$user = JFactory::getUser();

// User Access Levels
$userLevels = $user->getAuthorisedViewLevels();

// User Groups
if (version_compare(JVERSION, '3.0', 'lt')) {
	$userGroups = $user->getAuthorisedGroups();
} else {
	$userGroups = $user->groups;
}


// Get Application
$app = JFactory::getApplication();

// Add Error or Alert Page
$js_event = "media/com_icagenda/js/jsevt.js";
if (!$evtState)
{
		JError::raiseError('404',JTEXT::_('JERROR_LAYOUT_PAGE_NOT_FOUND'));

		return false;
}
elseif (($evtState == 1)
	AND ($evtApproval == 1)
	AND ($this->data->items == NULL))
{
	// Set Return Page
	$return = JURI::getInstance()->toString();

	// redirect after successful registration
	$app->redirect(htmlspecialchars_decode('index.php?option=com_users&view=login&return=' . urlencode(base64_encode($return))) , JFactory::getApplication()->enqueueMessage(JText::_( 'JGLOBAL_YOU_MUST_LOGIN_FIRST' ), 'info'));
}
elseif (!in_array($evtAccess, $userLevels)
	AND !in_array('8', $userGroups))
{
	// Redirect to login page if no access to registration form
	$uri        = JFactory::getURI();
	$return     = base64_encode($uri);
	$rlink = JRoute::_("index.php?option=com_users&view=login&return=$return", false);
	if ($user->id)
	{
		$msg = $app->enqueueMessage(JText::_( 'JERROR_LOGIN_DENIED' ), 'warning');
		$app->redirect($rlink, $msg);
	}
	else
	{
		$msg = $app->enqueueMessage(JText::_( 'JGLOBAL_YOU_MUST_LOGIN_FIRST' ), 'info');
		$app->redirect($rlink, $msg);
	}
}
else
{
	$isSef = $app->getCfg( 'sef' );

	foreach ($this->data->items as $i)
	{
		$item	= $i;
	}

	// prepare Document
	$document	= JFactory::getDocument();
	$menus		= $app->getMenu();
	$pathway 	= $app->getPathway();
	$title 		= null;

	// Load Variables file
	$icsetvar = 'components/com_icagenda/add/elements/icsetvar.php';

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

	// Set Joomla Site Title (Page Header Title)
	$menu = $menus->getActive();

	if ($menu)
	{
		$this->params->def('page_heading', $this->params->get('page_title', $item->title));
	}
	else
	{
		$this->params->def('page_heading', JText::_('JGLOBAL_ARTICLES'));
	}

	$title = $item->title;

	if (empty($title))
	{
		$title = $app->getCfg('sitename');
	}
	elseif ($app->getCfg('sitename_pagetitles', 0) == 1)
	{
		$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
	}
	elseif ($app->getCfg('sitename_pagetitles', 0) == 2)
	{
		$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
	}

	// Open Graph Tags
	$eventTitle		= trim(htmlspecialchars($item->metaTitle, ENT_QUOTES, 'UTF-8'));
	$eventType		= 'article';
	$eventImage		= $item->image;
	$imgLink		= filter_var($eventImage, FILTER_VALIDATE_URL);
	$eventUrl		= JURI::getInstance()->toString();
//	$eventDesc		= $item->desc;
//	$descShort		= $item->descShort;
	$sitename		= $app->getCfg('sitename');
	$og_desc		= trim(htmlspecialchars($item->metaDesc, ENT_QUOTES, 'UTF-8'));

	// Add to the breadcrumb
	$pathway->addItem($eventTitle);

	if ($eventTitle)
	{
		$document->setTitle($title);
		$document->addCustomTag('<meta property="og:title" content="' . $eventTitle . '" />');
	}
	if ($eventType)
	{
		$document->addCustomTag('<meta property="og:type" content="' . $eventType . '" />');
	}
	if ($eventImage)
	{
		if ($imgLink)
		{
			$document->addCustomTag('<meta property="og:image" content="' . $eventImage . '" />');
		}
		else
		{
			$document->addCustomTag('<meta property="og:image" content="' . JURI::base() . $eventImage . '" />');
		}
	}
	if ($eventUrl)
	{
		$document->addCustomTag('<meta property="og:url" content="' . $eventUrl . '" />');
	}
	if ($og_desc)
	{
		$document->setDescription($og_desc);
		$document->addCustomTag('<meta property="og:description" content="' . $og_desc . '" />');
	}
	if ($sitename)
	{
		$document->addCustomTag('<meta property="og:site_name" content="' . $sitename . '" />');
	}

	$loadGMapScripts = false;

	if ( !empty($item->lng)
		AND $this->GoogleMaps == 1 )
	{
		$loadGMapScripts = true;
	}

	$stamp = $this->data;

	$iCicons = new iCicons();

	$icu_approve = JRequest::getVar('manageraction', '');
	$icu_layout = JRequest::getVar('layout', '');

	if (version_compare(JVERSION, '3.0', 'lt')) {
		$approveIcon = '<span class="iCicon-16 approval"></span>';
	} else {
		$approveIcon = '<button class="btn btn-micro btn-warning btn-xs "><i class="icon-checkmark"></i></button>';
	}

	$approval_msg	= JText::sprintf('COM_ICAGENDA_APPROVE_AN_EVENT_NOTICE', $approveIcon);
	$approval_title	= JText::_( 'COM_ICAGENDA_APPROVE_AN_EVENT_LBL' );
	$approval_type	= 'notice';

	?>

	<div id="icagenda<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

	<?php // Back Arrow ?>
	<div class="ic-top-buttons">

		<?php
		if (JRequest::getVar('tmpl')!='component')
		{
			$uri = JFactory::getURI();
			$date_value = JRequest::getVar('date', '');
			$evt_id = JRequest::getVar('id', 0);
//			$date_var = '?date='.$date_value;
//			$linkprint = str_replace($date_var, '', $uri);
			$event_link = JRoute::_('index.php?option=com_icagenda&view=list&layout=event&id='.$evt_id);

			$session = JFactory::getSession();
			$session->set('date_value', $date_value);

			$print_url = ($isSef == 1) ? $event_link.'?tmpl=component' : $event_link.'&tmpl=component';

			echo '<div class="ic-back ic-clearfix">';
			echo $item->BackArrow;
			echo '</div>';

			echo '<div class="ic-buttons ic-clearfix">';

			if ($this->iconPrint_global == 2) {
				// Print icon
				echo '<div class="ic-icon">';
				echo $iCicons->showIcon('printpreview', $print_url);
				echo '</div>';
			}

			if ($this->iconAddToCal_global == 2) {
				// Add to Cal icon
				echo '<div class="ic-icon">';
				echo $iCicons->showIcon('vcal', $uri, $uri.'?vcal=1', $item->gcalendarUrl, $item->wlivecalendarUrl, $item->yahoocalendarUrl);
				echo '</div>';
			}

			// Manager Icons
			echo '<div class="ic-icon">';
			echo $item->ManagerIcons;
			if ($icu_approve != 'approve' AND ($evtApproval == 1)) {
				$app->enqueueMessage($approval_msg, $approval_title, $approval_type);
			}
			echo '</div>';

			echo '</div>';
		}
		else
		{
			echo '<div class="ic-printpopup-btn"><div>';
			echo $iCicons->showIcon('print');
			echo '</div></div>';
		}

		?>
	</div>
	<?php

	// load Theme and css
	if (file_exists( JPATH_SITE . '/components/com_icagenda/themes/packs/'.$this->template.'/'.$this->template.'_event.php' ))
	{
		$tpl_event		= JPATH_SITE . '/components/com_icagenda/themes/packs/'.$this->template.'/'.$this->template.'_event.php';
		$css_component	= '/components/com_icagenda/themes/packs/'.$this->template.'/css/'.$this->template.'_component.css';
	}
	else
	{
		$tpl_event 		= JPATH_SITE . '/components/com_icagenda/themes/packs/default/default_event.php';
		$css_component	= '/components/com_icagenda/themes/packs/default/css/default_component.css';
	}

	// Add the media specific CSS to the document
	JLoader::register('iCagendaMediaCss', JPATH_ROOT . '/components/com_icagenda/helpers/media_css.class.php');
	iCagendaMediaCss::addMediaCss($this->template, 'component');

	require_once $icsetvar;
	require_once $tpl_event;

	?>
	</div>
	<?php
}

require_once $js_event;

// iCagenda core css files (general style, iCicon font, tipTip)
$document->addStyleSheet( JURI::base( true ) . '/components/com_icagenda/add/css/style.css' );
$document->addStyleSheet( JURI::base( true ) . '/media/com_icagenda/icicons/style.css' );
$document->addStyleSheet( JURI::base( true ) . '/media/com_icagenda/css/tipTip.css' );

// It's possible to override iCagenda core css style in your custom theme pack css file
$document->addStyleSheet( JURI::base( true ) . $css_component );

if(version_compare(JVERSION, '3.0', 'lt'))
{
	$document->addStyleSheet( JURI::base( true ) . '/components/com_icagenda/add/css/icagenda.j25.css' );

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

// Google Maps api V3
if($loadGMapScripts)
{
	$doclang = JFactory::getDocument();
	$curlang = $doclang->language;
	$lang = substr($curlang,0,2);
	$document->addScript('https://maps.googleapis.com/maps/api/js?sensor=false&librairies=places&language='.$lang);
	$document->addScript( JURI::base( true ) . '/components/com_icagenda/js/icmap.js' );
}
$document->addScript( JURI::base( true ) . '/media/com_icagenda/js/jquery.tipTip.js');

$iCAddToCal	 = array();
$iCAddToCal[] = '	jQuery(document).ready(function(){';
$iCAddToCal[] = '		jQuery(".ic-addtocal").tipTip({maxWidth: "200", defaultPosition: "top", edgeOffset: 1, activation:"hover", keepAlive: true});';
$iCAddToCal[] = '	});';

// Add the script to the document head.
JFactory::getDocument()->addScriptDeclaration(implode("\n", $iCAddToCal));

$iCtip	 = array();
$iCtip[] = '	jQuery(document).ready(function(){';
$iCtip[] = '		jQuery(".icTip").tipTip({maxWidth: "200", defaultPosition: "top", edgeOffset: 1});';
$iCtip[] = '	});';

// Add the script to the document head.
JFactory::getDocument()->addScriptDeclaration(implode("\n", $iCtip));
