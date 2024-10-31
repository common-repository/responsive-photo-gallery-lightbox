<?php
/**
 * The plugin Widget Button - For WP Editor on {page or post} handler page.
 *
 * @package responsive-gallery-lightbox
 */
defined( 'ABSPATH' ) or die();

if (! class_exists( 'MWARGLWidgetBtn' )){
	class MWARGLWidgetBtn {	

	/**
	* @return MWARGLWidgetBtn constructor.
	*/	

	public function __construct() {		

		add_action( 'admin_footer', array('MWARGLWidgetBtn','editor_widget_button' ));
		add_action( 'media_buttons', array('MWARGLWidgetBtn','add_media_button' ));
		
	}// end constructor

	public static function add_media_button() {
	    $context	  =  null;
	    $img          =  esc_url(MWA_RESP_GAL_URL.'assets/images/respgallogo.png');
	    $container_id = 'MWARGL';
	    $title        = 'Select Gallery to insert into post';
	    $context      .= '<a class="button button-primary thickbox" title="'.$title.'" href="#TB_inline?width400&inlineId=' . $container_id . '">
		<span class="wp-media-buttons-icon" style="width:23px;background: url(' . $img . '); background-repeat: no-repeat; background-position: left bottom;"></span>
		Photo Gallery</a>';
		printf($context);
	}	

	public static function editor_widget_button(){
		global $wpdb;
		$tbl_name = $wpdb->prefix . "posts";
		$results   = $wpdb->get_results( "SELECT `ID` FROM `$tbl_name` WHERE  post_type LIKE 'mwarglplug' AND `post_status` LIKE 'publish'", OBJECT );
		
		?>
			 <script type="text/javascript">
    				jQuery(document).ready(function () {
		            jQuery('#mwarglinsert').on('click', function () {
		                var id = jQuery('#mwa-rgl-select option:selected').val();
		                window.send_to_editor('<p>[MWA_RGL id=' + id + ']</p>');
		                tb_remove();
		            })
		        });
		    </script>

		     <div id="MWARGL" style="display:none;">
		        <h3><?php esc_html_e( "Select Gallery from gallery list & click insert button", MWA_RESP_GALLERY ); ?></h3> 
		        	<select id="mwa-rgl-select">
		        		<?php
		        			foreach ($results as $res) {
		        				?>
		        					<option value="<?php echo esc_attr($res->ID); ?>"> [MWA_RGL id=<?php echo esc_html($res->ID); ?>]</option>
		        				<?php
		        			}
		        		?>	
		            </select>		          
		            <button class='button button-primary' id='mwarglinsert'>
						<?php esc_html_e( "Insert Photo Gallery Shortcode", MWA_RESP_GALLERY ); ?>
					</button>					
					<?php					
				?>
		    </div>
			<?php
		}
	} // end class MWARGLWidgetBtn		
} // end if class exist MWARGLWidgetBtn