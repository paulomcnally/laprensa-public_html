<?php
include 'securimage.php';

$img = new securimage();
$img->image_bg_color = "#B01118";
$img->text_color = "#ffffff";
$img->draw_lines = false;
$img->font_size = 16;
$img->text_angle_minimum = -20;
$img->text_angle_maximum = 0;
$img->use_multi_text = false;
$img->arc_linethrough = false;


$img->show(); // alternate use:  $img->show('/path/to/background.jpg');
?>
