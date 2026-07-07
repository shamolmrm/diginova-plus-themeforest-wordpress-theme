<?php
/**
 * Register Meta Boxes for Products
 *
 * @package DigiNova_Plus_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DigiNova_Plus_Meta_Boxes {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_product_meta_boxes' ) );
		add_action( 'save_post_diginovaplus_products', array( $this, 'save_product_meta_data' ) );
	}

	public function add_product_meta_boxes() {
		add_meta_box(
			'diginovaplus_product_details',
			__( 'Product Details', 'diginovaplus-core' ),
			array( $this, 'render_meta_box_content' ),
			'diginovaplus_products',
			'normal',
			'high'
		);
	}

	public function render_meta_box_content( $post ) {
		// Add a nonce field so we can check for it later.
		wp_nonce_field( 'diginovaplus_save_product_meta', 'diginovaplus_product_meta_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$regular_price = get_post_meta( $post->ID, '_diginovaplus_regular_price', true );
		$extended_price = get_post_meta( $post->ID, '_diginovaplus_extended_price', true );
		$sales_count = get_post_meta( $post->ID, '_diginovaplus_sales_count', true );
		$version = get_post_meta( $post->ID, '_diginovaplus_version', true );
		$last_updated = get_post_meta( $post->ID, '_diginovaplus_last_updated', true );
		$demo_url = get_post_meta( $post->ID, '_diginovaplus_demo_url', true );
		$doc_url = get_post_meta( $post->ID, '_diginovaplus_doc_url', true );
		$compatible_with = get_post_meta( $post->ID, '_diginovaplus_compatible_with', true );
		$file_type = get_post_meta( $post->ID, '_diginovaplus_file_type', true );
		$file_size = get_post_meta( $post->ID, '_diginovaplus_file_size', true );
		$high_res = get_post_meta( $post->ID, '_diginovaplus_high_res', true );
		$widget_ready = get_post_meta( $post->ID, '_diginovaplus_widget_ready', true );

		// Display the form, using the current value.
		?>
		<table class="form-table">
			<tr>
				<th><label for="diginovaplus_regular_price"><?php esc_html_e( 'Regular Price ($)', 'diginovaplus-core' ); ?></label></th>
				<td><input type="text" id="diginovaplus_regular_price" name="diginovaplus_regular_price" value="<?php echo esc_attr( $regular_price ); ?>" size="25" /></td>
			</tr>
			<tr>
				<th><label for="diginovaplus_extended_price"><?php esc_html_e( 'Extended License Price ($)', 'diginovaplus-core' ); ?></label></th>
				<td><input type="text" id="diginovaplus_extended_price" name="diginovaplus_extended_price" value="<?php echo esc_attr( $extended_price ); ?>" size="25" /></td>
			</tr>
			<tr>
				<th><label for="diginovaplus_sales_count"><?php esc_html_e( 'Sales Count', 'diginovaplus-core' ); ?></label></th>
				<td><input type="text" id="diginovaplus_sales_count" name="diginovaplus_sales_count" value="<?php echo esc_attr( $sales_count ); ?>" size="25" /></td>
			</tr>
			<tr>
				<th><label for="diginovaplus_version"><?php esc_html_e( 'Software Version', 'diginovaplus-core' ); ?></label></th>
				<td><input type="text" id="diginovaplus_version" name="diginovaplus_version" value="<?php echo esc_attr( $version ); ?>" size="25" /></td>
			</tr>
			<tr>
				<th><label for="diginovaplus_last_updated"><?php esc_html_e( 'Last Updated Date', 'diginovaplus-core' ); ?></label></th>
				<td><input type="date" id="diginovaplus_last_updated" name="diginovaplus_last_updated" value="<?php echo esc_attr( $last_updated ); ?>" /></td>
			</tr>
			<tr>
				<th><label for="diginovaplus_demo_url"><?php esc_html_e( 'Demo URL', 'diginovaplus-core' ); ?></label></th>
				<td><input type="url" id="diginovaplus_demo_url" name="diginovaplus_demo_url" value="<?php echo esc_attr( $demo_url ); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label for="diginovaplus_doc_url"><?php esc_html_e( 'Documentation URL', 'diginovaplus-core' ); ?></label></th>
				<td><input type="url" id="diginovaplus_doc_url" name="diginovaplus_doc_url" value="<?php echo esc_attr( $doc_url ); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label for="diginovaplus_compatible_with"><?php esc_html_e( 'Compatible With', 'diginovaplus-core' ); ?></label></th>
				<td>
					<input type="text" id="diginovaplus_compatible_with" name="diginovaplus_compatible_with" value="<?php echo esc_attr( $compatible_with ); ?>" class="regular-text" />
					<p class="description"><?php esc_html_e( 'E.g., WordPress 6.x, Elementor, PHP 8.x (comma separated)', 'diginovaplus-core' ); ?></p>
				</td>
			</tr>
			<tr>
				<th><label for="diginovaplus_file_type"><?php esc_html_e( 'File Type', 'diginovaplus-core' ); ?></label></th>
				<td><input type="text" id="diginovaplus_file_type" name="diginovaplus_file_type" value="<?php echo esc_attr( $file_type ); ?>" size="25" placeholder="ZIP" /></td>
			</tr>
			<tr>
				<th><label for="diginovaplus_file_size"><?php esc_html_e( 'File Size', 'diginovaplus-core' ); ?></label></th>
				<td><input type="text" id="diginovaplus_file_size" name="diginovaplus_file_size" value="<?php echo esc_attr( $file_size ); ?>" size="25" placeholder="E.g. 5 MB" /></td>
			</tr>
			<tr>
				<th><label for="diginovaplus_high_res"><?php esc_html_e( 'High Resolution', 'diginovaplus-core' ); ?></label></th>
				<td>
					<select name="diginovaplus_high_res" id="diginovaplus_high_res">
						<option value="Yes" <?php selected( $high_res, 'Yes' ); ?>><?php esc_html_e( 'Yes', 'diginovaplus-core' ); ?></option>
						<option value="No" <?php selected( $high_res, 'No' ); ?>><?php esc_html_e( 'No', 'diginovaplus-core' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="diginovaplus_widget_ready"><?php esc_html_e( 'Widget Ready', 'diginovaplus-core' ); ?></label></th>
				<td>
					<select name="diginovaplus_widget_ready" id="diginovaplus_widget_ready">
						<option value="Yes" <?php selected( $widget_ready, 'Yes' ); ?>><?php esc_html_e( 'Yes', 'diginovaplus-core' ); ?></option>
						<option value="No" <?php selected( $widget_ready, 'No' ); ?>><?php esc_html_e( 'No', 'diginovaplus-core' ); ?></option>
					</select>
				</td>
			</tr>
		</table>
		<?php
	}

	public function save_product_meta_data( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['diginovaplus_product_meta_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['diginovaplus_product_meta_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'diginovaplus_save_product_meta' ) ) {
			return $post_id;
		}

		// If this is an autosave, our form has not been submitted,
		// so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( 'diginovaplus_products' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		// Sanitize the user input and save.
		$fields = array(
			'diginovaplus_regular_price'   => 'sanitize_text_field',
			'diginovaplus_extended_price'  => 'sanitize_text_field',
			'diginovaplus_sales_count'     => 'absint',
			'diginovaplus_version'         => 'sanitize_text_field',
			'diginovaplus_last_updated'    => 'sanitize_text_field',
			'diginovaplus_demo_url'        => 'esc_url_raw',
			'diginovaplus_doc_url'         => 'esc_url_raw',
			'diginovaplus_compatible_with' => 'sanitize_text_field',
			'diginovaplus_file_type'       => 'sanitize_text_field',
			'diginovaplus_file_size'       => 'sanitize_text_field',
			'diginovaplus_high_res'        => 'sanitize_text_field',
			'diginovaplus_widget_ready'    => 'sanitize_text_field',
		);

		foreach ( $fields as $field => $sanitization_callback ) {
			if ( isset( $_POST[ $field ] ) ) {
				$value = call_user_func( $sanitization_callback, $_POST[ $field ] );
				update_post_meta( $post_id, '_' . $field, $value );
			}
		}
	}
}

new DigiNova_Plus_Meta_Boxes();
