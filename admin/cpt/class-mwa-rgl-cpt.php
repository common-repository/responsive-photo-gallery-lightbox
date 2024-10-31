<?php
/**
 * The plugin page view - the "Custom Post Type For Gallery" page of the plugin.
 *
 * @package responsive-gallery-lightbox
 */

defined('ABSPATH') or die();

if(!class_exists('MWA_RGL_CPT_CLS')){

	class MWA_RGL_CPT_CLS{

		public static function create_cpt_func(){
				$labels = array(
				'name'                  => esc_html_x( 'All Galleries', 'Post Type General Name', MWA_RESP_GALLERY ),
				'singular_name'         => esc_html_x( 'All Galleries', 'Post Type Singular Name', MWA_RESP_GALLERY ),
				'menu_name'             => esc_html__( 'All Galleries', MWA_RESP_GALLERY ),
				'name_admin_bar'        => esc_html__( 'All Galleries', MWA_RESP_GALLERY ),
				'archives'              => esc_html__( 'All Galleries Archives', MWA_RESP_GALLERY ),
				'attributes'            => esc_html__( 'All Galleries Attributes', MWA_RESP_GALLERY ),
				'all_items'             => esc_html__( 'All Galleries', MWA_RESP_GALLERY ),
				'add_new_item'          => esc_html__( 'Add New Gallery', MWA_RESP_GALLERY ),
				'add_new'               => esc_html__( 'Add New Gallery', MWA_RESP_GALLERY ),
				'new_item'              => esc_html__( 'New Gallery', MWA_RESP_GALLERY ),
				'edit_item'             => esc_html__( 'Edit Gallery', MWA_RESP_GALLERY ),
				'update_item'           => esc_html__( 'Update Gallery', MWA_RESP_GALLERY ),
				'view_item'             => esc_html__( 'View Gallery', MWA_RESP_GALLERY ),
				'view_items'            => esc_html__( 'View Gallery', MWA_RESP_GALLERY ),
				'search_items'          => esc_html__( 'Search Gallery', MWA_RESP_GALLERY ),
				'not_found'             => esc_html__( 'Not found', MWA_RESP_GALLERY ),
				'not_found_in_trash'    => esc_html__( 'Not found in Trash', MWA_RESP_GALLERY ),
				'items_list'            => esc_html__( 'Gallery list', MWA_RESP_GALLERY ),
				'items_list_navigation' => esc_html__( 'Gallery list navigation', MWA_RESP_GALLERY ),
				'filter_items_list'     => esc_html__( 'Filter Gallery list', MWA_RESP_GALLERY ),
			);
			$args = array(
				'label'               => esc_html__( 'All Galleries', MWA_RESP_GALLERY ),
				'labels'              => $labels,
				'supports'            => array( 'title' ),
				'hierarchical'        => true,
				'public'              => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'menu_icon'           => esc_url(MWA_RESP_GAL_URL.'assets/images/respgallogo.png'),
				'menu_position'       => 28,
				'show_in_admin_bar'   => false,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'capability_type'     => 'page',
				'map_meta_cap'        => true,
				'rewrite'             => array( 'slug' => 'rglgallery' )			
			);
			register_post_type( 'mwarglplug', $args );
		}
	}
}