<?php
/**
 * AJAX Handler for Products Filter
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DigiNova_Plus_Ajax_Handler {

	public function __construct() {
		add_action( 'wp_ajax_diginovaplus_filter_products', array( $this, 'filter_products' ) );
		add_action( 'wp_ajax_nopriv_diginovaplus_filter_products', array( $this, 'filter_products' ) );
	}

	public function filter_products() {
		check_ajax_referer( 'diginovaplus-nonce', 'security' );

		$paged     = isset( $_GET['paged'] ) ? absint( $_GET['paged'] ) : 1;
		$view_mode = isset( $_GET['view_mode'] ) ? sanitize_text_field( wp_unslash( $_GET['view_mode'] ) ) : 'grid';
		$search    = isset( $_GET['search'] ) ? sanitize_text_field( wp_unslash( $_GET['search'] ) ) : '';
		$orderby   = isset( $_GET['orderby'] ) ? sanitize_text_field( wp_unslash( $_GET['orderby'] ) ) : 'newest';
		$min_price = isset( $_GET['min_price'] ) ? floatval( $_GET['min_price'] ) : '';
		$max_price = isset( $_GET['max_price'] ) ? floatval( $_GET['max_price'] ) : '';
		$rating    = isset( $_GET['rating'] ) ? floatval( $_GET['rating'] ) : '';
		
		$categories = isset( $_GET['categories'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['categories'] ) ) : array();
		$types      = isset( $_GET['types'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['types'] ) ) : array();

		$args = array(
			'post_type'      => 'diginovaplus_products',
			'post_status'    => 'publish',
			'posts_per_page' => 9,
			'paged'          => $paged,
		);

		// Search
		if ( ! empty( $search ) ) {
			$args['s'] = $search;
		}

		// Taxonomies
		$tax_query = array( 'relation' => 'AND' );

		if ( ! empty( $categories ) ) {
			$tax_query[] = array(
				'taxonomy' => 'diginovaplus_category',
				'field'    => 'slug',
				'terms'    => $categories,
			);
		}

		if ( ! empty( $types ) ) {
			$tax_query[] = array(
				'taxonomy' => 'diginovaplus_software_type',
				'field'    => 'slug',
				'terms'    => $types,
			);
		}

		if ( count( $tax_query ) > 1 ) {
			$args['tax_query'] = $tax_query;
		}

		// Meta Queries (Price, Rating)
		$meta_query = array( 'relation' => 'AND' );

		if ( $min_price !== '' || $max_price !== '' ) {
			$price_query = array(
				'key'  => '_diginovaplus_regular_price',
				'type' => 'NUMERIC',
			);
			if ( $min_price !== '' && $max_price !== '' ) {
				$price_query['value']   = array( $min_price, $max_price );
				$price_query['compare'] = 'BETWEEN';
			} elseif ( $min_price !== '' ) {
				$price_query['value']   = $min_price;
				$price_query['compare'] = '>=';
			} elseif ( $max_price !== '' ) {
				$price_query['value']   = $max_price;
				$price_query['compare'] = '<=';
			}
			$meta_query[] = $price_query;
		}

		if ( ! empty( $rating ) ) {
			$meta_query[] = array(
				'key'     => '_diginovaplus_average_rating',
				'value'   => $rating,
				'type'    => 'NUMERIC',
				'compare' => '>=',
			);
		}

		if ( count( $meta_query ) > 1 ) {
			$args['meta_query'] = $meta_query;
		}

		// Ordering
		switch ( $orderby ) {
			case 'popular':
				$args['meta_key'] = '_diginovaplus_sales_count'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				$args['orderby']  = 'meta_value_num';
				$args['order']    = 'DESC';
				break;
			case 'rating':
				$args['meta_key'] = '_diginovaplus_average_rating'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				$args['orderby']  = 'meta_value_num';
				$args['order']    = 'DESC';
				break;
			case 'price_low':
				$args['meta_key'] = '_diginovaplus_regular_price'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				$args['orderby']  = 'meta_value_num';
				$args['order']    = 'ASC';
				break;
			case 'price_high':
				$args['meta_key'] = '_diginovaplus_regular_price'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				$args['orderby']  = 'meta_value_num';
				$args['order']    = 'DESC';
				break;
			case 'newest':
			default:
				$args['orderby'] = 'date';
				$args['order']   = 'DESC';
				break;
		}

		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				if ( 'list' === $view_mode ) {
					echo '<div class="col-12 item">';
					get_template_part( 'template-parts/product/product-card', 'list' );
					echo '</div>';
				} else {
					echo '<div class="col-sm-6 col-md-4 item">';
					get_template_part( 'template-parts/product/product', 'card' );
					echo '</div>';
				}
			}
		} else {
			echo '<div class="col-12"><div class="alert alert-info text-center py-5 border-0 bg-white shadow-sm rounded-4">';
			echo '<h4 class="alert-heading fw-bold text-dark mb-3">' . esc_html__( 'No products found', 'diginovaplus' ) . '</h4>';
			echo '<p class="text-muted mb-0">' . esc_html__( 'Try adjusting your filters or search query.', 'diginovaplus' ) . '</p>';
			echo '</div></div>';
		}

		$html = ob_get_clean();

		wp_reset_postdata();

		$total_posts = $query->found_posts;
		$max_pages   = $query->max_num_pages;

		$results_text = sprintf(
			/* translators: 1: Current count, 2: Total count */
			esc_html__( 'Showing %1$s of %2$s products', 'diginovaplus' ),
			$query->post_count,
			$total_posts
		);
		if ( $paged > 1 ) {
			$results_text = sprintf(
				/* translators: 1: Start index, 2: End index, 3: Total count */
				esc_html__( 'Showing %1$s-%2$s of %3$s products', 'diginovaplus' ),
				( $paged - 1 ) * 9 + 1,
				min( $paged * 9, $total_posts ),
				$total_posts
			);
		}

		wp_send_json_success( array(
			'html'         => $html,
			'max_pages'    => $max_pages,
			'results_text' => $results_text,
		) );
	}
}

new DigiNova_Plus_Ajax_Handler();
