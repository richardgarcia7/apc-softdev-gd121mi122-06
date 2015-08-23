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
 * @version     3.3.3 2014-04-20
 * @since       2.0
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();

//JHtml::_('behavior.tooltip');
//JHTML::_('script','system/multiselect.js',false,true);

$user	= JFactory::getUser();
$userId	= $user->get('id');

$db = JFactory::getDbo();
$query	= $db->getQuery(true);
$query->select('version AS icv, releasedate AS icd')->from('#__icagenda')->where('id = 3');
$db->setQuery($query);
$icv=$db->loadObject()->icv;
$version=$icv;
$icd=$db->loadObject()->icd;
$date=$icd;


?>

<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
		<!-- Begin Content -->
		<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid">
					<div class="span6">
						<div class="icpanel" style="background-color:#FFFFFF; border: 1px solid #D4D4D4; padding:10px; border-radius: 10px;">
							<h2 style="font-size:2em; color: Gray; text-align: center">
								<?php echo JText::_('COM_ICAGENDA_PANEL_CONTRIBUTORS');?>
							</h2>
							<!--div>
								<h4 style="color:grey; text-align: center">
									" <?php echo JText::_('COM_ICAGENDA_PANEL_THANKS');?> "
								</h4>
							</div-->
							<div>&nbsp;</div>
							<p style="margin:10px 30px; text-align:center; color: grey;">
								<i>&ldquo; <?php echo JText::_('COM_ICAGENDA_PANEL_THANKS_TEXT'); ?> &rdquo;</i>
							</p>
							<p class="small" style="margin:20px 0px; text-align:justify; color: DimGray;">
								Ervin Bizjak, Bong, Giuseppe Bosco, Carosouza, Davor Čolić, doorknob, Reinhard Ekker, elirezo, jedi, jowe3, JonxDuo, KISweb, kredo9, macedorl, Kai Metsävainio, mussool, NicoDeluxe, Rickard Norberg, Andrzej Opejda, Régis, Tom-Henning, Rikard Tømte Reitan, Vlad Shuh, Leland Vandervort, Wilfred van Dijk, Roland van Wanrooy, ...
							</p>
							<h3><?php echo JText::_('COM_ICAGENDA_PANEL_TRANSLATION');?></h3>
							<div style="margin-left: 20px; padding:0px; color: DimGray;">
	<img src='../media/mod_languages/images/ar.gif' alt="" class='iCflag' /> &nbsp;<b>Arabic (Unitag) :</b> haneen2013 <br />
	<img src='../media/mod_languages/images/eu_es.gif' alt="" class='iCflag' /> &nbsp;<b>Basque (Spain) :</b> Bizkaitarra <br />
	<img src='../media/mod_languages/images/ca.gif' alt="" class='iCflag' /> &nbsp;<b>Catalan (Spain) :</b> mussool <br />
	<img src='../media/mod_languages/images/tw.gif' alt="" class='iCflag' /> &nbsp;<b>Chinese (Taiwan) :</b> jedi <br />
	<img src='../media/mod_languages/images/hr.gif' alt="" class='iCflag' /> &nbsp;<b>Croatian (Croatia) :</b> Davor Čolić, komir <br />
	<img src='../media/mod_languages/images/cz.gif' alt="" class='iCflag' /> &nbsp;<b>Czech (Czech Republic) :</b> Bong <br />
	<img src='../media/mod_languages/images/dk.gif' alt="" class='iCflag' /> &nbsp;<b>Danish (Denmark) :</b> limdul, olewolf.dk, hsindrup <br />
	<img src='../media/mod_languages/images/nl.gif' alt="" class='iCflag' /> &nbsp;<b>Dutch (Netherlands) :</b> Molenwal1, Mario Guagliardo, wfvdijk, Walldorff <br />
	<img src='../media/mod_languages/images/en.gif' alt="" class='iCflag' /> &nbsp;<b>English (United Kingdom) :</b> Lyr!C <br />
	<img src='../media/mod_languages/images/us.gif' alt="" class='iCflag' /> &nbsp;<b>English (United States) :</b> Lyr!C <br />
	<img src='../media/mod_languages/images/et.gif' alt="" class='iCflag' /> &nbsp;<b>Estonian (Estonia) :</b> Eraser, Reijo <br />
	<img src='../media/mod_languages/images/fi.gif' alt="" class='iCflag' /> &nbsp;<b>Finnish (Finland) :</b> Kai Metsävainio <br />
	<img src='../media/mod_languages/images/fr.gif' alt="" class='iCflag' /> &nbsp;<b>French (France) :</b> Lyr!C <br />
	<img src='../media/mod_languages/images/de.gif' alt="" class='iCflag' /> &nbsp;<b>German (Germany) :</b> mPino, Wasilis, bmbsbr, chuerner, jkling, jtraser <br />
	<img src='../media/mod_languages/images/el.gif' alt="" class='iCflag' /> &nbsp;<b>Greek (Greece) :</b> E.Gkana-D.Kontogeorgis (elinag), Wasilis, mbini <br />
	<img src='../media/mod_languages/images/hu.gif' alt="" class='iCflag' /> &nbsp;<b>Hungarian (Hungary) :</b> Halilaci, magicf, tothtibor, 4dzona <br />
	<img src='../media/mod_languages/images/it.gif' alt="" class='iCflag' /> &nbsp;<b>Italian (Italy) :</b> Giuseppe Bosco (giusebos) <br />
	<img src='../media/mod_languages/images/ja.gif' alt="" class='iCflag' /> &nbsp;<b>Japanese (Japan) :</b> nagata, taimai908 <br />
	<img src='../media/mod_languages/images/lv.gif' alt="" class='iCflag' /> &nbsp;<b>Latvian (Latvia) :</b> kredo9 <br />
	<img src='../media/mod_languages/images/lt.gif' alt="" class='iCflag' /> &nbsp;<b>Lithuanian (Lithuania) :</b> ahxoohx <br />
	<img src='../media/mod_languages/images/no.gif' alt="" class='iCflag' /> &nbsp;<b>Norwegian Bokmål (Norway) :</b> Rikard Tømte Reitan (Rikrei) <br />
	<img src='../media/mod_languages/images/pl.gif' alt="" class='iCflag' /> &nbsp;<b>Polish (Poland) :</b> KISweb, gienio22, traktor <br />
	<img src='../media/mod_languages/images/pt_br.gif' alt="" class='iCflag' /> &nbsp;<b>Portuguese (Brazil) :</b> Carosouza <br />
	<img src='../media/mod_languages/images/pt.gif' alt="" class='iCflag' /> &nbsp;<b>Portuguese (Portugal) :</b> LFGM, macedorl, horus68, helfer <br />
	<img src='../media/mod_languages/images/ro.gif' alt="" class='iCflag' /> &nbsp;<b>Romanian (Romania) :</b> hat <br />
	<img src='../media/mod_languages/images/ru.gif' alt="" class='iCflag' /> &nbsp;<b>Russian (Russia) :</b> nshash, MSV <br />
	<img src='../media/mod_languages/images/sr.gif' alt="" class='iCflag' /> &nbsp;<b>Serbian (latin) :</b> Nenad Mihajlović <br />
	<img src='../media/mod_languages/images/sk.gif' alt="" class='iCflag' /> &nbsp;<b>Slovak (Slovakia) :</b> J.Ribarszki <br />
	<img src='../media/mod_languages/images/sl.gif' alt="" class='iCflag' /> &nbsp;<b>Slovenian (Slovenia) :</b> erbi (Ervin Bizjak) <br />
	<img src='../media/mod_languages/images/es.gif' alt="" class='iCflag' /> &nbsp;<b>Spanish (Spain) :</b> elerizo, mPino, adolf64, Goncatín, claugardia <br />
	<img src='../media/mod_languages/images/sv.gif' alt="" class='iCflag' /> &nbsp;<b>Swedish (Sweden) :</b> Rickard Norberg (metska), kricke <br />
	<img src='../media/mod_languages/images/uk.gif' alt="" class='iCflag' /> &nbsp;<b>Ukrainian (Ukraine) :</b> Vlad Shuh (slv54) <br />
							</div>
							<br />
						</div>
					</div>
					<div class="span1">
					</div>
					<div class="span5">
						<div style="float:right; padding:0px 0px 0px 20px;">
							<img src="../administrator/components/com_icagenda/add/image/logo_icagenda.png" alt="iCagenda" />
						</div>
						<div>
							<h2 style="font-size:2em;">
								<b style="color:#cc0000;">iC</b><b style="color: #666666;">agenda<sup style="font-size:0.6em">&trade;</sup></b>&nbsp;<b style="font-size:0.5em;"></b>
							</h2>
						</div>
						<div>
							<h4>
								<?php echo JText::_('COM_ICAGENDA_INFORMATION') ?>
							</h4>
						</div>
						<div>&nbsp;</div>
						<div>&nbsp;</div>
						<div>&nbsp;</div>
						<div>&nbsp;</div>
						<div>&nbsp;</div>
						<div>&nbsp;</div>

						<h3><?php echo JText::_('iCagenda Team');?></h3>
						<p>
							<b><?php echo JText::_('COM_ICAGENDA_PANEL_LEAD_DEVELOPER');?></b><br>
							Cyril Rezé (Lyr!C) | <a href="http://www.joomlic.com" target="_blank">www.joomlic.com</a>
						</p>
						<p>
							<b><?php echo JText::_('COM_ICAGENDA_PANEL_TEAM_1');?></b><br>
							Giuseppe Bosco (giusebos) | <a href="http://www.newideasproject.com/" target="_blank">www.newideasproject.com</a>
						</p>
						<h3><?php echo JText::_('COM_ICAGENDA_VERSION');?></h3>
						<p>
							<?php echo $version ;?>
						</p>
						<h3><?php echo JText::_('COM_ICAGENDA_COPYRIGHT');?></h3>
						<p>
							© 2012 - <?php echo date("Y"); ?> Cyril Rezé<br/>
							<a href="http://www.joomlic.com" target="_blank">www.Jooml!C.com</a>
						</p>
						<h3><?php echo JText::_('COM_ICAGENDA_LICENSE');?></h3>
						<p>
							<a href="http://www.gnu.org/licenses/gpl.html" target="_blank">GPLv3 or later</a>
						</p>

					</div>
				</div>
			</div>
		</div>

		<div class="row-fluid">
			<div class="span12">
				<tbody>
					<table style="border: 0px;">
						<tr>
							<td>
								<a href="http://www.joomlic.com/translations" target="_blank" class="btn">
									<?php echo JText::_('COM_ICAGENDA_PANEL_TRANSLATION_PACKS_DONWLOAD');?>
								</a>
							</td>
							<td>
								<a href='http://www.joomlic.com/forum/icagenda'  target="_blank" class="btn">
									<?php echo JText::_('COM_ICAGENDA_PANEL_HELP_FORUM'); ?>
								</a>
							</td>
						</tr>
					</table>
				</tbody>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div>
		<div class="row-fluid">
			<div class="span12">
				<hr>
				<div class="row-fluid">
					<div class="span9">
						Copyright ©2012-<?php echo date("Y"); ?> joomlic.com -&nbsp;
						<?php echo JText::_('COM_ICAGENDA_PANEL_COPYRIGHT');?>&nbsp;<a href="http://extensions.joomla.org/extensions/calendars-a-events/events/events-management/22013" target="_blank">Joomla! Extensions Directory</a>.
						<br />
						<br />
					</div>
					<div class="span3" style="text-align: right">
						<a href='http://www.joomlic.com' target='_blank'>
							<img src="../media/com_icagenda/images/logo_joomlic.png" alt="JoomliC" border="0"/>
						</a>
						<br />
						<i><b><?php echo JText::_('COM_ICAGENDA_PANEL_SITE_VISIT');?>&nbsp;<a href='http://www.joomlic.com' target='_blank'>www.joomlic.com</a></b></i>
					</div>
				</div>
			</div>
		</div>
	</div>

