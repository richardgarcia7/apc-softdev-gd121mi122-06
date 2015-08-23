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

jimport( 'joomla.filesystem.path' );
jimport('joomla.form.formfield');


JText::script('COM_ICAGENDA_DELETE_DATE');

JText::script('JANUARY');
JText::script('FEBRUARY');
JText::script('MARCH');
JText::script('APRIL');
JText::script('MAY');
JText::script('JUNE');
JText::script('JULY');
JText::script('AUGUST');
JText::script('SEPTEMBER');
JText::script('OCTOBER');
JText::script('NOVEMBER');
JText::script('DECEMBER');

JText::script('SA');
JText::script('SU');
JText::script('MO');
JText::script('TU');
JText::script('WE');
JText::script('TH');
JText::script('FR');

JText::script('COM_ICAGENDA_TP_CURRENT');

JText::script('COM_ICAGENDA_TP_CLOSE');
JText::script('COM_ICAGENDA_TP_TITLE');
JText::script('COM_ICAGENDA_TP_TIME');
JText::script('COM_ICAGENDA_TP_HOUR');
JText::script('COM_ICAGENDA_TP_MINUTE');


class JFormFieldModal_date extends JFormField
{
	protected $type='modal_date';

	protected function getInput()
	{
		$id = JRequest::getInt('id');
		$class = JRequest::getVar('class');
		$datesDB = '';

		if($id)
		{
			$db	= JFactory::getDBO();
			$db->setQuery(
				'SELECT a.dates' .
				' FROM #__icagenda_events AS a' .
				' WHERE a.id = '.(int) $_GET['id']
			);
			$datesDB = $db->loadResult();
		}

		$dates = self::isSerialized($datesDB) ? unserialize($datesDB) : false;

		$html= '
			<table id="dTable" style="border:0px">
				<thead><tr><th width="70%">'.JText::_('COM_ICAGENDA_TB_DATE').'</th><th width="30%">'.JText::_('COM_ICAGENDA_TB_ACT').'</th></tr></thead>
			';

		if ($dates)
		{
			foreach ($dates as $dat)
			{
				$html.='<tr><td><input class="data" type="text" name="d" value="'.$dat.'" /></td><td><a class="del" href="#">'.JText::_('COM_ICAGENDA_DELETE_DATE').'</a></td></tr>';
			}
		}
		else
		{
			$html.='<tr><td><input class="data" type="text" name="d" value="0000-00-00 00:00"/></td><td><a class="del" href="#">'.JText::_('COM_ICAGENDA_DELETE_DATE').'</a></td></tr>';
		}

		$html.='</table>
			<a id="add" href="#">'.JText::_('COM_ICAGENDA_ADD_DATE').'</a><br/>
			<input class="date" type="hidden" id="'.$this->id.'_id"'.$class.' name="'.$this->name.'" value=\''.$datesDB.'\' />
		';

		return $html;
	}

	/**
	 * Tests whether a string is serialized before attempting to unserialize it
	 */
	public static function isSerialized($str) {
		return ($str == serialize(false) || @unserialize($str) !== false);
	}
}

