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
 * @version     3.3.6 2014-05-15
 * @since       1.0
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();

jimport('joomla.application.component.helper');

// iCagenda Class control (Joomla 2.5/3.x)
if(!class_exists('iCJView')) {
   if(version_compare(JVERSION,'3.0.0','ge')) {
      class iCJView extends JViewLegacy {};
   } else {
      jimport('joomla.application.component.view');
      class iCJView extends JView {};
   }
}

/**
 * HTML View class - iCagenda.
 */
class icagendaViewList extends iCJView
{
	protected $return_page;

	// Methode JView
	function display($tpl = null)
	{
//		$this->data = $this->get('Data');

		// loading params Menu
		$app = JFactory::getApplication();
		$iCmenuParams = $app->getParams();
		$document = JFactory::getDocument();

		// Menu Options
		$this->atlist = $iCmenuParams->get('atlist');
		$this->template = $iCmenuParams->get('template');
		$this->title = $iCmenuParams->get('title');
		$this->display_catDesc = $iCmenuParams->get('displayCatDesc_menu', '');
		$this->catDesc_opts = $iCmenuParams->get('displayCatDesc_checkbox', '');
		$this->number = $iCmenuParams->get('number', '5');
		$this->datesDisplay = $iCmenuParams->get('datesDisplay', '');
		$this->orderby = $iCmenuParams->get('orderby', '2');

		// loading Global Options
		$iC_global = JComponentHelper::getParams('com_icagenda');

		// Component Options
		$this->iconPrint_global = $iC_global->get('iconPrint_global', 0);
		$this->iconAddToCal_global = $iC_global->get('iconAddToCal_global', 0);
		$this->iconAddToCal_options = $iC_global->get('iconAddToCal_options', 0);
		$this->copy = $iC_global->get('copy');
		$this->navposition = $iC_global->get('navposition');
		$this->arrowtext = $iC_global->get('arrowtext', 1);
		$this->GoogleMaps = $iC_global->get('GoogleMaps', 1);
		$this->CatDesc_global = $iC_global->get('CatDesc_global', '0');
		$this->CatDesc_global_opts = $iC_global->get('CatDesc_checkbox', '');
		$this->datesDisplay_global = $iC_global->get('datesDisplay_global', 2);
		$this->pagination = $iC_global->get('pagination', 1);
		$this->day_display_global = $iC_global->get('day_display_global', 1);
		$this->month_display_global = $iC_global->get('month_display_global', 1);
		$this->year_display_global = $iC_global->get('year_display_global', 1);
		$this->venue_display_global = $iC_global->get('venue_display_global', 1);
		$this->city_display_global = $iC_global->get('city_display_global', 1);
		$this->country_display_global = $iC_global->get('country_display_global', 1);
		$this->shortdesc_display_global = $iC_global->get('shortdesc_display_global', 1);
		$this->statutReg = $iC_global->get('statutReg', 0);

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$vcal = $app->input->get('vcal');
		if ($vcal)
		{
			$tpl = 'vcal';
		//	$document->setMetaData('robots', 'noindex, nofollow');
			$this->params = $iC_global;
//			parent::display($tpl);
		}

		// ASSIGN
		$this->assignRef('params',		$iCmenuParams);

		$this->_prepareDocument();

		parent::display($tpl);
	}

	protected function _prepareDocument() {

		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$pathway 	= $app->getPathway();
		$title 		= null;

		// loading data
		$this->data = $this->get('Data');

		$menu = $menus->getActive();
		if ($menu) {
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		} else {
			$this->params->def('page_heading', JText::_('JGLOBAL_ARTICLES'));
		}

		$title = $this->params->get('page_title', '');

		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}

		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description', '')) {
			$this->document->setDescription($this->params->get('menu-meta_description', ''));
		}

		if ($this->params->get('menu-meta_keywords', '')) {
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords', ''));
		}

		if ($app->getCfg('MetaTitle') == '1' && $this->params->get('menupage_title', '')) {
			$this->document->setMetaData('title', $this->params->get('page_title', ''));
		}

	}
}
