<?php
	const PRJ_BASE = __DIR__;
	const PRJ_NAMESPACE = 'CheesecakePostTypes';
	// Auto loader class
	require_once PRJ_BASE.'/lib/SplClassLoader/SplClassLoader.php';
	require_once PRJ_BASE.'/lib/Twig/Autoloader.php';
	// Loading twig
	Twig_Autoloader::register();
	// Load our classes
	$classLoader = new SplClassLoader(PRJ_NAMESPACE, PRJ_BASE.'/lib');
	$classLoader->register();
	$loader = new Twig_Loader_Filesystem(PRJ_BASE.'/templates');
	$twig = new Twig_Environment($loader, array(
	    'cache' => PRJ_BASE.'/compilation_cache'
	));

	add_action( 'admin_enqueue_scripts', function(){
		wp_register_style( 'custom_wp_admin_css',  get_bloginfo( 'stylesheet_directory' ) . '/'.PRJ_NAMESPACE.'/assets/custom-admin-style.css', false, '1.0.0' );
		wp_enqueue_style( 'custom_wp_admin_css' );
		wp_register_style( 'chosen',  get_bloginfo( 'stylesheet_directory' ) . '/'.PRJ_NAMESPACE.'/assets/chosen/chosen.css', false, '1.0.0' );
		wp_enqueue_style( 'chosen' );
	});

	add_action('admin_enqueue_scripts', function() {
		wp_enqueue_script(
			'chosen',
			get_bloginfo('stylesheet_directory') . '/'.PRJ_NAMESPACE.'/assets/chosen/chosen.jquery.min.js',
			array('jquery')
		);
		wp_enqueue_script(
			'cheesecakePostTypes',
			get_bloginfo('stylesheet_directory') . '/'.PRJ_NAMESPACE.'/assets/js/cheesecakePostTypes.min.js',
			array('jquery')
		);
	});
?>