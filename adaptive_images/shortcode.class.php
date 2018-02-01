<?php
/**
 * Class AdaptiveImages
 * Select different images for desktop,tablet and mobile devices
 * For desktop you can insert video instead of image
 * Also it's possible define image block height
 *
 */

class AdaptiveImages {

    protected $path; // shortcode path
    private $shortcode_name = 'adaptive_image';

    public function __construct()
    {
        $this->path = get_stylesheet_directory_uri().'/vc_shortcodes/adaptive_images/';
    }

    /**
     * VC element initialisation
     *
     */
    public function init(){
        add_shortcode($this->shortcode_name, array($this, 'shortcode'));
        $this->config();
        wp_enqueue_style('vc-adaptive-image', $this->path.'assets/style.css');
    }

    /*
     * Configure vc element
     *
     */
    protected function config()
    {
        vc_map(
            array(
                "name" => __("Adaptive image", "fruitful"),
                "base" => $this->shortcode_name,
                "icon" => "icon_vc_button",
                "category" => __('Fruitful', "fruitful"),
                "description" => __('Create adaptive image element with different images for desktop, tablet, mobile.', 'fruitful'),
                "params" => array(
                        array(
                        "type" => "attach_image",
                        "heading" => __("Desktop image.", "fruitful"),
                        "param_name" => "image_desktop",
                        "description" => __("Image will display on desktop.", "fruitful")
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Video link for desktop", "fruitful"),
                        "param_name" => "video_link",
                        "description" => __("Link for video on desktop.", "fruitful")
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Tablet image.", "fruitful"),
                        "param_name" => "image_tablet",
                        "description" => __("Image will display on tablet. If image is not selected, here will be displayed desktop image.", "fruitful")
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Mobile image.", "fruitful"),
                        "param_name" => "image_mobile",
                        "description" => __("Image will display on mobile. If image is not selected, here will be displayed tablet or desktop image.", "fruitful")
                    ),
                    array(
                        "type" => "checkbox",
                        "heading" => __("Full height.", "fruitful"),
                        "param_name" => "image_full_height",
                        "description" => __("If checked image will have full height.", "fruitful")
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra class name", "fruitful"),
                        "param_name" => "el_class",
                        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "fruitful")
                    ),
                )
            )
        );
    }

    /**
     * Create shortcode output
     *
     * @param array $atts - shortcode parameters
     * @return string
     */
    public function shortcode($atts = array())
    {
        $atts = vc_map_get_attributes($this->shortcode_name, $atts);
        extract($atts);

        // if !isset image for desktop
        $image_desktop = (empty($image_desktop))?(empty($image_tablet))?$image_mobile:$image_tablet:$image_desktop;

        $image_mobile_url = (!empty($image_mobile))?wp_get_attachment_url($image_mobile):false;
        $image_tablet_url = (!empty($image_tablet))?wp_get_attachment_url($image_tablet):false;
        $image_desktop_url = (!empty($image_desktop))?wp_get_attachment_url($image_desktop):false;

        $video = get_video_url($video_link);
        ob_start();
        include 'template.php';
        return ob_get_clean();
    }
}
