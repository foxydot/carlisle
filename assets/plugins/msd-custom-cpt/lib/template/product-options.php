<?php
$applications = get_terms( array(
    'taxonomy' => 'application',
    'hide_empty' => false,
    'order_by' => 'term_id'
) );
global $wpalchemy_media_access;
?>
<div class="msdlab_meta_control" id="msdlab_meta_control">
    <div class="table">
    <div class="cell file">
        <label>PDF Wiring</label>
        <div class="input_container">
            <?php $mb->the_field('pdf-wiring-main'); ?>
            <?php $group_name = 'pdf-wiring-main'; ?>
            <?php $wpalchemy_media_access->setGroupName($group_name)->setInsertButtonLabel('Insert This')->setTab('gallery'); ?>
            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
            <?php echo $wpalchemy_media_access->getButton(array('label' => '+')); ?>
        </div>
    </div>
    <div class="cell file">
        <label>PDF Drawing Specifications</label>
        <div class="input_container">
            <?php $mb->the_field('pdf-spec-main'); ?>
            <?php $group_name = 'pdf-spec-main'; ?>
            <?php $wpalchemy_media_access->setGroupName($group_name)->setInsertButtonLabel('Insert This')->setTab('gallery'); ?>
            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
            <?php echo $wpalchemy_media_access->getButton(array('label' => '+')); ?>
        </div>
    </div>
    <div class="cell file">
        <label>PDF Product Brochure</label>
        <div class="input_container">
            <?php $mb->the_field('pdf-brochure-main'); ?>
            <?php $group_name = 'pdf-brochure-main'; ?>
            <?php $wpalchemy_media_access->setGroupName($group_name)->setInsertButtonLabel('Insert This')->setTab('gallery'); ?>
            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
            <?php echo $wpalchemy_media_access->getButton(array('label' => '+')); ?>
        </div>
    </div>
    <div class="cell">
        <h2>Images for Carousel</h2>
    </div>
    <?php $s=1; ?>
    <?php while($mb->have_fields_and_multi('carousel')): ?>
    <?php $mb->the_group_open(); ?>
    <div id="carousel_<?php print $s; ?>" class="carousel_<?php print $s; ?>">
        <div class="cell file">
            <label>Carousel Image <?php print $s; ?></label>
            <div class="input_container">
                <?php $mb->the_field('background-image'); ?>
                <?php if($mb->get_the_value() != ''){
                    $thumb_array = wp_get_attachment_image_src( get_attachment_id_from_src($mb->get_the_value()), 'thumbnail' );
                    $thumb = $thumb_array[0];
                    $fieldclass = "hidden";
                } else {
                    $thumb = WP_PLUGIN_URL.'/msd-specialty-pages/lib/img/spacer.gif';
                    $fieldclass = "";
                } ?>
                <img class="background-preview-img" src="<?php print $thumb; ?>">
                <?php $group_name = 'background-img-'. $mb->get_the_index(); ?>
                <?php $wpalchemy_media_access->setGroupName($group_name)->setInsertButtonLabel('Insert This')->setTab('gallery'); ?>
                <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value(), 'class' => $fieldclass)); ?>
                <?php echo $wpalchemy_media_access->getButton(array('label' => '+', 'class' => $fieldclass)); ?>
                <?php if($mb->get_the_value() != ''){ ?>
                    <a href="#" class="dodelete button">Remove Image</a>
                <?php } ?>
             </div>
        </div>
    </div>
    <?php $s++; ?>
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    <div class="row">
        <div class="cell">
            <a href="#" class="docopy-carousel button alignright">Add Image</a>
        </div>
    </div>
    <h2>Product Content By Application</h2>
    <?php $ctr = 0; ?>
    <?php while($mb->have_fields('applications',count($applications))): ?>
    <?php $mb->the_group_open(); ?>
    <?php $application = $applications[$ctr]; ?>
    <?php $section_name = $application->name; ?>
    <?php $section_slug = $application->slug; ?>
    <div id="<?php print $section_slug; ?>" class="msdlab_section row <?php print $ctr%2==1?'even':'odd'; ?>">
        <h2 class="section_handle <?php print $ctr%2==1?'even':'odd'; ?>"><span><?php print $section_name; ?></span></h2>
        <div class="section_data">
        <div class="content-area box">
            <div class="cell">
                <?php $mb->the_field('content-area-title'); ?>
                <label>Title</label>            
                <div class="input_container">
                    <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                </div>
            </div>
            <div class="cell">
                <?php $mb->the_field('content-area-subtitle'); ?>
                <label>Subtitle</label>            
                <div class="input_container">
                    <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                </div>
            </div>
            <div class="cell column-1">
                <label>Content</label>
                <div class="input_container">
                    <?php 
                    $mb->the_field('content-area-content');
                    $mb_content = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
                    $mb_editor_id = sanitize_key($mb->get_the_name());
                    $mb_settings = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '5',);
                    wp_editor( $mb_content, $mb_editor_id, $mb_settings );
                    ?>
               </div>
            </div>
            <div class="cell file">
                <label>Feature Image</label>
                <div class="input_container">
                    <?php $mb->the_field('feature-image'); ?>
                    <?php if($mb->get_the_value() != ''){
                        $thumb_array = wp_get_attachment_image_src( get_attachment_id_from_src($mb->get_the_value()), 'thumbnail' );
                        $thumb = $thumb_array[0];
                    } else {
                        $thumb = WP_PLUGIN_URL.'/msd-specialty-pages/lib/img/spacer.gif';
                    } ?>
                    <img class="content-area-preview-img" src="<?php print $thumb; ?>">
                    <?php $group_name = 'content-area-feature-img-'. $mb->get_the_index(); ?>
                    <?php $wpalchemy_media_access->setGroupName($group_name)->setInsertButtonLabel('Insert This')->setTab('gallery'); ?>
                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                    <?php echo $wpalchemy_media_access->getButton(array('label' => '+')); ?>
                </div>
            </div>
            <div class="cell file">
                <label>PDF Wiring</label>
                <div class="input_container">
                    <?php $mb->the_field('pdf-wiring'); ?>
                    <?php $group_name = 'pdf-wiring-'. $mb->get_the_index(); ?>
                    <?php $wpalchemy_media_access->setGroupName($group_name)->setInsertButtonLabel('Insert This')->setTab('gallery'); ?>
                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                    <?php echo $wpalchemy_media_access->getButton(array('label' => '+')); ?>
                </div>
            </div>
            <div class="cell file">
                <label>PDF Drawing Specifications</label>
                <div class="input_container">
                    <?php $mb->the_field('pdf-spec'); ?>
                    <?php $group_name = 'pdf-spec-'. $mb->get_the_index(); ?>
                    <?php $wpalchemy_media_access->setGroupName($group_name)->setInsertButtonLabel('Insert This')->setTab('gallery'); ?>
                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                    <?php echo $wpalchemy_media_access->getButton(array('label' => '+')); ?>
                </div>
            </div>
            <div class="cell file">
                <label>PDF Product Brochure</label>
                <div class="input_container">
                    <?php $mb->the_field('pdf-brochure'); ?>
                    <?php $group_name = 'pdf-brochure-'. $mb->get_the_index(); ?>
                    <?php $wpalchemy_media_access->setGroupName($group_name)->setInsertButtonLabel('Insert This')->setTab('gallery'); ?>
                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                    <?php echo $wpalchemy_media_access->getButton(array('label' => '+')); ?>
                </div>
            </div>
        </div>
        </div>
    </div>
    <?php $ctr++; ?>
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    </div>
</div>
