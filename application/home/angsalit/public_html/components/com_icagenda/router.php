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
 * @version     3.3.3 2014-03-31
 * @since       1.0
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();


function iCagendaBuildRoute( &$query )
{
		$segments = array();

		// link event
		if(isset($query['layout']) && $query['layout']=='event')
		{
				// Make sure we have the id and the alias
				if (strpos($query['id'], ':') === false)
				{
						$db = JFactory::getDbo();
						$aquery = $db->setQuery($db->getQuery(true)
							->select('alias')
							->from('#__icagenda_events')
							->where('id='.(int)$query['id'])
						);
						$alias = $db->loadResult();

						$query['id'] = $query['id'].':'.$alias;
						//$query['id'] = $alias;
				}

				$segments[] = $query['id'];
				unset($query['id']);

//				$segments[]='event_details';
				unset($query['view']);
				unset($query['layout']);
		}

		// link submit
		if(isset($query['layout']) && $query['layout']=='send')
		{
				$segments[] = $query['id'];
				unset($query['id']);

				$segments[]='sending';
				unset($query['view']);
				unset($query['layout']);
		}

		// link registration
		if(isset($query['layout']) && $query['layout']=='registration')
		{
				// Make sure we have the id and the alias
				if (strpos($query['id'], ':') === false)
				{
						$db = JFactory::getDbo();
						$aquery = $db->setQuery($db->getQuery(true)
							->select('alias')
							->from('#__icagenda_events')
							->where('id='.(int)$query['id'])
						);
						$alias = $db->loadResult();

						$query['id'] = $query['id'].':'.$alias;
						//$query['id'] = $alias;
				}

				$segments[] = $query['id'];
				unset($query['id']);

				$segments[]='registration';
				unset($query['view']);
				unset($query['layout']);
		}

		// link search
		if(isset($query['view'])&&$query['view']=='search')
		{
				$segments[]='search';
		}

		// link submit
		if(isset($query['view'])&&$query['view']=='submit')
		{
				$segments[]='submission';
				unset($query['view']);
				unset($query['layout']);
		}

		return $segments;
}

function iCagendaParseRoute( $segments )
{
		$app = JFactory::getApplication();
		$menu = $app->getMenu();
		$item = $menu->getActive();
		$vars = array();

		// Count route segments
		$count = count($segments);

//		if (in_array('event_details', $segments)){
//		}
		if (in_array('sending', $segments))
		{
				$vars['option']	= 'com_icagenda';
				$vars['view']	= 'submit';
				$vars['layout']	= 'send';
				$vars['id'] 	= $segments[0];
		}
		elseif (in_array('registration', $segments))
		{
				$vars['option']	= 'com_icagenda';
				$vars['view']	= 'list';
				$vars['layout']	= 'registration';
				$vars['id'] 	= $segments[0];
		}
		elseif (in_array('search', $segments))
		{
				$vars['option']	= 'com_icagenda';
				$vars['view']	= 'list';
				$vars['layout']	= 'search';
		}
		elseif (in_array('submission', $segments))
		{
				$vars['option']	= 'com_icagenda';
				$vars['view']	= 'submit';
		}
		else
		{
				$vars['option']	= 'com_icagenda';
				$vars['view']	= 'list';
				$vars['layout']	= 'event';
				$vars['id'] 	= $segments[0];
		}
		return $vars;
}
