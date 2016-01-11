<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://kiranpotphode.wordpress.com/
 * @since      1.0.0
 *
 * @package    Easy_Charts
 * @subpackage Easy_Charts/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Easy_Charts
 * @subpackage Easy_Charts/public
 * @author     Kiran Potphode <kiranpotphode15@gmail.com>
 */
class Easy_Charts_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @TODO  Move shortcode hook to proper location
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
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
		 * defined in Easy_Charts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Charts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easy-charts-public.css', array(), $this->version, 'all' );

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
		 * defined in Easy_Charts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Charts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'easy-charts-public-js', plugin_dir_url( __FILE__ ) . 'js/easy-charts-public.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'd3-js', plugin_dir_url( __FILE__ ) . 'js/d3.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'uvhcharts-js', plugin_dir_url( __FILE__ ) . 'js/uvcharts.min.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add shortcode callback for chart shortcode.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $tag  Shortcode tag to be searched in post content.
	 * @param string 	$content 	Content inside Shortcode enclosing tags. Default is ''.
	 * @return string 	Parsed Shortcode html markup.
	 */
	public static function easy_chart_shortcode_callback( $atts, $content = "" ) {
		$atts = shortcode_atts( array(
			'chart_id' => null
		), $atts, 'easy_chart' );

		extract($atts);

		if( $chart_id ){
			$plugin = new Easy_Charts();
			return $plugin->ec_render_chart( $chart_id );
		}


		return "";
	}

	/**
	 * Register shortcode on init hook.
	 *
	 * @since 1.0.0
	 */
	public function init(){
		add_shortcode('easy_chart', array($this, 'easy_chart_shortcode_callback'));
	}

}
