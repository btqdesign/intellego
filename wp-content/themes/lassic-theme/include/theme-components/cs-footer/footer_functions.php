<?php
//=================================================
//@Categories Mega Menus
//=================================================
if (!class_exists('cs_mega_menu_walker')) { 
	class cs_mega_menu_walker extends Walker_Nav_Menu {
		private $CurrentItem, $CategoryMenu, $menu_style;
		function cs_menu_start(){
			$sub_class = $last ='';
			$count_menu_posts = 0;
			$mega_menu_output = '';
		}
		function start_lvl( &$output, $depth = 0, $args = array(), $id=0 ) {
			$indent = str_repeat("\t", $depth);
			$bg =$this->CurrentItem->bg;
			$output .= $this->cs_menu_start();
			if( $this->CurrentItem->megamenu == 'on' && $depth == 0){
 					$output .= "\n$indent<ul class=\"mega-grid\" >\n";	
  			} else {
				$output .= "\n$indent<ul class=\"sub-dropdown\">\n";
			}
		}
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul> <!--End Sub Menu -->\n";
			
			if( $this->CurrentItem->megamenu == 'on' && $depth == 0){
			}
		}
		function start_el(&$output, $item, $depth = 0, $args = array() , $id = 0) {
			global $wp_query;
 			$this->CurrentItem = $item;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			if($depth == 0){
				$class_names = $value = '';
				$mega_menu = 'dropdown sub-menu cs-mega-menu';
			} else if($args->has_children){
				$class_names = $value = '';
				$mega_menu = 'dropdown parentIcon  cs-sub-menu';
			} else {
				$class_names = $value = $mega_menu = '';
			}
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
  			if($item->object == 'page' && empty($item->menu_item_parent) or $item->object == 'custom'){
 				if( $this->CurrentItem->megamenu== 'on' ){
					$mega_menu = 'mega-menu';
					if( $this->CurrentItem->megamenu == 'on'){
						$mega_menu = 'dropdown mega-menu cs-mega-menu';
					}
					if( $this->CurrentItem->megamenu == 'on' &&  isset($category_options['menu_style']) && $category_options['menu_style'] == 'Category Post'){
						$mega_menu = 'dropdown mega-menu-v2';
					}
					if ( empty($args->has_children) ) $mega_menu .= ' full-mega-menu';
				} else {
					$mega_menu = 'dropdown sub-menu';
				}
			}
			$class_names = join( " $mega_menu ", apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'. esc_attr( sanitize_html_class($class_names) ) . '"';
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
 			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			if( $this->CurrentItem->link != 'on'){
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			}
			$item_output = $args->before;
			
			if( $this->CurrentItem->text != 'on'){
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= $args->link_after;
				$item_output .= '</a>';
			}
			
			$item_output .= ! empty( $item->description )     ? ' <p>' . esc_attr( $item->description ) .'</p>' : '';
			$item_output .= $args->after;
			if( !empty($mega_menu) && empty($args->has_children) && $this->CurrentItem->megamenu == 'on' ){	
				$item_output .= $this->cs_menu_start();
			}
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
		}
		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
	}
}

/**
 * @Top and Main Navigation
 *
 *
 */
if ( ! function_exists( 'cs_navigation' ) ) {
	function cs_navigation($nav='', $menus = 'menus', $menu_class = '', $depth='0'){
		global $cs_theme_options;	
		if ( has_nav_menu( $nav ) ) {
			if (class_exists('cs_mega_menu_walker')) {
				$defaults = array(
				'theme_location' => "$nav",
				'menu' => '',
				'container' => '',
				'container_class' => '',
				'container_id' => '',
				'menu_class' => "$menu_class",
				'menu_id' => "$menus",
				'echo' => false,
				'fallback_cb' => 'wp_page_menu',
				'before' => '',
				'after' => '',
				'link_before' => '',
				'link_after' => '',
				'items_wrap' => '<ul class="%1$s">%3$s</ul>',
				'depth' => "$depth",
				'walker' => new cs_mega_menu_walker());
	
				} else {
					
				$defaults = array(

					'theme_location' => "$nav",
					'menu' => '',
					'container' => '',
					'container_class' => '',
					'container_id' => '',
					'menu_class' => "$menu_class",
					'menu_id' => "$menus",
					'echo' => false,
					'fallback_cb' => 'wp_page_menu',
					'before' => '',
					'after' => '',
					'link_before' => '',
					'link_after' => '',
					'items_wrap' => '<ul class="%1$s">%3$s</ul>',
					'depth' => "$depth",
					'walker' => '',);
			}
			echo do_shortcode(wp_nav_menu($defaults));
		} else {
			
			
				$defaults = array(
				'theme_location' => "",
				'menu' => '',
				'container' => '',
				'container_class' => '',
				'container_id' => '',
				'menu_class' => "$menu_class",
				'menu_id' => "$menus",
				'echo' => false,
				'fallback_cb' => 'wp_page_menu',
				'before' => '',
				'after' => '',
				'link_before' => '',
				'link_after' => '',
				'items_wrap' => '<ul class="%1$s">%3$s</ul>',
				'depth' => "$depth",
				'walker' => '',);
	
			echo do_shortcode(str_replace('sub-menu', 'sub-dropdown',(wp_nav_menu($defaults))));
		}
		
	}
}

/** 
 * @Main navigation
 *
 *
 */
if ( ! function_exists( 'cs_footer_navigation' ) ) {
function cs_footer_navigation($nav=''){
		global $post,$cs_xmlObject;
		// check post type using post id
		$post_type = get_post_type(get_the_ID());
		if(is_page()){
			$meta_element = 'cs_page_builder';
		} else if(is_single() && $post_type != 'post'){
			$meta_element = 'dynamic_cusotm_post';
		} else {
			$meta_element = 'post';
		}
		$post_meta = get_post_meta(get_the_ID(), "$meta_element", true);
		if ( $post_meta <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_meta);
		}
		if ( empty($cs_xmlObject->page_custom_menu) ) $page_custom_menu = ""; else $page_custom_menu = $cs_xmlObject->page_custom_menu;
		if($page_custom_menu != '' && $page_custom_menu != 'default'){
			cs_navigation("$page_custom_menu",'navbar-nav');
		} else {
			cs_navigation('footer-menu','navbar-nav');	
		}
	}
}

/** 
 * @ Default Main Menu
 *
 *
 */
function cs_footer_navigation($nav='',$class=''){
	$id = rand(1,99);
	echo '<nav class="navigation'.$class.'">
			<a class="cs-click-menu"><i class="icon-list8"></i></a>
			  ';
				cs_footer_navigation($nav);
			echo '
          </nav>';	
}