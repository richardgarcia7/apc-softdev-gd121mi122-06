<?php
/**
 *------------------------------------------------------------------------------
 *  iCagenda v3 by Jooml!C - Events Management Extension for Joomla! 2.5 / 3.x
 *------------------------------------------------------------------------------
 * @package     com_icagenda
 * @copyright   Copyright (c)2012-2014 Cyril Rezé, Jooml!C - All rights reserved
 *
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Cyril Rezé (Lyr!C)
 * @link        http://www.joomlic.com
 *
 * @themepack	ic_rounded
 * @template	events
 * @version		3.3.1 2014-03-14
 * @since       3.2.8
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();?>


<?php // List of Events Template ?>

	<?php // START Event ?>
	<div class="event">

		<?php // START Date Box with Event Image as background ?>
		<?php if ($EVENT_NEXT): ?>

		<?php // Link to Event ?>
		<a href="<?php echo $EVENT_URL; ?>" alt="<?php echo $EVENT_TITLE; ?>">

		<?php // If no Event Image set ?>
		<?php if (!$EVENT_IMAGE): ?>
		<div class="ic-box-date">
			<div class="ic-date">

				<?php // Day ?>
				<div class="ic-day">
					<?php echo $EVENT_DAY; ?>
				</div>

				<?php // Month ?>
				<div class="ic-month">
					<?php echo $EVENT_MONTHSHORT; ?>
				</div>

				<?php // Year ?>
				<div class="ic-year">
					<?php echo $EVENT_YEAR; ?>
				</div>

				<?php // No Image ?>
				<div class="ic-no-image">
					<?php echo JTEXT::_('COM_ICAGENDA_EVENTS_NOIMAGE'); ?>
				</div>

			</div>
		</div>
		<?php endif; ?>

		<?php // In case of Event Image ?>
		<?php if ($EVENT_IMAGE): ?>
		<div class="ic-box-date" style="background:url(<?php echo $EVENT_IMAGE; ?>) no-repeat center center; background-size: cover; border: 1px solid <?php echo $CATEGORY_COLOR; ?>">
			<div class="ic-date">

				<?php // Day ?>
				<div class="ic-day">
					<?php echo $EVENT_DAY; ?>
				</div>

				<?php // Month ?>
				<div class="ic-month">
					<?php echo $EVENT_MONTHSHORT; ?>
				</div>

				<?php // Year ?>
				<div class="ic-year">
					<?php echo $EVENT_YEAR; ?>
				</div>

			</div>
		</div>
		<?php endif; ?>

		</a>
		<?php endif; ?><?php // END Date Box ?>

		<?php // START Right Content ?>
		<div class="ic-content">

			<?php // Header (Title/Category) of the event ?>
			<div class="eventtitle ic-clearfix">

				<?php // Title of the event ?>
				<div class="title-header ic-float-left">
					<h2>
						<a href="<?php echo $EVENT_URL; ?>" alt="<?php echo $EVENT_TITLE; ?>"><?php echo $EVENT_TITLEBAR; ?></a>
					</h2>
				</div>

				<?php // Category ?>
				<div class="title-cat ic-float-right <?php if ($CATEGORY_FONTCOLOR == 'fontColor') : ?>ic-text-border<?php endif; ?>"
					style="color:<?php echo $CATEGORY_COLOR; ?>;">
					<?php echo $CATEGORY_TITLE; ?>
				</div>
				<!--div class="title-cat">
					<i class="icTip icon-folder-3 caticon <?php echo $CATEGORY_FONTCOLOR; ?>" style="background:<?php echo $CATEGORY_COLOR; ?>" title="<?php echo $CATEGORY_TITLE; ?>"></i> <?php echo $CATEGORY_TITLE; ?>
				</div-->

			</div>
			<div style="clear:both"></div>

			<?php // Next Date ('next' 'today' or 'last date' if no next date) ?>
			<?php if ($EVENT_DATE): ?>
			<div class="nextdate">
				<strong><?php echo $EVENT_DATE; ?></strong>
			</div>
			<?php endif; ?>

			<?php // Location (different display, depending on the fields filled) ?>
			<?php if ($EVENT_VENUE OR $EVENT_CITY): ?>
			<div class="place">

				<?php // Place name ?>
				<?php if ($EVENT_VENUE): ?><?php echo $EVENT_VENUE;?><?php endif; ?>

				<?php // If Place Name exists and city set (Google Maps). Displays Country if set. ?>
				<?php if ($EVENT_CITY AND $EVENT_VENUE): ?>
					<span> - </span>
					<?php echo $EVENT_CITY;?><?php if ($EVENT_COUNTRY): ?>, <?php echo $EVENT_COUNTRY;?><?php endif; ?>
				<?php endif; ?>

				<?php // If Place Name doesn't exist and city set (Google Maps). Displays Country if set. ?>
				<?php if ($EVENT_CITY AND !$EVENT_VENUE): ?>
					<?php echo $EVENT_CITY;?><?php if ($EVENT_COUNTRY): ?>, <?php echo $EVENT_COUNTRY;?><?php endif; ?>
				<?php endif; ?>

			</div>
			<?php endif; ?>

			<?php // Short Description ?>
			<?php if ($EVENT_DESC): ?>
			<div class="descshort">
				<?php echo $EVENT_DESCSHORT ; ?><?php echo $READ_MORE ; ?>
			</div>
			<?php endif; ?>

			<?php // + infos Text ?>
			 <div class="moreinfos">
			 	<a href="<?php echo $EVENT_URL; ?>" alt="<?php echo $EVENT_TITLE; ?>">
			 		<?php echo JTEXT::_('COM_ICAGENDA_EVENTS_MORE_INFO'); ?>
			 	</a>
			 </div>

		</div><?php // END Right Content ?>
		<div style="clear:both"></div>

	</div>

<?php // END Event ?>
