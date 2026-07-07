<?php
/**
 * Elementor Widget: Categories Grid
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DigiNova_Plus_Widget_Categories extends \Elementor\Widget_Base {

	public function get_name() {
		return 'diginovaplus_categories';
	}

	public function get_title() {
		return __( 'DigiNova Categories', 'diginovaplus' );
	}

	public function get_icon() {
		return 'eicon-product-categories';
	}

	public function get_categories() {
		return array( 'diginovaplus-elements' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Categories', 'diginovaplus' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'hide_empty',
			array(
				'label'        => __( 'Hide Empty Categories', 'diginovaplus' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'diginovaplus' ),
				'label_off'    => __( 'No', 'diginovaplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = array(
			'taxonomy'   => 'diginovaplus_category',
			'hide_empty' => 'yes' === $settings['hide_empty'],
		);

		$categories = get_terms( $args );

		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
			echo '<div class="row g-4">';
			foreach ( $categories as $category ) :
				?>
				<div class="col-6 col-md-4 col-lg-3">
					<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="card h-100 border-0 shadow-sm text-center text-decoration-none hover-lift category-card bg-white p-4 rounded-4 transition-all group">
						<div class="card-body">
							<div class="icon-wrapper bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 transition-all group-hover-bg-primary group-hover-text-white" style="width: 64px; height: 64px;">
								<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
							</div>
							<h3 class="h6 fw-bold text-dark mb-1"><?php echo esc_html( $category->name ); ?></h3>
							<span class="text-muted small"><?php echo esc_html( $category->count ); ?> <?php esc_html_e( 'Items', 'diginovaplus' ); ?></span>
						</div>
					</a>
				</div>
				<?php
			endforeach;
			echo '</div>';
		else :
			echo '<div class="alert alert-info">' . esc_html__( 'No categories found.', 'diginovaplus' ) . '</div>';
		endif;
	}
}
