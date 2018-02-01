<?php

?>
<div class="adaptive-images <?php echo $el_class; ?> <?php if($image_full_height) echo 'full-height'; ?>">
    <?php if (!empty($video)) {?>
        <iframe src="<?php echo $video; ?>"></iframe>
    <?php } ?>
    <picture>
        <?php if (!empty($image_mobile_url)) {?>
            <source media="(max-width: 480px)" srcset="<?php echo $image_mobile_url; ?>">
        <?php } ?>
        <?php if (!empty($image_tablet_url)) {?>
            <source media="(max-width: 768px)" srcset="<?php echo $image_tablet_url; ?>">
        <?php } ?>
        <?php if (!empty($image_desktop_url)) {?>
            <img src="<?php echo $image_desktop_url; ?>">
        <?php } ?>
    </picture>
</div>
