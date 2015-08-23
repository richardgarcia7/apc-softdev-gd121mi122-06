<?php
/**
 *------------------------------------------------------------------------------
 *  iCagenda v3 by Jooml!C - Events Management Extension for Joomla! 2.5 / 3.x
 *------------------------------------------------------------------------------
 * @package     com_icagenda
 * @copyright   Copyright (c)2012-2014 Cyril Rez, Jooml!C - All rights reserved
 *
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Cyril Rez (Lyr!C)
 * @link        http://www.joomlic.com
 *
 * @version     3.3.3 2014-04-02
 * @since       3.3.3
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();

jimport('joomla.application.component.controllerform');

/**
 * Registration controller class.
 */
class iCagendaControllerRegistration extends JControllerForm
{

    function __construct() {
        $this->view_list = 'registrations';
        parent::__construct();
    }

}
