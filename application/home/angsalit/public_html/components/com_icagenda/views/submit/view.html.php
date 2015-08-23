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
 * @version     3.3.7 2014-05-28
 * @since       3.2.0
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();

// iCagenda Class control (Joomla 2.5/3.x)
if(!class_exists('iCJView'))
{
   if(version_compare(JVERSION,'3.0.0','ge'))
   {
      class iCJView extends JViewLegacy {};
   }
   else
   {
      jimport('joomla.application.component.view');
      class iCJView extends JView {};
   }
}

/**
 * View class Site - Add an Event - iCagenda
 */
class iCagendaViewSubmit extends iCJView
{
	protected $state;

	protected $item;

	protected $form;

	protected $params;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{

		// Initialiase variables.
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

		if (JRequest::get( 'POST' )) $this->get('db');
//		$this->form = $this->get('form');

		// loading params
		$app = JFactory::getApplication();
		$iCparams = $app->getParams();

		$this->template = $iCparams->get('template');
		$this->title = $iCparams->get('title');
		$this->format = $iCparams->get('format');
		$this->copy = $iCparams->get('copy');
		$this->submit = "media/com_icagenda/js/jsevt.js";
		$this->submit_imageDisplay		= $iCparams->get('submit_imageDisplay', 1);
		$this->submit_descDisplay		= $iCparams->get('submit_descDisplay', 1);
		$this->submit_metadescDisplay	= $iCparams->get('submit_metadescDisplay', 0);
		$this->submit_venueDisplay		= $iCparams->get('submit_venueDisplay', 1);
		$this->submit_emailDisplay		= $iCparams->get('submit_emailDisplay', 1);
		$this->submit_phoneDisplay		= $iCparams->get('submit_phoneDisplay', 1);
		$this->submit_websiteDisplay	= $iCparams->get('submit_websiteDisplay', 1);
		$this->submit_fileDisplay		= $iCparams->get('submit_fileDisplay', 1);
		$this->submit_gmapDisplay		= $iCparams->get('submit_gmapDisplay', 1);
		$this->submit_regoptionsDisplay	= $iCparams->get('submit_regoptionsDisplay', 1);
		$this->statutReg				= $iCparams->get('statutReg', 0);

		$this->params = $this->state->get('params');
		$this->iCparams = $this->params;

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// ASSIGN (deprecated)
//		$this->assignRef('params', $iCparams);

		$this->_prepareDocument();

		parent::display($tpl);
	}
	protected function _prepareDocument() {

		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$pathway 	= $app->getPathway();
		$title 		= null;


		$menu = $menus->getActive();
		if ($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else
		{
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
