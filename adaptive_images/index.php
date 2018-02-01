<?php

if (class_exists('WPBakeryShortCode')) {

}
include 'shortcode.class.php';
include 'functions.php';


add_action('init', array('AdaptiveImages', 'init'));