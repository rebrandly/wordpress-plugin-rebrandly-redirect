<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Rebrandly_Domain_Redirect
 * @subpackage Rebrandly_Domain_Redirect/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rebrandly_Domain_Redirect
 * @subpackage Rebrandly_Domain_Redirect/admin
 * @author     Rebrandly Devs <dev@rebrandly.com>
 */
class Rebrandly_Domain_Redirect_Admin {

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
	 * @param      string    $rebrandly_domain_redirect       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $rebrandly_domain_redirect, $version ) {

		$this->rebrandly_domain_redirect = $rebrandly_domain_redirect;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->rebrandly_domain_redirect, plugin_dir_url( __FILE__ ) . 'css/rebrandly-domain-redirect-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->rebrandly_domain_redirect, plugin_dir_url( __FILE__ ) . 'js/rebrandly-domain-redirect-admin.js', array( 'jquery' ), $this->version, false );

	}

	function rebrandly_aliasing_add_settings_page() {
		$page_title = 'Rebrandly Aliasing Settings';
		$menu_title = 'Rebrandly';
		$permissions_required = 'manage_options';
		$menu_slug = 'rebrandly-domain-redirect';
		$callback_fn = array($this, 'rebrandly_aliasing_render_settings_page');
		add_options_page( $page_title, $menu_title, $permissions_required, $menu_slug,  $callback_fn);
	}

	function rebrandly_aliasing_render_settings_page() {
		?>
		<h2>Rebrandly settings</h2>
		<form action="options.php" method="post">
			<?php 
			$option_group = 'rebrandly_aliasing_options';
			$page_slug = 'rebrandly-domain-redirect';
			settings_fields( $option_group );
			do_settings_sections( $page_slug ); ?>
			<input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
		</form>
		<?php
	}

	function rebrandly_aliasing_register_settings() {
		$page_slug = 'rebrandly-domain-redirect';

		$option_group = 'rebrandly_aliasing_options';
		$option_name = 'rebrandly_aliasing_options';
		$validation_fn_callback = array($this, 'rebrandly_aliasing_options_validate');
		register_setting( $option_group,  $option_name, $validation_fn_callback);

		$section_slug = 'api_settings';
		$section_title = 'Configure your alias';

		$intro_render_fn_callback = array($this, 'rebrandly_aliasing_section_intro');
		add_settings_section( $section_slug, $section_title, $intro_render_fn_callback, $page_slug );
		
		$alias_field_render_fn_callback = array($this, 'rebrandly_aliasing_plugin_setting_alias');
		add_settings_field('rebrandly_aliasing_plugin_setting_alias', 'Your alias', 
			$alias_field_render_fn_callback, $page_slug, $section_slug);
	}

	function rebrandly_aliasing_section_intro() {
		echo '
			<p>
				Login to your Rebrandly account and connect a domain via aliasing.
				<br>
				Paste here the alias generated by Rebrandly for your domain
			</p>
		';
	}

	function rebrandly_aliasing_plugin_setting_alias() {
		$options = get_option( 'rebrandly_aliasing_options' );
    	echo "
			<input 
				id='rebrandly_aliasing_plugin_setting_alias'
				name='rebrandly_aliasing_options[alias]'
				class='rb-aliasing-alias'
				placeholder='e.g. 46e8ac9583d7e0c513485aef06045733.rebrandly.cc'
				type='text'
				value='" . esc_attr( $options['alias'] ) . "' 
			/>";
	}

	function rebrandly_aliasing_options_validate( $input ) {
		$newinput['alias'] = trim( $input['alias'] );
		return $newinput;
	}

}
