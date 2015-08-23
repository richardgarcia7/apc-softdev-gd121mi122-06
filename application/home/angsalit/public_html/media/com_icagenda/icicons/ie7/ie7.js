/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referring to this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'iCicons\'">' + entity + '</span>' + html;
	}
	var icons = {
		'iCicon-iclogo': '&#xe606;',
		'iCicon-location': '&#xe605;',
		'iCicon-calendar': '&#xe604;',
		'iCicon-calendar-2': '&#xe603;',
		'iCicon-print': '&#xe602;',
		'iCicon-disk': '&#xe607;',
		'iCicon-people': '&#xe60b;',
		'iCicon-private': '&#xe608;',
		'iCicon-register': '&#xe609;',
		'iCicon-timezone': '&#xe601;',
		'iCicon-earth': '&#xe600;',
		'iCicon-blocked': '&#xe60a;',
		'iCicon-nextic': '&#x25b6;',
		'iCicon-backic': '&#x25c0;',
		'iCicon-backicY': '&#x25c1;',
		'iCicon-nexticY': '&#x25b7;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/iCicon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
