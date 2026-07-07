<?php
/**
 * Product Reviews System
 *
 * @package DigiNova_Plus_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DigiNova_Plus_Reviews {

	public function __construct() {
		add_action( 'wp_ajax_diginovaplus_submit_review', array( $this, 'submit_review' ) );
		add_action( 'wp_ajax_nopriv_diginovaplus_submit_review', array( $this, 'submit_review' ) );
	}

	public function submit_review() {
		check_ajax_referer( 'diginovaplus-nonce', 'security' );

		$post_id = isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0;
		$rating  = isset( $_POST['rating'] ) ? absint( $_POST['rating'] ) : 0;
		$review  = isset( $_POST['review'] ) ? sanitize_textarea_field( wp_unslash( $_POST['review'] ) ) : '';

		if ( ! $post_id || ! $rating || $rating < 1 || $rating > 5 ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Invalid data provided.', 'diginovaplus-core' ) ) );
		}

		if ( ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => esc_html__( 'You must be logged in to submit a review.', 'diginovaplus-core' ) ) );
		}

		$user_id = get_current_user_id();

		// Check if user already reviewed this product
		$existing_review = get_comments( array(
			'post_id' => $post_id,
			'user_id' => $user_id,
			'meta_key' => 'diginovaplus_rating',
		) );

		if ( ! empty( $existing_review ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'You have already reviewed this product.', 'diginovaplus-core' ) ) );
		}

		$time = current_time( 'mysql' );
		$data = array(
			'comment_post_ID'      => $post_id,
			'comment_author'       => wp_get_current_user()->display_name,
			'comment_author_email' => wp_get_current_user()->user_email,
			'comment_content'      => $review,
			'comment_type'         => 'review',
			'comment_parent'       => 0,
			'user_id'              => $user_id,
			'comment_date'         => $time,
			'comment_approved'     => 1, // Auto approve or set to 0 to require moderation
		);

		$comment_id = wp_insert_comment( $data );

		if ( $comment_id ) {
			add_comment_meta( $comment_id, 'diginovaplus_rating', $rating );
			
			// Update average rating
			$this->update_average_rating( $post_id );

			wp_send_json_success( array( 'message' => esc_html__( 'Review submitted successfully!', 'diginovaplus-core' ) ) );
		} else {
			wp_send_json_error( array( 'message' => esc_html__( 'Failed to submit review.', 'diginovaplus-core' ) ) );
		}
	}

	private function update_average_rating( $post_id ) {
		$comments = get_comments( array(
			'post_id' => $post_id,
			'status'  => 'approve',
			'type'    => 'review',
		) );

		if ( empty( $comments ) ) {
			update_post_meta( $post_id, '_diginovaplus_average_rating', 0 );
			update_post_meta( $post_id, '_diginovaplus_review_count', 0 );
			return;
		}

		$total_rating = 0;
		$count = 0;

		foreach ( $comments as $comment ) {
			$rating = get_comment_meta( $comment->comment_ID, 'diginovaplus_rating', true );
			if ( $rating ) {
				$total_rating += absint( $rating );
				$count++;
			}
		}

		if ( $count > 0 ) {
			$average = round( $total_rating / $count, 1 );
			update_post_meta( $post_id, '_diginovaplus_average_rating', $average );
			update_post_meta( $post_id, '_diginovaplus_review_count', $count );
		}
	}
}

new DigiNova_Plus_Reviews();
