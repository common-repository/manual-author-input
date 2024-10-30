<?php
 * Feature Name:	Post Boxes
 * Version:			0.1
 * Author:			Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

if ( ! class_exists( 'Manual_Author_Input_Box' ) ) {

	class Manual_Author_Input_Box extends Manual_Author_Input {

		/**
		 * Tab holder
		 *
		 * @since	0.1
		 * @access	public
		 * @var		array
		 */
		public $tabs = array();
		
		/**
		 * Instance holder
		 *
		 * @since	0.1
		 * @access	private
		 * @static
		 * @var		NULL | Manual_Author_Input_Box
		 */
		private static $instance = NULL;
		
		/**
		 * Method for ensuring that only one instance of this object is used
		 *
		 * @since	0.1
		 * @access	public
		 * @static
		 * @return	Manual_Author_Input_Box
		 */
		public static function get_instance() {
				
			if ( ! self::$instance )
				self::$instance = new self;
				
			return self::$instance;
		}
		
		/**
		 * Setting up some data, initialize translations and start the hooks
		 *
		 * @since	0.1
		 * @access	public
		 * @uses	is_admin, add_filter
		 * @return	void
		 */
		public function __construct() {
			
			if ( is_admin() ) {
			
		}
		 * Changing the authors name and url
		 * @since	0.1
		 * @access	public
		 * @uses	is_admin, get_post_meta
		 * @return	string author name
		 */
			if ( '' != get_post_meta( $post->ID, 'mai_author_url', TRUE ) )
				$return_name = '<a href="' . get_post_meta( $post->ID, 'mai_author_url', TRUE ) . '">' . $return_name . '</a>';
		 * add the meta box
		 *
		 * @since	0.1
		 * @access	public
		 * @uses	add_meta_box, __
		 * @return	void
		 */
		 * display the meta box
		 *
		 * @since	0.1
		 * @access	public
		 * @uses	_e, get_post_meta
		 * @return	void
		 */
			<table class="form-table">
				<tr>
					<th><label for="mai_author"><?php _e( 'Author Name', parent::$textdomain ); ?></label></th>
					<td>
						<input type="text" name="mai_author" id="mai_author" value="<?php echo get_post_meta( $post->ID, 'mai_author', TRUE ); ?>" />
					</td>
				</tr>
			</table>
			<?php
		 * Saves the post meta
		 *
		 * @access	public
		 * @since	0.1
		 * @uses	DOING_AUTOSAVE, current_user_can, update_post_meta
		 * @return	void
		 */
		public function save_meta_data() {
		
			// Preventing Autosave, we don't want that
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
				return;
		
			if ( 'post' != get_post_type( $_POST[ 'ID' ] ) )
				return;
		
			// Check permissions
			if ( ! current_user_can( 'edit_posts', $_POST[ 'ID' ] ) )
				return;
			if ( ! isset( $_POST[ 'mai_author_url' ] ) )
			update_post_meta( $_POST[ 'ID' ], 'mai_author', $_POST[ 'mai_author' ] );
}

// Kickoff
if ( function_exists( 'add_filter' ) )
	Manual_Author_Input_Box::get_instance();