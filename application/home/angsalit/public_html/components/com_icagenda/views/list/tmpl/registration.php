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
 * @version     3.3.8 2014-06-27
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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');

foreach ($this->data->items as $i)
{
	$item	= $i;
}

$this_state = $item->state;
$this_approval = $item->approval;
$today = time();
$this_today = strtotime(date('Y-m-d', $today));
$this_next = strtotime(date('Y-m-d', strtotime($item->next)));

// Access Control
$this_access_reg = $item->access_registration;
$user = JFactory::getUser();
$userLevels = $user->getAuthorisedViewLevels();

$app = JFactory::getApplication();

if (($item == NULL)
	|| ($this_next < $this_today)
	|| ($this_state != 1)
	|| ($this_approval == 1)
	|| ((empty($this->statutReg) && ($item->statutReg == 0)) || ($item->statutReg == 0)) )
{
		JError::raiseError('404',JTEXT::_('JERROR_LAYOUT_PAGE_NOT_FOUND'));

		return false;
}
elseif (!in_array($this_access_reg, $userLevels))
{
	// Redirect to login page if no access to registration form
//	$uri	= JFactory::getURI();
	$return	= base64_encode($item->iCagendaRegForm);
	$rlink	= JRoute::_('index.php?option=com_users&view=login&return='.$return, false);

	$msg = '<div>';
	$msg.= '<h2>';
	$msg.= JText::_('IC_AUTH_REQUIRED');
	$msg.= '</h2>';
	$msg.= '<div>';
	$msg.= JText::_("COM_ICAGENDA_LOGIN_TO_ACCESS_REGISTRATION_FORM");
	$msg.= '</div>';
	$msg.= '<br />';
	$msg.= '<div>';
	$msg.= '<a href="' . JRoute::_($item->Event_Link) . '" class="btn btn-default btn-small button">';
	$msg.= '<i class="iCicon-backic icon-white"></i>&nbsp;' . JTEXT::_('COM_ICAGENDA_BACK') . '';
	$msg.= '</a>';
	$msg.= '&nbsp;';
	$msg.= '<a href="index.php" class="btn btn-info btn-small button">';
	$msg.= '<i class="icon-home icon-white"></i>&nbsp;' . JTEXT::_('JERROR_LAYOUT_HOME_PAGE') . '';
	$msg.= '</a>';
	$msg.= '</div>';
	$msg.= '</div>';

	$app->redirect($rlink, $msg);
}
else
{
	// prepare Document
	$document	= JFactory::getDocument();
	$menus		= $app->getMenu();
	$pathway 	= $app->getPathway();
	$title 		= null;

	$icsetvar = 'components/com_icagenda/add/elements/icsetvar.php';

	$menu = $menus->getActive();
	if ($menu)
	{
		$this->params->def('page_heading', $this->params->get('page_title', $item->title));
	}
	else
	{
		$this->params->def('page_heading', JText::_('JGLOBAL_ARTICLES'));
	}

	$title = JText::_( 'COM_ICAGENDA_REGISTRATION_TITLE' ).' : '.$item->title;

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
	$document->setTitle($title);

	// START OF THE PAGE
	?>
	<div id="icagenda<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

		<?php
		// load Theme and css
		if (file_exists( JPATH_SITE . '/components/com_icagenda/themes/packs/'.$this->template.'/'.$this->template.'_registration.php' ))
		{
			$tpl_registration	= JPATH_SITE . '/components/com_icagenda/themes/packs/'.$this->template.'/'.$this->template.'_registration.php';
			$css_component		= '/components/com_icagenda/themes/packs/'.$this->template.'/css/'.$this->template.'_component.css';
		}
		else
		{
			$tpl_registration	= JPATH_SITE . '/components/com_icagenda/themes/packs/default/default_registration.php';
			$css_component		= '/components/com_icagenda/themes/packs/default/css/default_component.css';
		}

		// Add the media specific CSS to the document
		JLoader::register('iCagendaMediaCss', JPATH_ROOT . '/components/com_icagenda/helpers/media_css.class.php');
		iCagendaMediaCss::addMediaCss($this->template, 'component');

		$stamp = $this->data;

		// Loads Variables for Theme files
		require_once $icsetvar;

		// Loads Header
		require_once $tpl_registration;

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

		$user = JFactory::getUser();
		$u_id=$user->get('id');
		$u_mail=$user->get('email');

		// logged-in Users: Name/User Name Option
		$nameJoomlaUser = JComponentHelper::getParams('com_icagenda')->get('nameJoomlaUser', 1);
		if ($nameJoomlaUser == 1)
		{
			$u_name=$user->get('name');
		}
		else
		{
			$u_name=$user->get('username');
		}

		// Autofill name and email if registered user log in
		$autofilluser = JComponentHelper::getParams('com_icagenda')->get('autofilluser', 1);
		if ($autofilluser != 1)
		{
			$u_name='';
			$u_mail='';
		}

		// Get Phone Options
		$phoneDisplay = JComponentHelper::getParams('com_icagenda')->get('phoneDisplay', 1);

		// Get Notes Options
		$notesDisplay = JComponentHelper::getParams('com_icagenda')->get('notesDisplay', 0);

		//$themeform = $this->template.'_form';
		$theme = $this->template;

		//$infoimg = JURI::root().'components/com_icagenda/themes/packs/'.$theme.'/images/info.png';
		$infoimg = JURI::root().'components/com_icagenda/themes/packs/default/images/info.png';

		// Global Options
		$iCparams = JComponentHelper::getParams('com_icagenda');
		$terms = $iCparams->get('terms', 0);

		JText::script('COM_ICAGENDA_TERMS_AND_CONDITIONS_NOT_CHECKED_REGISTRATION');

		// Set Tooltips
		$icTip_userID	= htmlspecialchars('<strong>' . JText::_( 'ICAGENDA_REGISTRATION_FORM_USERID' ) . '</strong><br />' . JText::_( 'ICAGENDA_REGISTRATION_FORM_USERID_DESC' ) . '');
		$icTip_name		= htmlspecialchars('<strong>' . JText::_( 'ICAGENDA_REGISTRATION_FORM_NAME' ) . '</strong><br />' . JText::_( 'ICAGENDA_REGISTRATION_FORM_NAME_DESC' ) . '');
		$icTip_email	= htmlspecialchars('<strong>' . JText::_( 'ICAGENDA_REGISTRATION_FORM_EMAIL' ) . '</strong><br />' . JText::_( 'ICAGENDA_REGISTRATION_FORM_EMAIL_DESC' ) . '');
		$icTip_phone	= htmlspecialchars('<strong>' . JText::_( 'ICAGENDA_REGISTRATION_FORM_PHONE' ) . '</strong><br />' . JText::_( 'ICAGENDA_REGISTRATION_FORM_PHONE_DESC' ) . '');
		$icTip_date		= htmlspecialchars('<strong>' . JText::_( 'ICAGENDA_REGISTRATION_FORM_DATE' ) . '</strong><br />' . JText::_( 'ICAGENDA_REGISTRATION_FORM_DATE_DESC' ) . '');
		$icTip_period	= htmlspecialchars('<strong>' . JText::_( 'ICAGENDA_REGISTRATION_FORM_PERIOD' ) . '</strong><br />' . JText::_( 'ICAGENDA_REGISTRATION_FORM_PERIOD_DESC' ) . '');
		$icTip_people = htmlspecialchars('<strong>' . JText::_( 'ICAGENDA_REGISTRATION_FORM_PEOPLE' ) . '</strong><br />' . JText::_( 'ICAGENDA_REGISTRATION_FORM_PEOPLE_DESC' ) . '');
		?>

		<script type="text/javascript"><!--

		function checkAgree() {
			var agree = document.getElementById('formAgree');
			if (!agree.checked) {
				alert(Joomla.JText._('COM_ICAGENDA_TERMS_AND_CONDITIONS_NOT_CHECKED_REGISTRATION'));
				return false;
			}
		}
		--></script>

		<?php // START CONTENT ?>
		<div class="formTitle">
			<h2><?php echo JText::_( 'COM_ICAGENDA_REGISTRATION_TITLE' ); ?></h2>
		</div>
		<?php // START FORM ?>
		<form name="registration" action="<?php echo JRoute::_('index.php'); ?>"  class="icagenda_form" method="post" onsubmit="return checkAgree();">
			<div class="fieldset">
				<div>
					<?php if (($u_id) AND ($autofilluser == 1)) : ?>
						<?php //echo '<label>' . JText::_( 'ICAGENDA_REGISTRATION_FORM_USERID' ) . '</label>'; ?>
						<?php //echo '<input type="text" value="'.$u_id.'" disabled="disabled" size="2" />'; ?>
						<?php echo '<input type="hidden" name="uid" value="'.$u_id.'" />'; ?>
						<!--span class="formInfo">
							<?php //echo '<a class="icFormTip" title="'.$icTip_userID.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
						</span-->
					<?php else : ?>
						<?php echo '<input type="hidden" name="uid" value="" disabled="disabled" size="2" />'; ?>
					<?php endif; ?>
   				</div>
				<div>
					<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_NAME' ); ?> *</label>
					<?php if ($u_name) : ?>
						<?php echo '<input type="text" name="name" value="'.$u_name.'" readonly="true" />'; ?>
						<?php //echo '<input type="hidden" name="name" value="'.$u_name.'" />'; ?>
					<?php else : ?>
						<?php echo '<input type="text" name="name" value="" size="30" required="true" />'; ?>
					<?php endif; ?>
					<span class="formInfo">
						<?php echo '<a class="icFormTip" title="'.$icTip_name.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
					</span>
				</div>
				<div>
					<?php if ($item->emailRequired == '1') : ?>
						<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_EMAIL' ); ?> *</label>
						<?php if ($u_mail) : ?>
							<?php echo '<input type="email" name="email" value="'.$u_mail.'" readonly="true" />'; ?>
							<?php //echo '<input type="hidden" name="email" value="'.$u_mail.'" />'; ?>
						<?php else : ?>
							<?php echo '<input type="email" name="email" value="" size="30" required="true" class="required validate-email" />'; ?>
						<?php endif; ?>
					<?php else : ?>
						<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_EMAIL' ); ?></label>
						<?php if ($u_mail) : ?>
							<?php echo '<input type="email" name="email" value="'.$u_mail.'" readonly="true" />'; ?>
							<?php //echo '<input type="hidden" name="email" value="'.$u_mail.'" />'; ?>
						<?php else : ?>
							<?php echo '<input type="email" name="email" value="" size="30" class="required validate-email" />'; ?>
						<?php endif; ?>
					<?php endif; ?>
					<span class="formInfo">
						<?php echo '<a class="icFormTip" title="'.$icTip_email.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
					</span>
				</div>

				<?php if ($phoneDisplay == 1) : ?>
					<div>
						<?php if ($item->phoneRequired == '1'): ?>
							<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_PHONE' ); ?> *</label>
							<input type="text" name="phone" size="20" required="true" />
						<?php endif; ?>
						<?php if (($item->phoneRequired == '0') OR ($item->phoneRequired == '2')): ?>
							<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_PHONE' ); ?></label>
							<input type="text" name="phone" size="20" />
						<?php endif; ?>
						<span class="formInfo">
							<?php echo '<a class="icFormTip" title="'.$icTip_phone.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
						</span>
					</div>
				<?php endif; ?>


				<?php
				/**
				 * Field Date
				 */
				foreach($stamp->items as $item)
				{
					$typeReg = $item->typeReg;

					//
					// All Options (Option removed in 3.3.2)
					//
					if ($typeReg == 0)
					{
						?>
						<div>
							<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_DATE' ); ?></label>
							<select type="hidden" name="date">
								<?php
//										foreach ($stamp->items as $item)
//										{
											foreach ($item->datelistMkt as $date)
											{
												$date_get = explode('@@', $date);
												$date_value = $date_get[0];
												$date_label = $date_get[1];
												echo '<option value="'.$date_value.'">'.$date_label.'</option>';
											}
//										}
								?>
							</select>
							<span class="formInfo">
								<?php echo '<a class="icFormTip" title="'.$icTip_date.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
							</span>
						</div>

						<?php if ($item->periodDisplay) : ?>
							<?php if ($item->periodControl == 1) : ?>
								<div>
									<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_PERIOD' ); ?></label>
									<?php
									foreach($stamp->items as $item)
									{
										$start = $item->startDate.' <span class="evttime">'.$item->startTime.'</span>';
										$end = $item->endDate.' <span class="evttime">'.$item->endTime.'</span>';
										echo $start.' - '.$end;
									}
									?>
								</div>
								<div>
									<label>&nbsp;</label>
									<?php echo JText::_( 'JYES' );?> <input type="radio" name="period" value="1" />
									<?php echo JText::_( 'JNO' );?> <input type="radio" name="period" value="0" CHECKED />
									<span class="formInfo">
										<?php echo '<a class="icFormTip" title="'.$icTip_period.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
									</span>
								</div>
							<?php endif; ?>
						<?php endif; ?>

					<?php
					//
					// Dates List
					//
					}
					elseif ($typeReg == 1)
					{
						?>
						<div>
							<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_DATE' ); ?></label>
							<select type="hidden" name="date">
								<?php
//										foreach ($stamp->items as $item)
//										{
											foreach ($item->datelistMkt as $date)
											{
												$date_get = explode('@@', $date);
												$date_value = $date_get[0];
												$date_label = $date_get[1];
												echo '<option value="'.$date_value.'">'.$date_label.'</option>';
											}
//										}
								?>
							</select>
							<span class="formInfo">
								<?php echo '<a class="icFormTip" title="'.$icTip_date.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
							</span>
						</div>

					<?php
					//
					// Only Period
					//
					}
					else
					{
					?>
						<?php if ($item->periodDisplay) : ?>
							<?php if ($item->periodControl == 1) : ?>
								<div>
									<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_PERIOD' ); ?></label>
									<input type="hidden" name="period" value="1" />
									<?php
									foreach ($stamp->items as $item)
									{
										$start = $item->startDate.' <span class="evttime">'.$item->startTime.'</span>';
										$end = $item->endDate.' <span class="evttime">'.$item->endTime.'</span>';
										echo $start.' - '.$end;
									}
									?>
								</div>
							<?php endif; ?>
						<?php else : ?>
							<div>
								<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_DATE' ); ?></label>
								<select type="hidden" name="date">
									<?php
//										foreach ($stamp->items as $item)
//										{
											foreach ($item->datelistMkt as $date)
											{
												$date_get = explode('@@', $date);
												$date_value = $date_get[0];
												$date_label = $date_get[1];
												echo '<option value="'.$date_value.'">'.$date_label.'</option>';
											}
//										}
									?>
								</select>
								<span class="formInfo">
									<?php echo '<a class="icFormTip" title="'.$icTip_date.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
								</span>
							</div>
						<?php endif; ?>
					<?php
					}
				}

				/**
				 * Field Number of People
				 */
				foreach ($stamp->items as $item)
				{
					$maxRlist = $item->maxRlist;

					if ($maxRlist > 1) : ?>
						<div>
							<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_PEOPLE' ); ?></label>
							<select type="list" name="people">
								<?php
								$maxRlist = $item->maxRlist;
								$maxReg = $item->maxReg;
								$registered = $item->registered;
								$placeRemain = ($maxReg - $registered);
								if ($placeRemain < $maxRlist)
								{
									$maxRlist = $placeRemain;
								}
								for ($i=1; $i <= $maxRlist; $i++)
								{
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								?>
							</select>
							<span class="formInfo">
								<?php echo '<a class="icFormTip" title="'.$icTip_people.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
							</span>
						</div>
					<?php else : ?>
						<input type="hidden" name="people" value="1" />
					<?php endif; ?>
				<?php
				}

				/**
				 * Field Number of People
				 */
				if ($notesDisplay == 1) : ?>
					<div>
						<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_NOTES' ); ?></label>
						<TEXTAREA name="notes" rows="10" cols="5" style="width:100%" placeholder="<?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_NOTES_DESC' ); ?>"></TEXTAREA>
					</div>
				<?php endif; ?>

				<?php
$dev = '0';

if ($dev == 1)
{

				/**
				 * Custom Fields
				 */
				foreach ($this->customfields as $icf) : ?>
				<?php
// Créer "Desc" !!!!

// to be added : desc, placeholder

					$icTip_custom = $icf->options ? htmlspecialchars('<strong>' . $icf->title . '</strong><br />' . $icf->options . '') : ''; ?>

					<div>
						<label><?php echo $icf->title; ?></label>
						<?php if ($icf->type == 'text') : ?>
							<input type="<?php echo $icf->type; ?>" name="custom_fields[<?php echo $icf->alias; ?>]" value="" placeholder="test" />
						<?php endif; ?>
						<?php if ($icTip_custom) : ?>
							<span class="formInfo">
								<?php echo '<a class="icFormTip" title="'.$icTip_custom.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
							</span>
						<?php endif; ?>
					</div>

				<?php endforeach; ?>

<?php
}
?>


				<?php // Hidden Fields id and Itemid ?>
				<input type="hidden" name="event" value="<?php echo JRequest::getInt('id'); ?>" />
				<input type="hidden" name="menuID" value="<?php echo JRequest::getInt('Itemid'); ?>" />

				<?php
				/**
				 * Terms of Service Display
				 */
				if ($terms == 0)
				{
					// Terms of Service not displayed
					$tokenHTML = str_replace('type="hidden"','id="formAgree" type="checkbox" checked style="display:none"',JHTML::_( 'form.token' ));
					echo $tokenHTML;
					echo '<div class="bgButton">';
				}
				elseif ($terms == 1)
				{
					// Terms of Service
					$tokenHTML = str_replace('type="hidden"','id="formAgree" type="checkbox"',JHTML::_( 'form.token' ));

					// Get the site name
					$config = JFactory::getConfig();
					if(version_compare(JVERSION, '3.0', 'ge')) {
						$sitename = $config->get('sitename');
					} else {
						$sitename = $config->getValue('config.sitename');
					}

					// Tos Type
					$iCparams = JComponentHelper::getParams('com_icagenda');
					$terms_Type = $iCparams->get('terms_Type', '');
					$termsArticle = $iCparams->get('termsArticle', '');
					$termsContent = $iCparams->get('termsContent', '');

					$termsDEFAULT_STRING = JText::_( 'COM_ICAGENDA_REGISTRATION_TERMS');
					$termsDEFAULT = str_replace('[SITENAME]', $sitename, $termsDEFAULT_STRING);
					$termsARTICLE = 'index.php?option=com_content&view=article&id='.$termsArticle.'&tmpl=component';
					$termsCUSTOM = $termsContent;

					// Menu-item ID (fix 3.2.1.1)
					$menu = JFactory::getApplication()->getMenu();
					$menuItems = $menu->getActive();
					$menuID = $menuItems->id;
					?>
					<input type="hidden" name="menuID" value="<?php echo $menuID; ?>" />
					<div class="bgButton">
						<div>
							<b><big><?php echo JText::_( 'COM_ICAGENDA_TERMS_AND_CONDITIONS'); ?></big></b>
						</div>
						<?php
						if ($terms_Type == 1)
						{
							echo '<iframe src="'.htmlentities($termsARTICLE).'" width="98%" height="150"></iframe>';
						}
						elseif ($terms_Type == 2)
						{
							echo '<div style="padding: 25px; background:#FFF; color: #333; text-align:left">';
							echo $termsCUSTOM;
							echo '</div>';
						}
						else
						{
							echo '<div style="padding: 25px; background:#FFF; color: #333; text-align:left">';
							echo $termsDEFAULT;
							echo '</div>';
						}
						?>
						<!--iframe src="<?php echo htmlentities($tosURL); ?>" width="98%" height="150"></iframe-->
						<div class="agreeToS">
							<p><?php echo $tokenHTML; ?> <?php echo JText::_( 'COM_ICAGENDA_TERMS_AND_CONDITIONS_AGREE'); ?> *</p>
						</div>
					<?php
				}
				?>
					<span>
						<input type="submit" value="<?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_SUBMIT' ); ?>" class="button" name="Submit"/>
						<input type="hidden" name="return" value="index.php" />
						<?php if (false) echo JHtml::_( 'form.token' ); ?>
					</span>
					<span class="buttonx">
						<a href="javascript:history.go(-1)" title="<?php echo JTEXT::_('COM_ICAGENDA_CANCEL'); ?>">
							<?php echo JTEXT::_('COM_ICAGENDA_CANCEL'); ?>
						</a>
					</span>
				</div><?php // End Div bgButton ?>
			</div><?php // End Form Fields ?>
			<div style="clear:both"></div>
		</form>
	</div>
	<?php
	$document->addStyleSheet( JURI::base( true ) . $css_component );
	$document->addStyleSheet( JURI::base( true ) . '/components/com_icagenda/add/css/style.css' );
	$document->addStyleSheet( JURI::base( true ) . '/media/com_icagenda/icicons/style.css' );
	$document->addStyleSheet( JURI::base( true ) . '/media/com_icagenda/css/tipTip.css' );

	if(version_compare(JVERSION, '3.0', 'lt'))
	{
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

	$document->addScript( JURI::base( true ) . '/media/com_icagenda/js/jquery.tipTip.js');

	$iCtip	 = array();
	$iCtip[] = '	jQuery(document).ready(function(){';
	$iCtip[] = '		jQuery(".icFormTip").tipTip({maxWidth: "200", defaultPosition: "right", edgeOffset: 10});';
	$iCtip[] = '	});';

	// Add the script to the document head.
	JFactory::getDocument()->addScriptDeclaration(implode("\n", $iCtip));
}
