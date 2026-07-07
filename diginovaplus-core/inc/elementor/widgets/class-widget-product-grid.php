<?php
/**
 * Elementor Widget: Product Grid
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DigiNova_Plus_Widget_Product_Grid extends \Elementor\Widget_Base {

	public function get_name() {
		return 'diginovaplus_product_grid';
	}

	public function get_title() {
		return __( 'DigiNova Product Grid', 'diginovaplus' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return array( 'diginovaplus-elements' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Query Settings', 'diginovaplus' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => __( 'Posts Per Page', 'diginovaplus' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 6,
			)
		);

		$this->add_control(
			'columns',
			array(
				'label'   => __( 'Columns', 'diginovaplus' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => array(
					'2' => '2 Columns',
					'3' => '3 Columns',
					'4' => '4 Columns',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = array(
			'post_type'      => 'diginovaplus_products',
			'posts_per_page' => $settings['posts_per_page'],
			'post_status'    => 'publish',
		);

		$query = new \WP_Query( $args );

		$col_class = 'col-lg-4';
		if ( '2' === $settings['columns'] ) {
			$col_class = 'col-lg-6';
		} elseif ( '4' === $settings['columns'] ) {
			$col_class = 'col-lg-3';
		}

		if ( $query->have_posts() ) :
			echo '<div class="row g-4">';
			while ( $query->have_posts() ) :
				$query->the_post();
				echo '<div class="col-md-6 ' . esc_attr( $col_class ) . '">';
				get_template_part( 'template-parts/product/product', 'card' );
				echo '</div>';
			endwhile;
			echo '</div>';
			wp_reset_postdata();
		else :
			echo '<div class="alert alert-info">' . esc_html__( 'No products found.', 'diginovaplus' ) . '</div>';
		endif;
	}
}
