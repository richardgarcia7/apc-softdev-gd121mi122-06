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
 * @themepack	default
 * @template	event_details
 * @version 	3.3.0 2014-02-06
 * @since       1.0
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die(); ?>

<!--
 *
 * iCagenda by Jooml!C
 * default Official Theme Pack
 *
 * @template	event_details
 * @version 	3.3.7
 *
-->

<?php // Event Details Template ?>
<div class="ic-clearfix">

	<?php // Title of the event ?>
	<h2>
		<?php echo $EVENT_TITLE; ?>
	</h2>

	<?php // Sharing and Registration ?>
	<div class="ic-event-buttons ic-clearfix">

		<?php // AddThis Social Sharing ?>
		<div class="ic-float-left">
			<?php echo $EVENT_SHARING; ?>
		</div>

		<?php // Registration button ?>
		<div class="ic-float-right">
			<?php echo $EVENT_REGISTRATION; ?>
		</div>

	</div>

	<?php // Event Display ?>
	<div class="ic-info">

		<?php // Show Image of the event ?>
		<?php if ($EVENT_IMAGE): ?>
			<div class="ic-image ic-align-center">
				<?php echo $EVENT_IMAGE_TAG; ?>
			</div>
		<?php endif; ?>

		<?php // Details of the event ?>
		<div class="ic-details ic-align-left">

			<div class="ic-divTable ic-align-left ic-clearfix">

				<?php // Category ?>
				<div class="ic-divRow">
					<div class="ic-divCell ic-label"><?php echo JTEXT::_('COM_ICAGENDA_EVENT_CAT');  ?></div>
					<div class="ic-divCell"><?php echo $CATEGORY_TITLE; ?></div>
				</div>

				<?php // Next Date ('next' 'today' or 'last date' if no next date) ?>
				<div class="ic-divRow">
					<div class="ic-divCell ic-label"><?php echo $EVENT_VIEW_DATE_TEXT; ?></div>
					<div class="ic-divCell"><?php echo $EVENT_VIEW_DATE; ?></div>
				</div>

				<?php // Venue name and/or address (different display, depending on the fields filled) ?>
				<?php if ($EVENT_VENUE OR $EVENT_ADDRESS): ?>
					<div class="ic-divRow">
						<div class="ic-divCell ic-label"><?php echo JTEXT::_('COM_ICAGENDA_EVENT_PLACE'); ?></div>
						<div class="ic-divCell">
							<?php if (($EVENT_VENUE) and (!$EVENT_ADDRESS)): ?>
								<?php echo $EVENT_VENUE; ?><?php if ($EVENT_CITY): ?> - <?php echo $EVENT_CITY;?><?php endif; ?>
							<?php endif; ?>
							<?php if ((!$EVENT_VENUE) and ($EVENT_ADDRESS)): ?>
								<?php echo $EVENT_ADDRESS; ?>
							<?php endif; ?>
							<?php if (($EVENT_VENUE) and ($EVENT_ADDRESS)): ?>
								<?php echo $EVENT_VENUE; ?> - <?php echo $EVENT_ADDRESS;?>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php // Information ?>
				<?php if ($EVENT_INFOS): ?>

					<?php // Max. Nb of seats ?>
					<?php if ($MAX_NB_OF_SEATS): ?>
						<div class="ic-divRow">
							<div class="ic-divCell ic-label"><?php echo JTEXT::_('COM_ICAGENDA_REGISTRATION_NUMBER_PLACES'); ?></div>
							<div class="ic-divCell"><?php echo $MAX_NB_OF_SEATS; ?></div>
						</div>
					<?php endif; ?>

					<?php // Nb of seats available ?>
					<?php if ($SEATS_AVAILABLE): ?>
						<div class="ic-divRow">
							<div class="ic-divCell ic-label"><?php echo JTEXT::_('COM_ICAGENDA_REGISTRATION_PLACES_LEFT'); ?></div>
							<div class="ic-divCell"><?php echo $SEATS_AVAILABLE; ?></div>
						</div>
					<?php endif; ?>

					<?php // phone ?>
					<?php if ($EVENT_PHONE): ?>
						<div class="ic-divRow">
							<div class="ic-divCell ic-label"><?php echo JTEXT::_('COM_ICAGENDA_EVENT_PHONE'); ?></div>
							<div class="ic-divCell"><?php echo $EVENT_PHONE; ?></div>
						</div>
					<?php endif; ?>

					<?php // email ?>
					<?php if ($EVENT_EMAIL): ?>
						<div class="ic-divRow">
							<div class="ic-divCell ic-label"><?php echo JTEXT::_('COM_ICAGENDA_EVENT_MAIL'); ?></div>
							<div class="ic-divCell"><?php echo $EVENT_EMAIL_CLOAKING; ?></div>
						</div>
					<?php endif; ?>

					<?php // website ?>
					<?php if ($EVENT_WEBSITE): ?>
						<div class="ic-divRow">
							<div class="ic-divCell ic-label"><?php echo JTEXT::_('COM_ICAGENDA_EVENT_WEBSITE'); ?></div>
							<div class="ic-divCell"><?php echo $EVENT_WEBSITE_LINK; ?></div>
						</div>
					<?php endif; ?>

					<?php // file attached ?>
					<?php if ($EVENT_ATTACHEMENTS): ?>
						<div class="ic-divRow">
							<div class="ic-divCell ic-label"><?php echo JTEXT::_('COM_ICAGENDA_EVENT_FILE'); ?></div>
							<div class="ic-divCell"><?php echo $EVENT_ATTACHEMENTS_TAG; ?></div>
						</div>
					<?php endif; ?>

				<?php endif; ?>

			</div>

		</div><?php // end div.details ?>


	<?php // description text ?>
	<?php if ($EVENT_DESC): ?>
		<div id="ic-detail-desc">
			<?php echo $EVENT_DESCRIPTION; ?>
		</div>
	<?php endif; ?>

	<div>&nbsp;</div>

	<?php // Google Maps ?>
	<?php if ($GOOGLEMAPS_COORDINATES): ?>
		<div id="ic-detail-map">
			<div class="icagenda_map">
				<?php echo $EVENT_MAP; ?>
			</div>
		</div>
	<?php endif; ?>

	<div>&nbsp;</div>

	<?php // List of all dates (multi-dates and/or period from to) ?>
	<?php if ($EVENT_SINGLE_DATES OR $EVENT_PERIOD): ?>
		<div id="ic-list-of-dates" class="ic-all-dates">
			<h3>
				<?php echo JTEXT::_('COM_ICAGENDA_EVENT_DATES'); ?>
			</h3>
			<div class="ic-dates-list">

				<?php // Period from X to X ?>
				<?php echo $EVENT_PERIOD; ?>

				<?php // Individual dates ?>
				<?php echo $EVENT_SINGLE_DATES; ?>

			</div>
		</div>
	<?php endif; ?>

	</div><?php // end div.info ?>

	<?php // List of Participants ?>
	<?php if ($PARTICIPANTS_DISPLAY == 1) : ?>
		<div id="ic-list-of-participants" class="ic-participants">
			<?php // Display header title 'List of Participants' if slide effect is disabled ?>
			<?php if ($PARTICIPANTS_HEADER) : ?>
				<h3>
					<?php echo $PARTICIPANTS_HEADER; ?>
				</h3>
			<?php endif; ?>
			<?php echo $EVENT_PARTICIPANTS; ?>
		</div>
	<?php endif; ?>


</div><?php // end div Event-details ?>
