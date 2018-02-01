<?php

if (!class_exists('WPBakeryShortCode')) {
    return;
}

include 'shortcode.class.php';
include 'functions.php';

add_action('init', 'init_adaptive_image');