<?php
//add special styling to NightFINDERtm and SmartVIEWtm
add_filter('the_title','cf_custom_branding_filter');
add_filter('the_content','cf_custom_branding_filter');

function cf_custom_branding_filter($content){
    $content = preg_replace('/NightFINDER/i','<span style="text-transform:capitalize">Night</span><span style="text-transform:uppercase">FINDER</span>',$content);
    $content = preg_replace('/SmartVIEW/i','<span style="text-transform:capitalize">Smart</span><span style="text-transform:uppercase">VIEW</span>',$content);
    return $content;
}
