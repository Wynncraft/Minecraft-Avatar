<?php

/*
Title:      Minecraft Avatar
URL:        http://github.com/jamiebicknell/Minecraft-Avatar
Author:     Jamie Bicknell
Twitter:    @jamiebicknell
*/

require_once('functions.php');

$size = isset($_GET['s']) ? max(8, min(250, $_GET['s'])) : 48;
$user = isset($_GET['u']) ? $_GET['u'] : 'char';
$view = isset($_GET['v']) ? substr($_GET['v'], 0, 1) : 'f';
$view = in_array($view, array('f', 'l', 'r', 'b')) ? $view : 'f';

$skin = get_skin($user);

$im = imagecreatefromstring($skin);
$av = imagecreatetruecolor($size, $size);

$x = array('f' => 8, 'l' => 16, 'r' => 0, 'b' => 24);

imagecopyresized($av, $im, 0, 0, $x[$view], 8, $size, $size, 8, 8);         // Face
imagecolortransparent($im, imagecolorat($im, 63, 0));                       // Black Hat Issue
imagecopyresized($av, $im, 0, 0, $x[$view] + 32, 8, $size, $size, 8, 8);    // Accessories

header('Content-type: image/png');
imagepng($av);
imagedestroy($im);
imagedestroy($av);
