<?php


/**
 * Get video url by link
 * @param null $video_link
 * @return bool|mixed
 */
function get_video_url($video_link = null)
{
    if(empty($video_link)) {
        return false;
    }

    $video_components = parse_url( $video_link);
    parse_str( parse_url( $video_link, PHP_URL_QUERY ), $video_vars );

    // if youtube
    if(strpos($video_components['host'], 'youtube') !== false || strpos($video_components['host'], 'youtu.be') !== false) {
        $link = str_replace('/', '', $video_components['path']);
        $link = str_replace('embed', '', $link);
        if($link == 'watch') $link = $video_vars['v'];
        return 'https://www.youtube.com/embed/'.$link;
        // if vimeo
    } elseif (strpos($video_components['host'], 'vimeo') !== false) {
        $link = str_replace('/', '', $video_components['path']);
        $link = str_replace('video', '', $link);
        return 'https://player.vimeo.com/video/'.$link;
    }
}