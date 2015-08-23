<?php
/**
 *------------------------------------------------------------------------------
 *  iCagenda - iCthumb
 *------------------------------------------------------------------------------
 * @package     com_icagenda
 * @copyright   Copyright (c)2012-2014 Cyril Rezé, Jooml!C - All rights reserved
 *
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 * @author      Cyril Rezé (Lyr!C)
 * @link        http://www.joomlic.com
 *
 * @version     3.3.6 2014-05-13
 * @since       3.0
 *------------------------------------------------------------------------------
*/

// No direct access to this file
defined('_JEXEC') or die();

// Create thumbnail image by php
function createthumb($source_image,$destination_image_url, $get_width, $get_height, $get_quality){
    ini_set('memory_limit','512M');
    set_time_limit(0);

    $image_array	= explode('/',$source_image);
    $image_name		= $image_array[count($image_array)-1];
    $max_width		= $get_width;
    $max_height		= $get_height;
    $quality		= $get_quality;

    //Set image ratio
    list($width, $height) = getimagesize($source_image);
    $ratio = ($width > $height) ? $max_width/$width : $max_height/$height;
    $ratiow = $width/$max_width ;
    $ratioh = $height/$max_height;
    $ratio = ($ratiow > $ratioh) ? $max_width/$width : $max_height/$height;

    if($width > $max_width || $height > $max_height) {
        $new_width = $width * $ratio;
        $new_height = $height * $ratio;
    } else {
        $new_width = $width;
        $new_height = $height;
    }

    if (preg_match("/.jpg/i","$source_image") or preg_match("/.jpeg/i","$source_image")) {
        //JPEG type thumbnail
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($source_image);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagejpeg($image_p, $destination_image_url, $quality);
        imagedestroy($image_p);

    } elseif (preg_match("/.png/i", "$source_image")){
        //PNG type thumbnail
        $im = imagecreatefrompng($source_image);
        $image_p = imagecreatetruecolor ($new_width, $new_height);
        imagealphablending($image_p, false);
        imagecopyresampled($image_p, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagesavealpha($image_p, true);
        imagepng($image_p, $destination_image_url);

    } elseif (preg_match("/.gif/i", "$source_image")){
        //GIF type thumbnail
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromgif($source_image);
        $bgc = imagecolorallocate ($image_p, 255, 255, 255);
        imagefilledrectangle ($image_p, 0, 0, $new_width, $new_height, $bgc);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagegif($image_p, $destination_image_url, $quality);
        imagedestroy($image_p);

    } else {
        echo 'unable to load image source';
        //exit;
    }
}

function icImageCreateFromBMP($filename)
{
 //Ouverture du fichier en mode binaire
	if (! $f1 = fopen($filename,"rb")) return FALSE;

 //1 : Chargement des entêtes FICHIER
	$FILE = unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1,14));
	if ($FILE['file_type'] != 19778) return FALSE;

 //2 : Chargement des entêtes BMP
	$BMP = unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel'.
				  '/Vcompression/Vsize_bitmap/Vhoriz_resolution'.
				  '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1,40));
	$BMP['colors'] = pow(2,$BMP['bits_per_pixel']);
	if ($BMP['size_bitmap'] == 0) $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
	$BMP['bytes_per_pixel'] = $BMP['bits_per_pixel']/8;
	$BMP['bytes_per_pixel2'] = ceil($BMP['bytes_per_pixel']);
	$BMP['decal'] = ($BMP['width']*$BMP['bytes_per_pixel']/4);
	$BMP['decal'] -= floor($BMP['width']*$BMP['bytes_per_pixel']/4);
	$BMP['decal'] = 4-(4*$BMP['decal']);
	if ($BMP['decal'] == 4) $BMP['decal'] = 0;

 //3 : Chargement des couleurs de la palette
	$PALETTE = array();
	if ($BMP['colors'] < 16777216 && $BMP['colors'] != 65536)
	{
		$PALETTE = unpack('V'.$BMP['colors'], fread($f1,$BMP['colors']*4));
	}

 //4 : Création de l'image
	$IMG = fread($f1,$BMP['size_bitmap']);
	$VIDE = chr(0);

	$res = imagecreatetruecolor($BMP['width'],$BMP['height']);
	$P = 0;
	$Y = $BMP['height']-1;
	while ($Y >= 0)
	{
		$X=0;
		while ($X < $BMP['width'])
		{
			if ($BMP['bits_per_pixel'] == 24)
				$COLOR = unpack("V",substr($IMG,$P,3).$VIDE);

			elseif ($BMP['bits_per_pixel'] == 16)
			{
				$COLOR = unpack("v",substr($IMG,$P,2));
				$blue  = ($COLOR[1] & 0x001f) << 3;
				$green = ($COLOR[1] & 0x07e0) >> 3;
				$red   = ($COLOR[1] & 0xf800) >> 8;
				$COLOR[1] = $red * 65536 + $green * 256 + $blue;
			}
			elseif ($BMP['bits_per_pixel'] == 8)
			{
				$COLOR = unpack("n",$VIDE.substr($IMG,$P,1));
				$COLOR[1] = $PALETTE[$COLOR[1]+1];
			}
			elseif ($BMP['bits_per_pixel'] == 4)
			{
				$COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
				if (($P*2)%2 == 0) $COLOR[1] = ($COLOR[1] >> 4) ; else $COLOR[1] = ($COLOR[1] & 0x0F);
				$COLOR[1] = $PALETTE[$COLOR[1]+1];
			}
			elseif ($BMP['bits_per_pixel'] == 1)
			{
				$COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
				if     (($P*8)%8 == 0) $COLOR[1] =  $COLOR[1]        >>7;
				elseif (($P*8)%8 == 1) $COLOR[1] = ($COLOR[1] & 0x40)>>6;
				elseif (($P*8)%8 == 2) $COLOR[1] = ($COLOR[1] & 0x20)>>5;
				elseif (($P*8)%8 == 3) $COLOR[1] = ($COLOR[1] & 0x10)>>4;
				elseif (($P*8)%8 == 4) $COLOR[1] = ($COLOR[1] & 0x8)>>3;
				elseif (($P*8)%8 == 5) $COLOR[1] = ($COLOR[1] & 0x4)>>2;
				elseif (($P*8)%8 == 6) $COLOR[1] = ($COLOR[1] & 0x2)>>1;
				elseif (($P*8)%8 == 7) $COLOR[1] = ($COLOR[1] & 0x1);
				$COLOR[1] = $PALETTE[$COLOR[1]+1];
			}
			else
				return FALSE;
			imagesetpixel($res,$X,$Y,$COLOR[1]);
			$X++;
			$P += $BMP['bytes_per_pixel'];
		}
		$Y--;
		$P+=$BMP['decal'];
	}

 //Fermeture du fichier
	fclose($f1);

	return $res;
}



function url_exists($url) {
	$a_url = parse_url($url);
	if (!isset($a_url['port'])) $a_url['port'] = 80;
	$errno = 0;
	$errstr = '';
	$timeout = 30;
	if(isset($a_url['host']) && $a_url['host']!=gethostbyname($a_url['host'])){
		$fid = fsockopen($a_url['host'], $a_url['port'], $errno, $errstr, $timeout);
		if (!$fid) return false;
		$page = isset($a_url['path']) ?$a_url['path']:'';
		$page .= isset($a_url['query'])?'?'.$a_url['query']:'';
		fputs($fid, 'HEAD '.$page.' HTTP/1.0'."\r\n".'Host: '.$a_url['host']."\r\n\r\n");
		$head = fread($fid, 4096);
		fclose($fid);
		return preg_match('#^HTTP/.*\s+[200|302]+\s#i', $head);
	} else {
		return false;
	}
}


/**
 * Transliteration (convert foreign and special characters to their ASCII equivalent)
 *
 * @access public static
 * @param string $string The to transliterate.
 * @return string The filtered text.
 */
function translit($string) {
  $search = array(
      'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ă', 'Ą',
      'Ç', 'Ć', 'Č',
      'Ď', 'Đ',
      'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ă', 'ą',
      'ç', 'ć', 'č',
      'ď', 'đ',
      'È', 'É', 'Ê', 'Ë', 'Ę', 'Ě',
      'Ğ',
      'Ì', 'Í', 'Î', 'Ï', 'İ',
      'Ĺ', 'Ľ', 'Ł',
      'è', 'é', 'ê', 'ë', 'ę', 'ě',
      'ğ',
      'ì', 'í', 'î', 'ï', 'ı',
      'ĺ', 'ľ', 'ł',
      'Ñ', 'Ń', 'Ň',
      'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ő', 'Œ',
      'Ŕ', 'Ř',
      'Ś', 'Ş', 'Š',
      'ñ', 'ń', 'ň',
      'ò', 'ó', 'ô', 'ö', 'ø', 'ő', 'œ',
      'ŕ', 'ř',
      'ś', 'ş', 'š',
      'Ţ', 'Ť',
      'Ù', 'Ú', 'Û', 'Ų', 'Ü', 'Ů', 'Ű',
      'Ý', 'ß',
      'Ź', 'Ż', 'Ž',
      'ţ', 'ť',
      'ù', 'ú', 'û', 'ų', 'ü', 'ů', 'ű',
      'ý', 'ÿ',
      'ź', 'ż', 'ž',
      'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р',
      'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'р',
      'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
      'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
      '$', '€', '£'
  );

  $replace = array(
      'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'A', 'A',
      'C', 'C', 'C',
      'D', 'D',
      'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'a', 'a',
      'c', 'c', 'c',
      'd', 'd',
      'E', 'E', 'E', 'E', 'E', 'E',
      'G',
      'I', 'I', 'I', 'I', 'I',
      'L', 'L', 'L',
      'e', 'e', 'e', 'e', 'e', 'e',
      'g',
      'i', 'i', 'i', 'i', 'i',
      'l', 'l', 'l',
      'N', 'N', 'N',
      'O', 'O', 'O', 'O', 'O', 'O', 'O', 'OE',
      'R', 'R',
      'S', 'S', 'S',
      'n', 'n', 'n',
      'o', 'o', 'o', 'o', 'o', 'o', 'oe',
      'r', 'r',
      's', 's', 's',
      'T', 'T',
      'U', 'U', 'U', 'U', 'U', 'U', 'U',
      'Y', 'Y',
      'Z', 'Z', 'Z',
      't', 't',
      'u', 'u', 'u', 'u', 'u', 'u', 'u',
      'y', 'y',
      'z', 'z', 'z',
      'A', 'B', 'B', 'r', 'A', 'E', 'E', 'X', '3', 'N', 'N', 'K', 'N', 'M', 'H', 'O', 'N', 'P',
      'a', 'b', 'b', 'r', 'a', 'e', 'e', 'x', '3', 'n', 'n', 'k', 'n', 'm', 'h', 'o', 'p',
      'C', 'T', 'Y', 'O', 'X', 'U', 'u', 'W', 'W', 'b', 'b', 'b', 'E', 'O', 'R',
      'c', 't', 'y', 'o', 'x', 'u', 'u', 'w', 'w', 'b', 'b', 'b', 'e', 'o', 'r',
      'USD', 'EUR', 'GBP'
  );

  return str_replace($search, $replace, $string);
}

/**
 * Rewrite a text to its URL compatible equivalent.
 *
 * @access public static
 * @param string $string The text to convert.
 * @return string The converted URL.
 */
function cleanString($string, $charset = 'UTF-8') {
  $string = htmlspecialchars_decode($string); // ie: &amp; to &
  $string = translit($string); // ie: é to e
  $string = preg_replace('/[^A-Za-z0-9]+/', '-', $string); // ie: _ to -
  $string = trim($string, '-'); // ie: -string- to string
//  $string = mb_strtolower($string); // ie: E to e
  $string = strtolower($string); // ie: E to e

  return $string;
}

?>
