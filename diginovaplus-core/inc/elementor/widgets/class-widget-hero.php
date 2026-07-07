<?php
/**
 * Elementor Widget: Hero
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DigiNova_Plus_Widget_Hero extends \Elementor\Widget_Base {

	public function get_name() {
		return 'diginovaplus_hero';
	}

	public function get_title() {
		return __( 'DigiNova Hero', 'diginovaplus' );
	}

	public function get_icon() {
		return 'eicon-h-tag';
	}

	public function get_categories() {
		return array( 'diginovaplus-elements' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'diginovaplus' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'diginovaplus' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Discover Premium Digital Products', 'diginovaplus' ),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'   => __( 'Subtitle', 'diginovaplus' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'High-quality themes, templates, and plugins.', 'diginovaplus' ),
			)
		);

		$this->add_control(
			'show_search',
			array(
				'label'        => __( 'Show Search Form', 'diginovaplus' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'diginovaplus' ),
				'label_off'    => __( 'Hide', 'diginovaplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'hero_layout',
			array(
				'label'   => __( 'Layout Style', 'diginovaplus' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'saas',
				'options' => array(
					'saas'        => __( 'SaaS Style', 'diginovaplus' ),
					'marketplace' => __( 'Marketplace Style', 'diginovaplus' ),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// We could use our existing template parts by passing args, or render directly here
		if ( 'saas' === $settings['hero_layout'] ) {
			// A simplified SaaS hero render based on our template
			?>
			<div class="hero-saas bg-primary text-white py-5 position-relative overflow-hidden">
				<div class="container py-5 position-relative z-2">
					<div class="row align-items-center">
						<div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
							<h1 class="display-4 fw-bold mb-4"><?php echo wp_kses_post( $settings['title'] ); ?></h1>
							<p class="lead mb-4 text-white-50"><?php echo esc_html( $settings['subtitle'] ); ?></p>
							<?php if ( 'yes' === $settings['show_search'] ) : ?>
								<form class="search-form d-flex mx-auto mx-lg-0 max-w-sm" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<input type="hidden" name="post_type" value="diginovaplus_products">
									<div class="input-group input-group-lg shadow-sm">
										<input type="search" name="s" class="form-control border-0 px-4" placeholder="<?php esc_attr_e( 'Search products...', 'diginovaplus' ); ?>">
										<button class="btn btn-light px-4 fw-medium text-primary" type="submit"><?php esc_html_e( 'Search', 'diginovaplus' ); ?></button>
									</div>
								</form>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		} else {
			// Marketplace style
			?>
			<div class="hero-marketplace bg-light py-5 py-lg-6 text-center">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<h1 class="display-4 fw-bold mb-4 text-dark"><?php echo wp_kses_post( $settings['title'] ); ?></h1>
							<p class="lead mb-5 text-muted"><?php echo esc_html( $settings['subtitle'] ); ?></p>
							<?php if ( 'yes' === $settings['show_search'] ) : ?>
								<form class="search-form max-w-md mx-auto" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<input type="hidden" name="post_type" value="diginovaplus_products">
									<div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden bg-white p-1">
										<input type="search" name="s" class="form-control border-0 px-4 bg-transparent shadow-none" placeholder="<?php esc_attr_e( 'Search themes, templates, plugins...', 'diginovaplus' ); ?>">
										<button class="btn btn-primary rounded-pill px-4 fw-medium" type="submit"><?php esc_html_e( 'Search', 'diginovaplus' ); ?></button>
									</div>
								</form>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
