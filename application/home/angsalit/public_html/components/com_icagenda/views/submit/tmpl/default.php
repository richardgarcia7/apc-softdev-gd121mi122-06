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
//JHtml::_('behavior.tooltip');

// Global Options
$iCparams = JComponentHelper::getParams('com_icagenda');

// Get Application
$app = JFactory::getApplication();

// Get User
$user = JFactory::getUser();

// Get User Info (Access Levels, id, email)
$userLevels	= $user->getAuthorisedViewLevels();
$u_id		= $user->get('id');
$u_mail		= $user->get('email');

// Get Access Levels to the form
$accessDefault = array('2');
$submitAccess = $iCparams->get('submitAccess', $accessDefault);

// Get Content of the page for not logged-in users
$NotLoginDefault = JText::_( 'COM_ICAGENDA_EVENT_SUBMISSION_ACCESS' ).'<br />';
$submitNotLogin = $iCparams->get('submitNotLogin', '');
if ($submitNotLogin == 2)
{
	$submitNotLogin_Content = $iCparams->get('submitNotLogin_Content', $NotLoginDefault);
}
else
{
	$submitNotLogin_Content = $NotLoginDefault;
}

// Get Content of the page for not authorised logged-in users
$NoRightsDefault = JText::_( 'COM_ICAGENDA_EVENT_SUBMISSION_NO_RIGHTS' ).'<br />';
$submitNoRights = $iCparams->get('submitNoRights', '');
if ($submitNoRights == 2)
{
	$submitNoRights_Content = $iCparams->get('submitNoRights_Content', $NoRightsDefault);
}
else
{
	$submitNoRights_Content = $NoRightsDefault;
}

// Control: if access level, set true to display form
$AccessForm = false;

foreach ($submitAccess AS $ac)
{
	if ( in_array($ac, $userLevels ))
	{
		$AccessForm = true;
	}
}

// Loading Submission Page
if ( !$u_id AND !in_array('1', $submitAccess ))
{
	// if not login, and submission form not "public"

	// Set Return Page
	$return = JURI::getInstance()->toString();

	// redirect after successful registration
	$app->redirect(htmlspecialchars_decode('index.php?option=com_users&view=login&return=' . urlencode(base64_encode($return))) , JFactory::getApplication()->enqueueMessage($submitNotLogin_Content, 'info'));

}
elseif (!$AccessForm)
{
	// if No Access Permissions

	// Set Return Page
	$return = JURI::getInstance()->toString();

	// redirect after successful registration
	$app->redirect(htmlspecialchars_decode('index.php?option=com_users&view=login&return=' . urlencode(base64_encode($return))) , JFactory::getApplication()->enqueueMessage($submitNoRights_Content, 'info'));

}
else
{
	// Display Form

	// Set name or username for logged-in user
	$nameJoomlaUser = $iCparams->get('nameJoomlaUser', 1);
	if ($nameJoomlaUser == 1)
	{
		$u_name=$user->get('name');
	}
	else
	{
		$u_name=$user->get('username');
	}

	// Autofill name and email if registered user log in
	$autofilluser = $iCparams->get('autofilluser', 1);
	if ($autofilluser != 1)
	{
		$u_name='';
		$u_mail='';
	}

	$theme = $this->template;
	$infoimg = JURI::root().'components/com_icagenda/themes/packs/default/images/info.png';

	JText::script('COM_ICAGENDA_TERMS_OF_SERVICE_NOT_CHECKED_SUBMIT_EVENT');
	JText::script('COM_ICAGENDA_FORM_NO_DATES_ALERT');

	$tos = $iCparams->get('tos', 1);

	// Event Params
	$params = $this->form->getFieldsets('params');

	// Set default values for Google Maps
	// ZOOM
	$zoom='16';
	// HYBRID, ROADMAP, SATELLITE, TERRAIN
	$mapTypeId='ROADMAP';

	$coords='0, 0';
	$oldcoordinate=$coords;
	$lat='0';
	$lng='0';
	//if (($oldcoordinate == NULL) && ($lat == '0') && ($lng == '0')) { $zoom='1'; }
	$zoom='1';

	// Set Tooltips
	$icTip_name		= htmlspecialchars('<strong>' . JText::_( 'ICAGENDA_REGISTRATION_FORM_NAME' ) . '</strong><br />' . JText::_( 'ICAGENDA_REGISTRATION_FORM_NAME_DESC' ) . '');
	$icTip_Uemail	= htmlspecialchars('<strong>' . JText::_( 'ICAGENDA_REGISTRATION_FORM_EMAIL' ) . '</strong><br />' . JText::_( 'COM_ICAGENDA_SUBMIT_FORM_USER_EMAIL_DESC' ) . '');
	$icTip_title	= htmlspecialchars('<strong>' . JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_TITLE' ) . '</strong><br />' . JText::_( 'COM_ICAGENDA_FORM_DESC_EVENT_TITLE' ) . '');
	$icTip_category	= htmlspecialchars('<strong>' . JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_CATID' ) . '</strong><br />' . JText::_( 'COM_ICAGENDA_FORM_DESC_EVENT_CATID' ) . '');
	$icTip_image	= htmlspecialchars('<strong>' . JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_IMAGE' ) . '</strong><br />' . JText::_( 'COM_ICAGENDA_FORM_DESC_EVENT_IMAGE' ) . '');
	$icTip_startD	= htmlspecialchars('<strong>' . JText::_( 'COM_ICAGENDA_FORM_LBL_EVENTPERIOD_START' ) . '</strong><br />' . JText::_( 'COM_ICAGENDA_FORM_DESC_EVENTPERIOD_START' ) . '');
	$icTip_endD		= htmlspecialchars('<strong>' . JText::_( 'COM_ICAGENDA_FORM_LBL_EVENTPERIOD_END' ) . '</strong><br />' . JText::_( 'COM_ICAGENDA_FORM_DESC_EVENTPERIOD_END' ) . '');
	$icTip_venue	= htmlspecialchars('<strong>' . JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_VENUE' ) . '</strong><br />' . JText::_( 'COM_ICAGENDA_FORM_DESC_EVENT_VENUE' ) . '');
	$icTip_email	= htmlspecialchars('<strong>' . JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_EMAIL' ) . '</strong><br />' . JText::_( 'COM_ICAGENDA_FORM_DESC_EVENT_EMAIL' ) . '');
	$icTip_phone	= htmlspecialchars('<strong>' . JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_PHONE' ) . '</strong><br />' . JText::_( 'COM_ICAGENDA_FORM_DESC_EVENT_PHONE' ) . '');
	$icTip_website	= htmlspecialchars('<strong>' . JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_WEBSITE' ) . '</strong><br />' . JText::_( 'COM_ICAGENDA_FORM_DESC_EVENT_WEBSITE' ) . '');
	$icTip_file		= htmlspecialchars('<strong>' . JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_FILE' ) . '</strong><br />' . JText::_( 'COM_ICAGENDA_FORM_DESC_EVENT_FILE' ) . '');
	?>

	<style type="text/css" media="screen">
		legend {
			font-weight:bold;
		}
	</style>

	<div id="icagenda<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php if ($this->params->get('show_page_heading', 1)) : ?>
		<h1 class="componentheading">
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
		<?php endif; ?>

		<form id="submitevent" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="icagenda_form" enctype="multipart/form-data" onsubmit="return checkAgree();">
			<div>
			<legend><?php echo JText::_('COM_ICAGENDA_LEGEND_USERINFOS'); ?></legend>
			<div class="fieldset">
				<div>
					<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_NAME' ); ?> *</label>
					<?php
					if ($u_name)
					{
						echo '<input type="text" name="username" value="'.$this->escape($u_name).'" readonly="true" />';
//						echo '<input type="hidden" name="username" value="'.$u_name.'" required="true" />';
					}
					else
					{
						echo '<input type="text" name="username" value="" size="30" required="true" />';
					}
					?>
					<span class="formInfo">
						<?php echo '<a class="icSubmitTip" title="'.$icTip_name.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
					</span>
				</div>
				<div>
					<label><?php echo JText::_( 'ICAGENDA_REGISTRATION_FORM_EMAIL' ); ?> *</label>
					<?php
					if ($u_mail)
					{
						echo '<input type="text" name="created_by_email" value="'.$this->escape($u_mail).'" readonly="true" />';
//						echo '<input type="hidden" name="created_by_email" value="'.$u_mail.'" />';
					}
					else
					{
						echo '<input type="text" name="created_by_email" value="" size="30" required="true" />';
					}
					?>
					<span class="formInfo">
						<?php echo '<a class="icSubmitTip" title="'.$icTip_Uemail.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
					</span>
				</div>
			</div>
			<div>&nbsp;</div>

			<legend><?php echo JText::_('COM_ICAGENDA_LEGEND_NEW_EVENT'); ?></legend>

			<div class="fieldset">
				<div>
					<label><?php echo JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_TITLE' ); ?> *</label>
					<input type="text" name="title" size="40" required="true" />
					<span class="formInfo">
						<?php echo '<a class="icSubmitTip" title="'.$icTip_title.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
					</span>
				</div>
				<div>
					<label><?php echo JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_CATID' ); ?> *</label>
					<?php echo $this->form->getInput('catid'); ?>
					<span class="formInfo">
						<?php echo '<a class="icSubmitTip" title="'.$icTip_category.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
					</span>
				</div>
				<?php if ($this->submit_imageDisplay) : ?>
				<div>
					<label><?php echo JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_IMAGE' ); ?></label>
					<?php echo $this->form->getInput('image'); ?>
					<span class="formInfo">
						<?php echo '<a class="icSubmitTip" title="'.$icTip_image.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
					</span>
				</div>
				<?php endif; ?>
			</div>
			<div>&nbsp;</div>

			<legend><?php echo JText::_('COM_ICAGENDA_LEGEND_DATES'); ?></legend>

			<div class="fieldset">
				<h3><?php echo JText::_('COM_ICAGENDA_LEGEND_PERIOD_DATES'); ?></h3>
				<div>
					<label><?php echo JText::_( 'COM_ICAGENDA_FORM_LBL_EVENTPERIOD_START' ); ?></label>
					<input type="text" name="startdate" id="startdate">
					<span class="formInfo">
						<?php echo '<a class="icSubmitTip" title="'.$icTip_startD.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
					</span>
				</div>
				<div>
					<label><?php echo JText::_( 'COM_ICAGENDA_FORM_LBL_EVENTPERIOD_END' ); ?></label>
					<input type="text" name="enddate" id="enddate">
					<span class="formInfo">
						<?php echo '<a class="icSubmitTip" title="'.$icTip_endD.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
					</span>
				</div>
				<div class="control-group">
					<?php echo $this->form->getLabel('weekdays'); ?>
					<div class="controls">
						<?php echo $this->form->getInput('weekdays'); ?>
					</div>
				</div>

				<h3><?php echo JText::_('COM_ICAGENDA_LEGEND_SINGLE_DATES'); ?></h3>

				<div>
					<?php echo $this->form->getInput('dates'); ?>
				</div>
				<div class="control-group">
					<?php echo $this->form->getLabel('next'); ?>
					<div class="controls">
						<?php echo $this->form->getInput('next'); ?>
					</div>
				</div>
			</div>

			<?php
			echo '<div style="margin:0">'
				.JHtml::_('sliders.start', 'info-slider', array('useCookie'=>0, 'startOffset'=>-1, 'startTransition'=>1))
				.JHtml::_('sliders.panel', JText::_('COM_ICAGENDA_DATES_HELP'), 'slide1')
				.'<fieldset class="panelform" >'
				.'<ul class="adminformlist" style="color:#555555;">'
				.'<div>'. JText::_('COM_ICAGENDA_DATES_HELP_INTRO').'</div><br>'
				.'<div style="text-transform:uppercase;"><b>'. JText::_('COM_ICAGENDA_LEGEND_SINGLE_DATES').'</b></div>'
				.'<div><b>&#9658; '. JText::_('COM_ICAGENDA_DATES_HELP_LINE1').'</b></div>'
				.'<div><i>'. JText::_('COM_ICAGENDA_DATES_HELP_EXAMPLE1').'</i></div><br>'
				.'<div><b>&#9658; '. JText::_('COM_ICAGENDA_DATES_HELP_LINE2').'</b></div>'
				.'<div><i>'. JText::_('COM_ICAGENDA_DATES_HELP_EXAMPLE2').'</i></div><br>'
				.'<div style="text-transform:uppercase;"><b>'. JText::_('COM_ICAGENDA_LEGEND_PERIOD_DATES').'</b></div>'
				.'<div><b>&#9658; '. JText::_('COM_ICAGENDA_DATES_HELP_LINE3').'</b></div>'
				.'<div><i>'. JText::_('COM_ICAGENDA_DATES_HELP_EXAMPLE3').'</i></div><br>'
				.'<div style="text-transform:uppercase;"><b>'. JText::_('COM_ICAGENDA_LEGEND_PERIOD_DATES').' & '. JText::_('COM_ICAGENDA_LEGEND_SINGLE_DATES').'</b></div>'
				.'<div><b>&#9658; '. JText::_('COM_ICAGENDA_DATES_HELP_LINE4').'</b></div>'
				.'<div><i>'. JText::_('COM_ICAGENDA_DATES_HELP_EXAMPLE4').'</i></div><br>'
				.'<div><b>&#9658; '. JText::_('COM_ICAGENDA_DATES_HELP_LINE5').'</b></div>'
				.'<div><i>'. JText::_('COM_ICAGENDA_DATES_HELP_EXAMPLE5').'</i></div><br>'
				.'</ul>'
				.'</div>'
				.JHtml::_('sliders.end')
				.'<br />';
			?>
			<div>&nbsp;</div>

			<?php // Description Field Set ?>
			<?php if ($this->submit_descDisplay
				OR $this->submit_metadescDisplay) : ?>
				<legend><?php echo JText::_('COM_ICAGENDA_LEGEND_DESC'); ?></legend>
				<div class="fieldset">

					<?php // Description ?>
					<?php if ($this->submit_descDisplay) : ?>
						<div>
							<?php echo $this->form->getInput('desc'); ?>
						</div>
						<div>&nbsp;</div>
					<?php endif; ?>
					<?php if ($this->submit_metadescDisplay) : ?>
						<div>
							<?php echo $this->form->getLabel('metadesc'); ?>
							<?php echo $this->form->getInput('metadesc'); ?>
						</div>
						<div>&nbsp;</div>
					<?php endif; ?>
				</div>
				<div>&nbsp;</div>
			<?php endif; ?>

			<?php // Information Field Set ?>
			<?php if ($this->submit_venueDisplay
				OR $this->submit_emailDisplay
				OR $this->submit_phoneDisplay
				OR $this->submit_websiteDisplay
				OR $this->submit_fileDisplay) : ?>
				<legend><?php echo JText::_('COM_ICAGENDA_LEGEND_INFORMATION'); ?></legend>
				<div class="fieldset">

					<?php // Venue ?>
					<?php if ($this->submit_venueDisplay) : ?>
						<h3><?php echo JText::_('COM_ICAGENDA_LEGEND_VENUE'); ?></h3>
						<div>
							<label><?php echo JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_VENUE' ); ?></label>
							<?php echo $this->form->getInput('place'); ?>
							<span class="formInfo">
								<?php echo '<a class="icSubmitTip" title="'.$icTip_venue.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
							</span>
						</div>
					<?php endif; ?>

					<?php // Contact ?>
					<?php if ($this->submit_emailDisplay
						OR $this->submit_phoneDisplay
						OR $this->submit_websiteDisplay) : ?>
						<h3><?php echo JText::_('COM_ICAGENDA_LEGEND_CONTACT'); ?></h3>

						<?php // Email ?>
						<?php if ($this->submit_emailDisplay) : ?>
						<div>
							<label><?php echo JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_EMAIL' ); ?></label>
							<?php echo $this->form->getInput('email'); ?>
							<span class="formInfo">
								<?php echo '<a class="icSubmitTip" title="'.$icTip_email.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
							</span>
						</div>
						<?php endif; ?>

						<?php // Phone ?>
						<?php if ($this->submit_phoneDisplay) : ?>
						<div>
							<label><?php echo JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_PHONE' ); ?></label>
							<?php echo $this->form->getInput('phone'); ?>
							<span class="formInfo">
								<?php echo '<a class="icSubmitTip" title="'.$icTip_phone.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
							</span>
						</div>
						<?php endif; ?>

						<?php // Website ?>
						<?php if ($this->submit_websiteDisplay) : ?>
						<div>
							<label><?php echo JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_WEBSITE' ); ?></label>
							<?php echo $this->form->getInput('website'); ?>
							<span class="formInfo">
								<?php echo '<a class="icSubmitTip" title="'.$icTip_website.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
							</span>
						</div>
						<?php endif; ?>
					<?php endif; ?>

					<?php // Attachment ?>
					<?php if ($this->submit_fileDisplay) : ?>
						<h3><?php echo JText::_('COM_ICAGENDA_LEGEND_ALLEG'); ?></h3>
						<div>
							<label><?php echo JText::_( 'COM_ICAGENDA_FORM_LBL_EVENT_FILE' ); ?></label>
							<?php echo $this->form->getInput('file'); ?>
							<span class="formInfo">
								<?php echo '<a class="icSubmitTip" title="'.$icTip_file.'"><img src="'.$infoimg.'" alt="" /></a>'; ?>
							</span>
						</div>
					<?php endif; ?>
				</div>
				<div>&nbsp;</div>
			<?php endif; ?>

			<?php // Google Maps Field Set ?>
			<?php if ($this->submit_gmapDisplay) : ?>
				<legend><?php echo JText::_('COM_ICAGENDA_LEGEND_GOOGLE_MAPS'); ?></legend>
				<div class="fieldset">
					<div id="googlemap">
						<div class="row-fluid">
							<div class="span6 iCleft">
								<h3><?php echo JText::_('COM_ICAGENDA_GOOGLE_MAPS_SUBTITLE_LBL'); ?></h3>
								<div>
									<?php echo JText::_('COM_ICAGENDA_GOOGLE_MAPS_NOTE1'); ?>
									<br/>
									<?php echo JText::_('COM_ICAGENDA_GOOGLE_MAPS_NOTE2'); ?>
									<br/>
								</div>
								<div style="clear:both"></div>
								<div>
									<div class="icmap-input">
										<?php echo $this->form->getLabel('address'); ?>
										<?php echo $this->form->getInput('address'); ?>
									</div>
									<div class="icmap-input" style="height:40px">
										<?php echo $this->form->getInput('city'); ?>
									</div>
									<div class="icmap-input" style="height:40px">
										<?php echo $this->form->getInput('country'); ?>
									</div>
									<div class="icmap-input" style="height:40px">
										<?php echo $this->form->getInput('lat'); ?>
									</div>
									<div class="icmap-input" style="height:40px">
										<?php echo $this->form->getInput('lng'); ?>
									</div>
								</div>
							</div>
							<div class="span6 iCleft">
								<div class='map-wrapper'>
									<h3>Map</h3>
									<label id="geo_label" for="reverseGeocode"><?php echo JText::_('COM_ICAGENDA_GOOGLE_MAPS_REVERSE'); ?></label>
									<select id="reverseGeocode">
										<option value="false" selected><?php echo JText::_('JNO'); ?></option>
										<option value="true"><?php echo JText::_('JYES'); ?></option>
									</select><br/>
									<div id="map"></div>
									<div id="legend"><?php echo JText::_('COM_ICAGENDA_GOOGLE_MAPS_LEGEND'); ?></div>
								</div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
				<div>&nbsp;</div>
			<?php endif; ?>

			<?php // Registration Field Set ?>
			<?php if ($this->submit_regoptionsDisplay && $this->statutReg == 1) : ?>
				<legend><?php echo JText::_('COM_ICAGENDA_REGISTRATION_OPTIONS'); ?></legend>
				<div class="fieldset">
					<?php foreach ($params as $name => $fieldSet) : ?>
						<?php if (isset($fieldSet->description) && trim($fieldSet->description)) : ?>
							<p class="tip"><?php echo $this->escape(JText::_($fieldSet->description));?></p>
						<?php endif; ?>
						<!--h3><?php echo $this->escape(JText::_($fieldSet->label)); ?></h3-->
						<?php foreach ($this->form->getFieldset($name) as $field) : ?>
							<div class="icmap-input">
								<?php echo $field->label; ?>
								<?php echo $field->input; ?>
							</div>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</div>
				<div>&nbsp;</div>
			<?php endif; ?>

			<?php // Hidden Fields ?>
			<div style="display:none">
				<?php echo $this->form->getInput('alias'); ?>
				<?php echo $this->form->getInput('id'); ?>
				<?php echo $this->form->getInput('created_by'); ?>
				<?php echo $this->form->getInput('created_by_alias'); ?>
				<?php echo $this->form->getInput('created'); ?>
				<?php echo $this->form->getInput('checked_out'); ?>
				<?php echo $this->form->getInput('checked_out_time'); ?>
			</div>

				<?php
				/**
				 * Terms of Service Display
				 */
				if ($tos == 0) // No Terms of Service
				{
					// Terms of Service not displayed
					$tokenHTML = str_replace('type="hidden"','id="formAgree" type="checkbox" checked style="display:none"',JHTML::_( 'form.token' ));
					echo $tokenHTML;
					?>
					<div class="bgButton">
						<span>
							<input type="submit" value="<?php echo JText::_( 'COM_ICAGENDA_EVENT_FORM_SUBMIT' ); ?>" class="button" name="submit"/>
							<input type="hidden" name="return" value="index.php" />
							<?php if (false) echo JHtml::_( 'form.token' ); ?>
						</span>
						<!--span class="buttonx">
							<a href="javascript:history.go(-1)" title="<?php echo JTEXT::_('COM_ICAGENDA_CANCEL'); ?>">
								<?php echo JTEXT::_('COM_ICAGENDA_CANCEL'); ?>
							</a>
						</span-->
					</div><?php // End Div bgButton ?>
					<?php
				}
				elseif ($tos == 1) // Terms of Service Required
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
					$tos_Type = $iCparams->get('tos_Type', '');
					$tosArticle = $iCparams->get('tosArticle', '');
					$tosContent = $iCparams->get('tosContent', '');

					$tosDEFAULT = JText::sprintf( 'COM_ICAGENDA_TOS', $sitename, $sitename);
					$tosARTICLE = 'index.php?option=com_content&view=article&id='.$tosArticle.'&tmpl=component';
					$tosCUSTOM = $tosContent;

					// Menu-item ID (fix 3.2.1.1)
					$menu = JFactory::getApplication()->getMenu();
					$menuItems = $menu->getActive();
					$menuID = $menuItems->id;
					?>
					<input type="hidden" name="menuID" value="<?php echo $menuID; ?>" />
					<div class="bgButton">
						<div>
							<b><big><?php echo JText::_( 'COM_ICAGENDA_TERMS_OF_SERVICE'); ?></big></b>
						</div>
						<?php
						if ($tos_Type == 1)
						{
							echo '<iframe src="'.htmlentities($tosARTICLE).'" width="98%" height="150"></iframe>';
						}
						elseif ($tos_Type == 2)
						{
							echo '<div style="padding: 25px; background:#FFF; color: #333; text-align:left">';
							echo $tosCUSTOM;
							echo '</div>';
						}
						else
						{
							echo '<div style="padding: 25px; background:#FFF; color: #333; text-align:left">';
							echo $tosDEFAULT;
							echo '</div>';
						}
						?>
						<!--iframe src="<?php echo htmlentities($tosURL); ?>" width="98%" height="150"></iframe-->
						<div class="agreeToS">
							<p><?php echo $tokenHTML; ?> <?php echo JText::_( 'COM_ICAGENDA_TERMS_OF_SERVICE_AGREE'); ?> *</p>
						</div>
						<span>
							<input type="submit" value="<?php echo JText::_( 'COM_ICAGENDA_EVENT_FORM_SUBMIT' ); ?>" class="button" name="Submit"/>
							<input type="hidden" name="return" value="index.php" />
							<?php if (false) echo JHtml::_( 'form.token' ); ?>
						</span>
						<!--span class="buttonx">
							<a href="javascript:history.go(-1)" title="<?php echo JTEXT::_('COM_ICAGENDA_CANCEL'); ?>">
								<?php echo JTEXT::_('COM_ICAGENDA_CANCEL'); ?>
							</a>
						</span-->
					</div><?php // End Div bgButton ?>
					<?php
				}
				?>
			</div><?php // End Form Fields ?>
			<div style="clear:both"></div>
		</form>
	</div>

	<script type="text/javascript">
		//<![CDATA[

		jQuery(function($) {
			var addresspicker = $( "#addresspicker" ).addresspicker();
			var addresspickerMap = $( '#address' ).addresspicker({
				regionBias: "fr",
				updateCallback: showCallback,
				mapOptions: {
					zoom: <?php echo $zoom; ?>,
					center: new google.maps.LatLng(<?php echo $coords; ?>),
					scrollwheel: false,
					mapTypeId: google.maps.MapTypeId.<?php echo $mapTypeId; ?>,
					streetViewControl: false
				},
				elements: {
					map:      "#map",
					lat:      "#lat",
					lng:      "#lng",
					street_number: '#street_number',
					route: '#route',
					locality: '#locality',
					administrative_area_level_2: '#administrative_area_level_2',
					administrative_area_level_1: '#administrative_area_level_1',
					country:  '#country',
					postal_code: '#postal_code',
					type:    '#type',
				}
			});

			var gmarker = addresspickerMap.addresspicker( "marker");
			gmarker.setVisible(true);
			addresspickerMap.addresspicker( "updatePosition");

			$('#reverseGeocode').change(function(){
				$("#address").addresspicker("option", "reverseGeocode", ($(this).val() === 'true'));
			});

			function showCallback(geocodeResult, parsedGeocodeResult){
				$('#callback_result').text(JSON.stringify(parsedGeocodeResult, null, 4));
			}
  		});
		//]]>
	</script>

	<?php
	$document	= JFactory::getDocument();
	$document->addStyleSheet( JURI::base( true ).'/components/com_icagenda/add/css/style.css' );

	if(file_exists("components/com_icagenda/themes/packs/".$this->template."/css/".$this->template."_component.css"))
	{
		$document->addStyleSheet( JURI::base( true ) . '/components/com_icagenda/themes/packs/' . $this->template . '/css/' . $this->template . '_component.css' );
	}
	else
	{
		$document->addStyleSheet( JURI::base( true ).'/components/com_icagenda/themes/packs/default/css/default_component.css' );
	}
	// Add the media specific CSS to the document
	JLoader::register('iCagendaMediaCss', JPATH_ROOT . '/components/com_icagenda/helpers/media_css.class.php');
	iCagendaMediaCss::addMediaCss($this->template, 'component');

	require_once $this->submit;


	jimport( 'joomla.environment.request' );

	$document->addStyleSheet(  JURI::base( true ).'/components/com_icagenda/add/css/icagenda.css' );
	$document->addStyleSheet(  JURI::base( true ).'/components/com_icagenda/add/css/jquery-ui-1.8.17.custom.css' );
	$document->addStyleSheet(  JURI::base( true ).'/components/com_icagenda/add/css/icmap.css' );

	if(version_compare(JVERSION, '3.0', 'lt'))
	{
		JHTML::_('stylesheet', 'icagenda.j25.css', 'components/com_icagenda/add/css/');

		JHTML::_('behavior.framework');

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
			if (stripos($scripts[$i], 'maps.google') !== false)
			{
				$mapsgooglescriptFound = true;
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
				$document->addScript( JURI::root( true ) . '/media/com_icagenda/js/jquery.noconflict.js' );
			}
		}

		if (!$scriptuiFound)
		{
			$document->addScript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
		}

		$document->addScript( JURI::root( true ) . '/media/com_icagenda/js/template.js' );
	}
	else
	{
		JHtml::_('formbehavior.chosen', 'select');
		jimport('joomla.html.html.bootstrap');

		JHtml::_('behavior.formvalidation');
		JHtml::_('bootstrap.framework');
		JHtml::_('jquery.framework');

		// Change jQuery UI version from 1.9.2 to 1.8.23 (joomla version, but not complete) to prevent a conflict in tooltip that appeared since Joomla 3.1.4
//		$document->addScript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
		$document->addScript( 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js' );
	}

	// Google Maps api V3
	$doclang = JFactory::getDocument();
	$curlang = $doclang->language;
	$lang = substr($curlang,0,2);
	$document->addScript('https://maps.googleapis.com/maps/api/js?sensor=false&language='.$lang);

	$document->addScript( JURI::root( true ) . '/media/com_icagenda/js/timepicker.js' );
	$document->addScript( JURI::root( true ) . '/media/com_icagenda/js/icdates.js' );
	$document->addScript( JURI::root( true ) . '/media/com_icagenda/js/icmap.js' );

	$document->addScript( JURI::root( true ) . '/media/com_icagenda/js/jquery.tipTip.js' );

	$checkAgree	= array();
	$checkAgree[] = '	function checkAgree() {';
	$checkAgree[] = '		var startDate = document.getElementById("startdate");';
	$checkAgree[] = '		var Dates = document.getElementById("dates_id");';
	$checkAgree[] = '		if ((startDate.value == "") && (Dates.value == "")) {';
	$checkAgree[] = '			alert(Joomla.JText._("COM_ICAGENDA_FORM_NO_DATES_ALERT"));';
	$checkAgree[] = '			return false;';
	$checkAgree[] = '		}';
	$checkAgree[] = '		var agree = document.getElementById("formAgree");';
	$checkAgree[] = '		if (agree.checked) {';
	$checkAgree[] = '			return true;';
	$checkAgree[] = '		} else {';
	$checkAgree[] = '			alert(Joomla.JText._("COM_ICAGENDA_TERMS_OF_SERVICE_NOT_CHECKED_SUBMIT_EVENT"));';
	$checkAgree[] = '			return false;';
	$checkAgree[] = '		}';
	$checkAgree[] = '		return true;';
	$checkAgree[] = '	}';

	// Add the script to the document head.
	JFactory::getDocument()->addScriptDeclaration(implode("\n", $checkAgree));


	$iCtip	 = array();
	$iCtip[] = '	jQuery(document).ready(function(){';
	$iCtip[] = '		jQuery(".icSubmitTip").tipTip({maxWidth: "280px", defaultPosition: "right", edgeOffset: 5});';
	$iCtip[] = '	});';

	// Add the script to the document head.
	JFactory::getDocument()->addScriptDeclaration(implode("\n", $iCtip));
}
