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
 * default Official Theme Pack
 *
 * @template	event_registration
 * @version 	3.3.7
 *
-->

<?php // Header of Registration page ?>
<div>

	<?php // Show event ?>
	<div class="event">
		<table class="table">
			<tr class="table">

				<?php // Show icon (left-box) ?>
				<td class="leftbox">
				<?php if ($EVENT_NEXT): ?>
					<div class="box_date">
						<img src="media/com_icagenda/images/registration-48.png" alt="">
					</div>
				</td>
				<?php endif; ?>

				<?php // Show Event Details (right-box) ?>
				<td class="ic-content">
					<div>

						<?php // Category ?>
						<span class="cat"><?php echo $CATEGORY_TITLE; ?> </span>

						<?php // Event Title with link to event ?>
						<h2>
							<a href="<?php echo $EVENT_URL; ?>" alt="<?php echo $EVENT_TITLE; ?>"><?php echo $EVENT_TITLE; ?></a>
						</h2>

					</div>
					<?php // Cleaning the DIV ?>
					<div class="clr"></div>
				</td>
			</tr>
		</table>

		<?php // Add Registration infos (places left) ?>
		<div class="reginfos">
			<?php if ($SEATS_AVAILABLE): ?><?php echo JTEXT::_('COM_ICAGENDA_REGISTRATION_PLACES_LEFT');  ?>: <?php echo $SEATS_AVAILABLE; ?><?php endif; ?>
		</div>


	</div>

</div>
