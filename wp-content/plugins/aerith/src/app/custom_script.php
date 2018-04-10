<?php
namespace app;
class custom_script
{
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts',array ($this, 'custom_script') );

	}

	public function custom_script()
	{	 
	  	wp_enqueue_style( 'aerith_style', plugin_dir_url( __DIR__ ) . 'asset/css/style.css', array(), '1.0', 'all');

		wp_enqueue_style( 'purecss','https://cdnjs.cloudflare.com/ajax/libs/pure/1.0.0/pure-min.css');				
	 
	  	/*wp_enqueue_script( 'script', plugin_dir_url( __DIR__ ) . 'asset/js/script.js', array( 'jquery' ), 1.1, true);*/

	  	wp_enqueue_script( 'script', plugin_dir_url( __DIR__ ) . 'asset/js/slide.js', array( 'jquery' ), '1.1', true);
	}
}
