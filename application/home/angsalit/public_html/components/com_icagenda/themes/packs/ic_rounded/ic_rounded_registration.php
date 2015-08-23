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
 * @template	event_registration
 * @version 	3.3.3 2014-04-12
 * @since       2.0
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die(); ?>

<!--
 *
 * iCagenda by Jooml!C
 * ic_rounded Theme Pack
 *
 * @template	event_registration
 * @version 	3.3.7
 *
-->

<?php // Header of Registration page ?>

	<div class="eventtitle">

		<?php // Title - Header ?>
		<div class="title-header">
			<h3>
				<?php if ($EVENT_NEXT): ?>
				<span style="padding:10px">
					<img src="media/com_icagenda/images/registration-48.png" alt="">
				</span>
				<?php endif; ?>
				<a href="<?php echo $EVENT_URL; ?>" alt="<?php echo $EVENT_TITLE; ?>"><?php echo $EVENT_TITLE; ?></a>
			</h3>
		</div>

		<?php // Category - Header ?>
		<div class="title-cat">
			<span style="color:<?php echo $CATEGORY_COLOR; ?>;">
				<?php echo $CATEGORY_TITLE; ?>
			</span>
		</div>

		<?php // Tickets Left - Header ?>
		<?php if ($SEATS_AVAILABLE): ?>
		<div class="reginfos">
			<?php echo JTEXT::_('COM_ICAGENDA_REGISTRATION_PLACES_LEFT');  ?>: <?php echo $SEATS_AVAILABLE; ?>
		</div>
		<?php endif; ?>

	</div>

<?php // END Header ?>
