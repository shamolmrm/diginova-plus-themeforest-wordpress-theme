<?php
/**
 * Support Ticket System
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DigiNova_Plus_Support_System {

	public function __construct() {
		add_action( 'init', array( $this, 'register_ticket_cpt' ) );
		add_shortcode( 'diginovaplus_support', array( $this, 'support_shortcode' ) );
		add_action( 'wp_ajax_diginovaplus_submit_ticket', array( $this, 'handle_submit_ticket' ) );
	}

	public function register_ticket_cpt() {
		$labels = array(
			'name'                  => _x( 'Tickets', 'Post Type General Name', 'diginovaplus' ),
			'singular_name'         => _x( 'Ticket', 'Post Type Singular Name', 'diginovaplus' ),
			'menu_name'             => __( 'Support Tickets', 'diginovaplus' ),
			'all_items'             => __( 'All Tickets', 'diginovaplus' ),
			'add_new_item'          => __( 'Add New Ticket', 'diginovaplus' ),
			'add_new'               => __( 'Add New', 'diginovaplus' ),
			'new_item'              => __( 'New Ticket', 'diginovaplus' ),
			'edit_item'             => __( 'Edit Ticket', 'diginovaplus' ),
			'update_item'           => __( 'Update Ticket', 'diginovaplus' ),
			'view_item'             => __( 'View Ticket', 'diginovaplus' ),
			'search_items'          => __( 'Search Ticket', 'diginovaplus' ),
		);
		$args = array(
			'label'                 => __( 'Ticket', 'diginovaplus' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'author', 'comments' ),
			'hierarchical'          => false,
			'public'                => false, // Internal Use
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 30,
			'menu_icon'             => 'dashicons-tickets-alt',
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'capability_type'       => 'post',
		);
		register_post_type( 'diginovaplus_ticket', $args );

		// Register Taxonomy for Ticket Status
		register_taxonomy( 'ticket_status', array( 'diginovaplus_ticket' ), array(
			'hierarchical'      => true,
			'labels'            => array(
				'name'              => _x( 'Statuses', 'taxonomy general name', 'diginovaplus' ),
				'singular_name'     => _x( 'Status', 'taxonomy singular name', 'diginovaplus' ),
				'search_items'      => __( 'Search Statuses', 'diginovaplus' ),
				'all_items'         => __( 'All Statuses', 'diginovaplus' ),
				'parent_item'       => __( 'Parent Status', 'diginovaplus' ),
				'parent_item_colon' => __( 'Parent Status:', 'diginovaplus' ),
				'edit_item'         => __( 'Edit Status', 'diginovaplus' ),
				'update_item'       => __( 'Update Status', 'diginovaplus' ),
				'add_new_item'      => __( 'Add New Status', 'diginovaplus' ),
				'new_item_name'     => __( 'New Status Name', 'diginovaplus' ),
				'menu_name'         => __( 'Status', 'diginovaplus' ),
			),
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'ticket-status' ),
		) );
	}

	public function support_shortcode() {
		if ( ! is_user_logged_in() ) {
			return '<div class="alert alert-warning">' . esc_html__( 'Please log in to submit a ticket.', 'diginovaplus' ) . '</div>';
		}

		ob_start();
		?>
		<div class="diginovaplus-support-wrap bg-white p-4 rounded-4 shadow-sm border border-light">
			<h3 class="h5 fw-bold mb-4"><?php esc_html_e( 'Submit a Support Ticket', 'diginovaplus' ); ?></h3>
			<form id="diginovaplus-ticket-form" class="ticket-form">
				<div class="mb-3">
					<label for="ticket_subject" class="form-label fw-medium"><?php esc_html_e( 'Subject', 'diginovaplus' ); ?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control bg-light" id="ticket_subject" name="ticket_subject" required>
				</div>
				<div class="mb-3">
					<label for="ticket_product" class="form-label fw-medium"><?php esc_html_e( 'Related Product', 'diginovaplus' ); ?></label>
					<select class="form-select bg-light" id="ticket_product" name="ticket_product">
						<option value=""><?php esc_html_e( '-- Select Product --', 'diginovaplus' ); ?></option>
						<?php
						$products = get_posts( array(
							'post_type' => 'diginovaplus_products',
							'numberposts' => -1,
							'post_status' => 'publish'
						) );
						foreach ( $products as $product ) {
							echo '<option value="' . esc_attr( $product->ID ) . '">' . esc_html( $product->post_title ) . '</option>';
						}
						?>
					</select>
				</div>
				<div class="mb-4">
					<label for="ticket_message" class="form-label fw-medium"><?php esc_html_e( 'Message', 'diginovaplus' ); ?> <span class="text-danger">*</span></label>
					<textarea class="form-control bg-light" id="ticket_message" name="ticket_message" rows="5" required></textarea>
				</div>
				<input type="hidden" name="action" value="diginovaplus_submit_ticket">
				<?php wp_nonce_field( 'diginovaplus_ticket_nonce', 'ticket_nonce' ); ?>
				<button type="submit" class="btn btn-primary rounded-pill px-4 fw-medium d-flex align-items-center gap-2">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
					<?php esc_html_e( 'Submit Ticket', 'diginovaplus' ); ?>
				</button>
				<div class="ticket-response mt-3"></div>
			</form>
		</div>

		<script>
		document.addEventListener('DOMContentLoaded', function() {
			const form = document.getElementById('diginovaplus-ticket-form');
			if (form) {
				form.addEventListener('submit', function(e) {
					e.preventDefault();
					const responseDiv = form.querySelector('.ticket-response');
					responseDiv.innerHTML = '<div class="spinner-border spinner-border-sm text-primary" role="status"></div> Loading...';
					
					const formData = new FormData(form);
					
					fetch(diginovaplus_ajax.ajaxurl, {
						method: 'POST',
						body: formData
					})
					.then(response => response.json())
					.then(data => {
						if (data.success) {
							responseDiv.innerHTML = '<div class="alert alert-success mt-2">' + data.data.message + '</div>';
							form.reset();
						} else {
							responseDiv.innerHTML = '<div class="alert alert-danger mt-2">' + data.data.message + '</div>';
						}
					})
					.catch(error => {
						responseDiv.innerHTML = '<div class="alert alert-danger mt-2">Error submitting ticket.</div>';
					});
				});
			}
		});
		</script>
		<?php
		return ob_get_clean();
	}

	public function handle_submit_ticket() {
		check_ajax_referer( 'diginovaplus_ticket_nonce', 'ticket_nonce' );

		if ( ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => __( 'You must be logged in.', 'diginovaplus' ) ) );
		}

		$subject = isset( $_POST['ticket_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['ticket_subject'] ) ) : '';
		$message = isset( $_POST['ticket_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['ticket_message'] ) ) : '';
		$product = isset( $_POST['ticket_product'] ) ? absint( wp_unslash( $_POST['ticket_product'] ) ) : 0;

		if ( empty( $subject ) || empty( $message ) ) {
			wp_send_json_error( array( 'message' => __( 'Subject and message are required.', 'diginovaplus' ) ) );
		}

		$ticket_data = array(
			'post_title'   => $subject,
			'post_content' => $message,
			'post_status'  => 'publish',
			'post_type'    => 'diginovaplus_ticket',
			'post_author'  => get_current_user_id(),
		);

		$ticket_id = wp_insert_post( $ticket_data );

		if ( ! is_wp_error( $ticket_id ) ) {
			if ( $product ) {
				update_post_meta( $ticket_id, '_related_product', $product );
			}
			wp_send_json_success( array( 'message' => __( 'Ticket submitted successfully! We will get back to you soon.', 'diginovaplus' ) ) );
		} else {
			wp_send_json_error( array( 'message' => __( 'Failed to submit ticket. Please try again.', 'diginovaplus' ) ) );
		}
	}
}

new DigiNova_Plus_Support_System();
