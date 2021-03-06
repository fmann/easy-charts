<?php
/**
 * Markup file for metabox
 *
 *HTML markup for preview metabox.
 *
 * @link       http://kiranpotphode.com
 * @since      1.0.0
 *
 * @package    Easy_Charts
 * @subpackage Easy_Charts/admin/partials
 */

	global $post;
	$plugin = new Easy_Charts();
?>

<div id="easy-charts-preview-metabox-wrap">
	<div id="easy-chart-preview-box">
		<?php
			$chart_data = get_post_meta( $post->ID, '_easy_charts_chart_data', true );
			$chart_data = json_decode( $chart_data );

			if( $chart_data == null ){
				_e('Please click "Update chart data" and save chart for preview.','easy-charts');
			}

			$translation_array = array(
				'chart_data' => $chart_data,
				'chart_id' => $post->ID
			);

			wp_localize_script( 'easy-charts-admin-js', 'ec_chart', $translation_array );
			wp_enqueue_script( 'easy-charts-admin-js' );

			echo $plugin->ec_render_chart($post->ID);
		?>
	</div>
</div>
