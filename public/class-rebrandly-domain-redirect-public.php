<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Rebrandly_Domain_Redirect
 * @subpackage Rebrandly_Domain_Redirect/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rebrandly_Domain_Redirect
 * @subpackage Rebrandly_Domain_Redirect/public
 * @author     Rebrandly Devs <dev@rebrandly.com>
 */
class Rebrandly_Domain_Redirect_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rebrandly_domain_redirect    The ID of this plugin.
	 */
	private $rebrandly_domain_redirect;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $rebrandly_domain_redirect       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $rebrandly_domain_redirect, $version ) {

		$this->rebrandly_domain_redirect = $rebrandly_domain_redirect;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rebrandly_Domain_Redirect_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rebrandly_Domain_Redirect_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->rebrandly_domain_redirect, plugin_dir_url( __FILE__ ) . 'css/rebrandly-domain-redirect-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rebrandly_Domain_Redirect_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rebrandly_Domain_Redirect_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->rebrandly_domain_redirect, plugin_dir_url( __FILE__ ) . 'js/rebrandly-domain-redirect-public.js', array( 'jquery' ), $this->version, false );

	}

	public function rebrandly_aliasing_fallback() {
		if(is_404()){
			global $wp_query;
			$options = get_option( 'rebrandly_aliasing_options', NULL);
			$alias = $options["alias"];

			// not configured yet, skip
			if (empty($alias)) {
				return;
			}
			

			// loop prevention (original query param is rb.routing.mode but . gets translated into _)
			if ($_GET['rb_routing_mode'] == 'aliasing')
			{
				return;
			}
			add_query_arg('rb.routing.mode', 'aliasing');

			$fallback_url = "https://" . $alias . $_SERVER[REQUEST_URI];
			$http_temporary_redirect = 302;
			$x_redirect_by = 'rebrandly';
			wp_redirect( $fallback_url, $http_temporary_redirect, $x_redirect_by);
			exit;
		}
	}

}
