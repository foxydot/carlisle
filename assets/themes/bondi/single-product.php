<?php
add_action('template_redirect','bondi_path_capture');
function bondi_path_capture(){
    global $application_path;
    if(!isset($_COOKIE['bondi_application_path'])) {
      $application_path = FALSE;
    } else {
      $application_path = $_COOKIE['bondi_application_path'];
    }
}

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action('genesis_after_header','bondi_product_header');
function bondi_product_header(){
    global $post;
    $terms = get_the_terms($post,'product_type');
    $header='Searchlights';
    if(count($terms == 1)){
        $header = get_the_term_list($post,'product_type');
    }
    print apply_filters('product_header','<div class="product-header"><div class="wrap">'.$header.'</div></div>');
}

add_action('genesis_before_entry','bondi_product_main_image',8);
function bondi_product_main_image(){
    global $post;
    //setup thumbnail image args to be used with genesis_get_image();
    $size = 'post-image'; // Change this to whatever add_image_size you want
    $default_attr = array(
            'class' => "attachment-$size $size",
            'alt'   => $post->post_title,
            'title' => $post->post_title,
    );

    // This is the most important part!  Checks to see if the post has a Post Thumbnail assigned to it. You can delete the if conditional if you want and assume that there will always be a thumbnail
    if ( has_post_thumbnail() && is_cpt('product') ) {
        print '<section class="post-image alignright">';
        printf( '%s', genesis_get_image( array( 'size' => $size, 'attr' => $default_attr ) ) );
        print '</section>';
    }
}

remove_action('genesis_entry_header','genesis_post_info',12);

add_action('genesis_entry_footer','bondi_aiming_files');
function bondi_aiming_files(){
    global $product_options,$wpalchemy_media_access;
    global $application_path;
    $product_options->the_meta();
    $types = array('manual' => 'Local Handle Control','remote' => 'Remote Lever Control','joystick' => 'Electric Joystick Control');
    $ret = false;
    foreach($types AS $t => $u){
        if($application_path){
        
        } else {
            $file = $product_options->get_the_value('pdf-'.$t);
            if($file){
                $ret .= '<a class="aiming-button '.$t.'" href="'.$file.'">'.$u.'</a>';
            }
        }
    }
    if($ret){
        print '<div class="aiming-buttons">'.$ret.'</div>';
    }
}

add_action('genesis_entry_footer','bondi_pdf_files');
function bondi_pdf_files(){
    global $product_options,$wpalchemy_media_access;
    global $application_path;
    $product_options->the_meta();
    $types = array('alpha','beta','gamma');
    $ret = false;
    foreach($types AS $t){
        if($application_path){
        
        } else {
            $file = $product_options->get_the_value('pdf-'.$t.'-main');
            if($file){
                $label = $product_options->get_the_value('pdf-'.$t.'-main-label');
                $ret .= '<a class="pdf-button" href="'.$file.'">'.$label.'</a>';
            }
        }
    }
    if($ret){
        print '<div class="pdf-files">'.$ret.'</div>';
    }
}

add_action('genesis_before_footer','bondi_product_carousel',1);
function bondi_product_carousel(){
    global $product_options,$wpalchemy_media_access;
    
    $meta = $product_options->the_meta();
    if(is_object($product_options)){
        $i = 0;
        while($product_options->have_fields('carousel')){
            $img = $product_options->get_the_value('background-image');
            //setup slides
            $active = $i==0?' active':'';
            $slides[$i] = '<div class="item'.$active.'">
                <div class="slide" style="background-image:url('.$img.')">
                </div>
            </div>';
            $i++;
        }
    }
    //if there are slides, wrap them and activate
    if(count($slides)>0){
        $controls = '<!-- Controls -->
          <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
            <span class="fa fa-angle-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
            <span class="fa fa-angle-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>';
        print '<div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">';
        print implode("\n", $slides);
        print '</div>';
        print $controls;
        print '</div>';
    }
}

genesis();
