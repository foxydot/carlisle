<?php 
global $location_info;

$location_info = new WPAlchemy_MetaBox(array
		(
			'id' => '_location_information',
			'title' => 'Location Information',
			'types' => array('location'),
			'context' => 'normal',
			'priority' => 'high',
			'template' => WP_PLUGIN_DIR.'/'.plugin_dir_path('msd-custom-cpt/msd-custom-cpt.php').'lib/template/location-information.php',
			'autosave' => TRUE,
			'mode' => WPALCHEMY_MODE_EXTRACT, // defaults to WPALCHEMY_MODE_ARRAY
			'prefix' => '_location_' // defaults to NULL
		));