<?
$pixels = '{
      "274:130":"000",
      "274:129":"000",
      "274:128":"000",
      "274:127":"000",
      "274:126":"000",
      "274:125":"000"
    }';

$url="https://drawingapp.firebaseio.com/.json?print=pretty&format=export&download=drawingapp-export.json";

$json = file_get_contents($url);
$list = json_decode($json, true);

////#GENERATE MORE DATA

$h = 600;
$w = 300;

$gd = imagecreatetruecolor($h, $w);
// ImageFillToBorder($gd, 0, 0, 0, 255);

$white = imagecolorallocate($gd, 255, 255, 255);
imagefill($gd, 0, 0, $white);


foreach ( $list as $xy => $color ) {
    list($r, $g, $b) = html2rgb($color);
    list($x, $y) = explode(":", $xy);
    $color = imagecolorallocate($gd, $r, $g, $g);
    imagesetpixel($gd, $x, $y, $color);
}
$filename = "drawing";
header('Content-Type: image/png');
        header("Content-Transfer-Encoding: binary");
        header("Content-Disposition: attachment; filename=$filename");

imagepng($gd);

function html2rgb($color) {
    if ($color[0] == '#')
        $color = substr($color, 1);
    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0] . $color[1],$color[2] . $color[3],$color[4] . $color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0] . $color[0],$color[1] . $color[1],$color[2] . $color[2]);
    else
        return false;
    return array(hexdec($r),hexdec($g),hexdec($b));
}

function random_hex_color(){
    return sprintf("%02X%02X%02X", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
}

?>
