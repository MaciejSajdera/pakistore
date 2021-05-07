<?php
/**
 * pakistore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pakistore
 */

if ( ! function_exists( 'pakistore_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pakistore_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on pakistore, use a find and replace
		 * to change 'pakistore' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pakistore', get_template_directory() . '/assets/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'medycznie' ),
				'wooshop' => esc_html__( 'Shop', 'medycznie' ),
				'special-categories-menu' => esc_html__( 'Special Categories Menu', 'medycznie' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'pakistore_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'pakistore_setup' );

 
add_action( 'after_setup_theme', 'woo_addons_setup' );
function woo_addons_setup() {
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pakistore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pakistore_content_width', 640 );
}
add_action( 'after_setup_theme', 'pakistore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pakistore_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pakistore' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pakistore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pakistore_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pakistore_scripts() {
	wp_enqueue_style( 'pakistore-style', get_template_directory_uri() . '/dist/css/style.css' );

	wp_enqueue_script( 'pakistore-app', get_template_directory_uri() . '/dist/js/main.js', array(), '', true );

	if (is_front_page()) {
		wp_enqueue_script( 'pakistore-carousel', get_template_directory_uri() . '/dist/js/carousel.js', array(), '', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && is_product()) {
		wp_enqueue_script( 'single-product-add-to-cart', get_template_directory_uri() . '/dist/js/single-product-add-to-cart.js', array(), '', true );
	}

	if ( is_cart() ) {
		wp_enqueue_script( 'cart-update-auto', get_template_directory_uri() . '/dist/js/cart-update-auto.js', array(), '', true );
	}

	if (is_product_category() || is_shop()) {
		wp_enqueue_script( 'product-filters', get_template_directory_uri() . '/dist/js/product-filters.js', array(), '', true );
	}

	if (
		is_blog() ) {
		wp_enqueue_script( 'blogAnimations', get_template_directory_uri() . '/dist/js/blogAnimations.js', array(), '', true );
	};
	

	if (is_page(34)) {
		wp_enqueue_script( 'maps', get_template_directory_uri() . '/dist/js/maps.js', array(), '', true );
		wp_enqueue_script( 'google_js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAPJ8o7xD9vqydfgZ6XrJKvLdnhmL_YTxA', '', '' );
	}

}
add_action( 'wp_enqueue_scripts', 'pakistore_scripts' );

add_theme_support( 'menus' );


function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

// function add_async_defer($tag, $handle, $src) {
//     if('googlemaps' !== $handle) {//Here we check if our handle is googlemaps
//         return $tag; //We return the entire <script> tag as is without modifications.
//     }
//     return "<script type='text/javascript' async='async' defer='defer' src='".$src."'></script>";//Usually the value in $tag variable looks similar to this script tag but without the async and defer
// }
// add_filter('script_loader_tag', 'add_async_defer', 10, 3);


function wpb_add_google_fonts() {
	// wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,600;0,700;1,400&display=swap', false );
	// wp_enqueue_style( 'wpb-google-fonts2', 'https://fonts.googleapis.com/css2?family=K2D:wght@300;700', false ); 
	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

// function defer_parsing_of_js( $url ) {
//     if ( is_user_logged_in() ) return $url; //don't break WP Admin
//     if ( FALSE === strpos( $url, '.js' ) ) return $url;
//     if ( strpos( $url, 'jquery' ) ) return $url;
// 	if ( strpos( $url, 'wp-includes' ) ) return $url;
// 	if ( strpos( $url, 'woocommerce' ) ) return $url;
//     return str_replace( ' src', ' defer src', $url );
// }
// add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );


//mobile menu

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	
	// loop
	foreach( $items as &$item ) {
		// $item->title .= '<span>'. $item->classes . '</span>';
		// vars
		$menu_thumbnail_image = get_field('menu_thumbnail_image', $item);
		$menu_thumbnail_image_position = get_field('menu_thumbnail_image_position', $item);
		
				// append bg image
		if( $menu_thumbnail_image ) {
					// $item->title .= '<span>'. $item->classes . '</span>';
			$item->title .= ' <span class="menu-thumbnail-image test" style="background-image: url('. $menu_thumbnail_image .'); background-position: '.$menu_thumbnail_image_position.'"></span>';
		
		}
	}
	// return
	return $items;
}

add_filter( 'wp_nav_menu_objects', 'wpdocs_add_menu_parent_class', 11, 3 );


function wpdocs_add_menu_parent_class( $items ) {
    $parents = array();

    // Collect menu items with parents.
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }

    // Add class.
    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'menu-parent-link'; //here attach the class
			// $item->title .= ' <span class="expand-menu-toggle"></span>';
        }
    }

    return $items;
}

function prefix_add_button_after_menu_item_children( $item_output, $item, $depth, $args ) {

        if ( in_array( 'menu-item-has-children', $item->classes ) || in_array( 'page_item_has_children', $item->classes ) ) {
            $item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><span class="expand-menu-toggle" aria-expanded="false" aria-pressed="false"></span>', $item_output );
        }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_add_button_after_menu_item_children', 10, 4 );


class Has_Child_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ) {
            return;
        }
        $element->has_children = ! empty( $children_elements[ $element->{$this->db_fields['id']} ] );
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}

// function my_menu_dropdown( $output, $item, $depth, $args ) {
//     if ( $item->has_children ) {
//         $output .= '<span class="expand-menu-toggle"> ikonka</span>';
//     }
//     return $output;
// }
// add_filter( 'walker_nav_menu_start_el', 'my_menu_dropdown', 10, 4 );

// add_filter('wp_nav_menu_objects', 'menu_has_children', 10, 2);

// function menu_has_children($sorted_menu_items, $args) {
//     $parents = array();
//     foreach ( $sorted_menu_items as $key => $obj )
//             $parents[] = $obj->menu_item_parent;
//     foreach ($sorted_menu_items as $key => $obj)
//         $sorted_menu_items[$key]->has_children = (in_array($obj->ID, $parents)) ? true : false;

// 		if ($sorted_menu_items[$key]->has_children) {
// 			$obj->title .= '<span></span>';
// 		};

//     return $sorted_menu_items;
// }


// function add_classname_to_parent_nav_link($atts, $item) {

//     // add class only on parent
//     if($item->menu_item_parent == 0) {
//         $atts['class'] = 'menu-parent-link';
//     }   
//     return $atts;   
// }
// add_filter('nav_menu_link_attributes', 'add_classname_to_parent_nav_link', 10, 2);




//blog
function new_excerpt_more($more) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more', 21 );

function the_excerpt_more_link( $excerpt ){
    $post = get_post();
    $excerpt .= '<a class="read-more" href="'. get_permalink($post->ID) . '">Czytaj dalej</a>';
    return $excerpt;
}
add_filter( 'the_excerpt', 'the_excerpt_more_link', 21 );

add_theme_support('category-thumbnails');

add_theme_support( 'post-thumbnails' ); 

/*
 *WOOCOMMERCE 
*/

// remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

/*Declare WooCommerce support */
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


add_action( 'init', function(){
	add_post_type_support( 'product', 'page-attributes' );
	});


function disable_woo_commerce_sidebar() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); 
}
add_action('init', 'disable_woo_commerce_sidebar');


add_filter( 'woocommerce_min_password_strength', 'reduce_min_strength_password_requirement' );
function reduce_min_strength_password_requirement( $strength ) {
    // 3 => Strong (default) | 2 => Medium | 1 => Weak | 0 => Very Weak (anything).
    return 1; 
}

// Add the code below to your theme's functions.php file to add a confirm password field on the register form under My Accounts.
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
    global $woocommerce;
    extract( $_POST );
    if ( strcmp( $password, $password2 ) !== 0 ) {
        return new WP_Error( 'registration-error', __( 'Wprowadzono różne hasła.', 'woocommerce' ) );
    }
    return $reg_errors;
}
add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );
function wc_register_form_password_repeat() {
    ?>
    <p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Powtórz hasło', 'woocommerce' ); ?> <span class="required">*</span></label>
		<span class="password-input">
			<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
			<span class="show-password-input"></span>
		</span>
    </p>
    <?php
}


function wholeseller_role_cat( $q ) {

    // Get the current user
    $current_user = wp_get_current_user();

    if ( in_array( 'wholesale_customer', $current_user->roles ) ) {
        // Set here the ID for Wholesale category 

		add_filter( 'woocommerce_get_price_html', 'info_for_whosale', 9999, 2 );
 
		function info_for_whosale( $price, $product ){
		 
		if ( '' === $product->get_price() || 0 == $product->get_price() ) {
		 
		$price = '<span class="tylko dla wholesale"></span>';
		 
		}
		
		return $price;
		
		}

    } else {

		$meta_query = $q->get( 'meta_query' );
 
        $meta_query[] = array(
 
                    'key'       => '_price',
 
                    'value'     => 0,
 
                    'compare'   => '>'
 
                );
    $q->set( 'meta_query', $meta_query );

    }
}
add_action( 'woocommerce_product_query', 'wholeseller_role_cat' );


//custom input fields in woocommerce registration form when wholesale customer creates account

add_action( 'woocommerce_register_form', 'add_custom_register_form_fields' );

function add_custom_register_form_fields() {

	woocommerce_form_field(

		'billing_company',

		array(
			'type'        => 'text',
			'required'    => true, // just adds an "*"
			'label'       => 'Nazwa Firmy',
			'class' => array('my-custom-form-field'),
		),
		( isset($_POST['billing_company']) ? $_POST['billing_company'] : '' )
	);
 
	woocommerce_form_field(

		'billing_vat',

		array(
			'type'        => 'text',
			'required'    => true, // just adds an "*"
			'label'       => 'Numer NIP',
			'class' => array('my-custom-form-field'),
		),
		( isset($_POST['billing_vat']) ? $_POST['billing_vat'] : '' )
	);
}


// add_action( 'woocommerce_register_post', 'validate_custom_form_fields', 10, 3 );
 
// function validate_custom_form_fields( $username, $email, $errors ) {
 
// 	if ( empty( $_POST['billing_vat'] ) ) {
// 		$errors->add( 'billing_vat_error', 'We really want to know!' );
// 	}
 
// }


add_action( 'woocommerce_created_customer', 'save_register_fields_to_database' );
 
function save_register_fields_to_database( $customer_id ){
 
	if ( isset( $_POST['billing_vat'] ) ) {
		update_user_meta( $customer_id, 'billing_vat', wc_clean( $_POST['billing_vat'] ) );
	}

	if ( isset( $_POST['billing_company'] ) ) {
		update_user_meta( $customer_id, 'billing_company', wc_clean( $_POST['billing_company'] ) );
	}
}

//change myaccount endpoints
// function wpb_woo_my_account_order() {
// 	$myorder = array(
// 		'my-custom-endpoint' => __( 'My Stuff', 'woocommerce' ),
// 		'edit-account'       => __( 'Change My Details', 'woocommerce' ),
// 		'dashboard'          => __( 'Dashboard', 'woocommerce' ),
// 		'orders'             => __( 'Orders', 'woocommerce' ),
// 		'downloads'          => __( 'Download MP4s', 'woocommerce' ),
// 		'edit-address'       => __( 'Addresses', 'woocommerce' ),
// 		'payment-methods'    => __( 'Payment Methods', 'woocommerce' ),
// 		'customer-logout'    => __( 'Logout', 'woocommerce' ),
// 	);

// 	return $myorder;
// }
// add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );


/**
 * Notify admin when a new customer account is created
 */

add_action( 'woocommerce_created_customer', 'woocommerce_created_customer_admin_notification' );
function woocommerce_created_customer_admin_notification( $customer_id ) {
  wp_send_new_user_notifications( $customer_id, 'admin' );
}


add_filter( 'wp_new_user_notification_email_admin', 'custom_wp_new_user_notification_email', 10, 3 );

function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
	
	$user_count = count_users();

	$my_tax_data = get_user_meta( $user->ID, 'billing_vat', true );
	$my_company_data = get_user_meta( $user->ID, 'billing_company', true );

	if ($my_tax_data) {
		$user_role = 'hurtowy';
	} else {
		$user_role = 'detaliczny';
	};

	if ($my_company_data) {
		$company = "\n" . sprintf("Firma: %s ", $my_company_data) .
		"\n" . sprintf("NIP: %s ", $my_tax_data) .
		"\n" . "Pamiętaj by po weryfikacji aktywować ceny hurtowe dla tego kontrahenta.";
	} else {
		$company = "\n";
	};

    $wp_new_user_notification_email['subject'] = sprintf( '[%s] Nowy użytkownik %s .', $blogname, $user_role, $user->user_login );
    $wp_new_user_notification_email['message'] = sprintf( "%s ( %s ) zarejestrował się w Twoim sklepie %s.", $user->user_login, $user->user_email, $blogname ) .
	"\n" . sprintf("Rodzaj użytkownika: %s ", $user_role) .
	$company .
	"\n" . sprintf("Gratulacje, to twój %d zarejestrowany użytkownik!", $user_count['total_users']);
    return $wp_new_user_notification_email;
}

//remove useless fields from edit shipping address user panel
add_filter( 'woocommerce_default_address_fields', 'remove_fields' );
 
function remove_fields( $fields ) {
 
	unset( $fields[ 'address_2' ] );
	return $fields;
 
}


//Extra TAX Number field for wholesale customers at customer panel and in Wordpress admin panel

$user = wp_get_current_user();
$wholesale_role = array('wholesale_customer');

if( array_intersect($wholesale_role, $user->roles ) ) {
   // Stuff here for allowed roles
   add_filter('woocommerce_billing_fields' , 'display_billing_vat_fields');
   function display_billing_vat_fields($billing_fields){
	   $billing_fields['billing_vat'] = array(
		   'type' => 'text',
		   'label' =>  __('NIP',  'woocommerce' ),
		   'class' => array('form-row-wide'),
		   'required' => true,
		   'clear' => true,
		   'priority' => 35, // To change the field location increase or decrease this value
	   );

	   return $billing_fields;
   }

   add_filter( 'woocommerce_default_address_fields' , 'customize_user_shipping_data_fields' );

   function customize_user_shipping_data_fields( $fields ) {

	$fields[ 'company' ]['required'] = true;

	return $fields;

	}

	// display the extra data in the order admin panel
	function display_order_extra_data_in_admin( $order ) {

	?>
			<div class="order_data_column">
				<h4><?php _e( 'Extra Details' ); ?></h4>
				<?php 
					echo '<p><strong>' . __( 'NIP' ) . ':</strong>';
					echo  $order->get_meta('billing_vat');
					echo '</p>';
					echo '<p><strong>' . __( 'Another field' ) . ':</strong>' . $order->get_meta('billing_vat') . '</p>';
				?>
			</div>
	<?php
	}
		add_action( 'woocommerce_admin_order_data_after_billing_address', 'display_order_extra_data_in_admin' );

}

	// Printing the Billing Address on My Account
	add_filter( 'woocommerce_my_account_my_address_formatted_address', 'custom_my_account_my_address_formatted_address', 10, 3 );
	function custom_my_account_my_address_formatted_address( $fields, $customer_id, $type ) {

		if ( $type == 'billing' ) {
			$fields['vat'] = get_user_meta( $customer_id, 'billing_vat', true );
		}

		return $fields;
	}

	// Checkout -- Order Received (printed after having completed checkout)
	add_filter( 'woocommerce_order_formatted_billing_address', 'custom_add_vat_formatted_billing_address', 10, 2 );
	function custom_add_vat_formatted_billing_address( $fields, $order ) {
		$fields['vat'] = $order->get_meta('billing_vat');

		return $fields;
	}

	// Creating merger VAT variables for printing formatting
	add_filter( 'woocommerce_formatted_address_replacements', 'custom_formatted_address_replacements', 10, 2 );
	function custom_formatted_address_replacements( $replacements, $args  ) {
		$replacements['{vat}'] = ! empty($args['vat']) ? $args['vat'] : '';
		$replacements['{vat_upper}'] = ! empty($args['vat']) ? strtoupper($args['vat']) : '';

		return $replacements;
	}

	//Defining the Spanish formatting to print the address, including VAT.
	add_filter( 'woocommerce_localisation_address_formats', 'custom_localisation_address_format' );
	function custom_localisation_address_format( $formats ) {
		foreach($formats as $country => $string_address ) {
			$formats[$country] = str_replace('{company}\n', '{company}\n{vat_upper}\n', $string_address);
		}
		return $formats;
	}


	add_filter( 'woocommerce_customer_meta_fields', 'custom_customer_meta_fields' );
	function custom_customer_meta_fields( $fields ) {
		$fields['billing']['fields']['billing_vat'] = array(
			'label'       => __( 'NIP', 'woocommerce' )
		);

		return $fields;
	}


	add_filter( 'woocommerce_admin_billing_fields', 'custom_admin_billing_fields' );
	function custom_admin_billing_fields( $fields ) {
		$fields['vat'] = array(
			'label' => __( 'NIP', 'woocommerce' ),
			'show'  => true
		);

		return $fields;
	}

	add_filter( 'woocommerce_found_customer_details', 'custom_found_customer_details' );
	function custom_found_customer_details( $customer_data ) {
		$customer_data['billing_vat'] = get_user_meta( $_POST['user_id'], 'billing_vat', true );

		return $customer_data;
	}



/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('Pokaż koszyk', 'woothemes'); ?>">

		<span class="cart-icon-wrapper">

		<svg id="Layer_1" enable-background="new 0 0 511.728 511.728" height="512" viewBox="0 0 511.728 511.728" width="512" xmlns="http://www.w3.org/2000/svg" fill="#84898d"><path d="m147.925 379.116c-22.357-1.142-21.936-32.588-.001-33.68 62.135.216 226.021.058 290.132.103 17.535 0 32.537-11.933 36.481-29.017l36.404-157.641c2.085-9.026-.019-18.368-5.771-25.629s-14.363-11.484-23.626-11.484c-25.791 0-244.716-.991-356.849-1.438l-17.775-65.953c-4.267-15.761-18.65-26.768-34.978-26.768h-56.942c-8.284 0-15 6.716-15 15s6.716 15 15 15h56.942c2.811 0 5.286 1.895 6.017 4.592l68.265 253.276c-12.003.436-23.183 5.318-31.661 13.92-8.908 9.04-13.692 21.006-13.471 33.695.442 25.377 21.451 46.023 46.833 46.023h21.872c-3.251 6.824-5.076 14.453-5.076 22.501 0 28.95 23.552 52.502 52.502 52.502s52.502-23.552 52.502-52.502c0-8.049-1.826-15.677-5.077-22.501h94.716c-3.248 6.822-5.073 14.447-5.073 22.493 0 28.95 23.553 52.502 52.502 52.502 28.95 0 52.503-23.553 52.503-52.502 0-8.359-1.974-16.263-5.464-23.285 5.936-1.999 10.216-7.598 10.216-14.207 0-8.284-6.716-15-15-15zm91.799 52.501c0 12.408-10.094 22.502-22.502 22.502s-22.502-10.094-22.502-22.502c0-12.401 10.084-22.491 22.483-22.501h.038c12.399.01 22.483 10.1 22.483 22.501zm167.07 22.494c-12.407 0-22.502-10.095-22.502-22.502 0-12.285 9.898-22.296 22.137-22.493h.731c12.24.197 22.138 10.208 22.138 22.493-.001 12.407-10.096 22.502-22.504 22.502zm74.86-302.233c.089.112.076.165.057.251l-15.339 66.425h-51.942l8.845-67.023 58.149.234c.089.002.142.002.23.113zm-154.645 163.66v-66.984h53.202l-8.84 66.984zm-74.382 0-8.912-66.984h53.294v66.984zm-69.053 0h-.047c-3.656-.001-6.877-2.467-7.828-5.98l-16.442-61.004h54.193l8.912 66.984zm56.149-96.983-9.021-67.799 66.306.267v67.532zm87.286 0v-67.411l66.022.266-8.861 67.145zm-126.588-67.922 9.037 67.921h-58.287l-18.38-68.194zm237.635 164.905h-36.426l8.84-66.984h48.973l-14.137 61.217c-.784 3.396-3.765 5.767-7.25 5.767z"/></svg>

		<span id="cart-counter"><?php echo sprintf($woocommerce->cart->cart_contents_count);?></span>

		</span>
		
	 <!-- <?php echo $woocommerce->cart->get_cart_total(); ?> -->
	
	</a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

// Remove trash icon and then add a new.
function kia_cart_item_remove_link( $link, $cart_item_key ) {
    return str_replace( '×', '<span class="cart-remove-icon"></span>', $link );
}
add_filter( 'woocommerce_cart_item_remove_link', 'kia_cart_item_remove_link', 10, 2 );


add_filter( 'woocommerce_sale_flash', 'add_percentage_to_sale_badge', 20, 3 );
function add_percentage_to_sale_badge( $html, $post, $product ) {

  if( $product->is_type('variable')){
      $percentages = array();

      // Get all variation prices
      $prices = $product->get_variation_prices();

      // Loop through variation prices
      foreach( $prices['price'] as $key => $price ){
          // Only on sale variations
          if( $prices['regular_price'][$key] !== $price ){
              // Calculate and set in the array the percentage for each variation on sale
              $percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
          }
      }
      // We keep the highest value
      $percentage = max($percentages) . '%';

  } elseif( $product->is_type('grouped') ){
      $percentages = array();

      // Get all variation prices
      $children_ids = $product->get_children();

      // Loop through variation prices
      foreach( $children_ids as $child_id ){
          $child_product = wc_get_product($child_id);

          $regular_price = (float) $child_product->get_regular_price();
          $sale_price    = (float) $child_product->get_sale_price();

          if ( $sale_price != 0 || ! empty($sale_price) ) {
              // Calculate and set in the array the percentage for each child on sale
              $percentages[] = ( floatval( $prices['regular_price'][ $key ] ) - floatval( $price ) ) / floatval( $prices['regular_price'][ $key ] ) * 100;
          }
      }
      // We keep the highest value
      $percentage = max($percentages) . '%';

  } else {
      $regular_price = (float) $product->get_regular_price();
      $sale_price    = (float) $product->get_sale_price();

      if ( $sale_price != 0 || ! empty($sale_price) ) {
          $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
      } else {
          return $html;
      }
  }
  return '<span class="onsale sales-badge">' . esc_html__( '-', 'woocommerce' ) . ' ' . $percentage . '</span>';
}



// Alter WooCommerce View Cart Text
add_filter( 'gettext', function( $translated_text ) {
    if ( 'View cart' === $translated_text ) {
        $translated_text = 'Pokaż koszyk';
    }
    return $translated_text;
} );

//badge 'new' for recent products
add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_new_badge_shop_page', 3 );
          
// function bbloomer_new_badge_shop_page() {
//    global $product;
// //    $newness_days = 2;
// //    $created = strtotime( $product->get_date_created() );
//    if ( has_term( 39, 'product_cat' ) ) {
//       echo '<span class="itsnew">' . esc_html__( 'Nowość!', 'woocommerce' ) . '</span>';
//    }
// }

add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_new_badge_shop_page', 3 );
          
function bbloomer_new_badge_shop_page() {
   global $product;
   $newness_days = 10;
   $created = strtotime( $product->get_date_created() );
   if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
      echo '<span class="itsnew">' . esc_html__( 'Nowość!', 'woocommerce' ) . '</span>';
   }
}

//badge 'bestseller'
add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_best_badge_shop_page', 3 );
          
function bbloomer_best_badge_shop_page() {
   global $product;
//    $newness_days = 2;
//    $created = strtotime( $product->get_date_created() );
   if ( has_term( 23, 'product_cat' ) ) {
	  echo '<div class="bestseller-wrapper">';
	  echo '<span class="bestseller"></span>';
	  echo '<span>' . esc_html__( 'bestseller', 'woocommerce' ) . '</span>';
	  echo '</div>';
   }
}

// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
// add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_coupon_form', 5 );


//SINGLE PRODUCT LAYOUT

//Price
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );


//Related products && Upsell products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action('woocommerce_after_single_product', 'woocommerce_upsell_display', 15 );
add_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );

//Producent
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 20 );


// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 26 );


// define the woocommerce_get_price_html callback 
function filter_woocommerce_get_price_html( $price, $instance ) { 
    // make filter magic happen here... 
	global $product;

	if ( is_singular() && is_product() && is_single( $product->get_id() )) {

		$price .= 'Nasza cena: ';
	}

    return $price;
}; 
         
// add the filter 
add_filter( 'woocommerce_get_price_html', 'filter_woocommerce_get_price_html', 10, 2 ); 


function bbloomer_echo_qty_front_add_cart() {
 echo '<div class="qty-label">Ilość: </div>'; 
}
add_action( 'woocommerce_before_add_to_cart_button', 'bbloomer_echo_qty_front_add_cart' );

function my_display_quantity_minus() {
   echo '<button type="button" class="minus"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 13H5v-2h14v2z"/></svg></button>';
}
add_action( 'woocommerce_before_add_to_cart_quantity', 'my_display_quantity_minus' );

function my_display_quantity_plus() {
   echo '<button type="button" class="plus"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg></button>';
}
add_action( 'woocommerce_after_add_to_cart_quantity', 'my_display_quantity_plus' );

// function get_free_shipping_minimum($zone_name = 'Poland') {
// 	if ( ! isset( $zone_name ) ) return null;
  
// 	$result = null;
// 	$zone = null;
  
// 	$zones = WC_Shipping_Zones::get_zones();
// 	foreach ( $zones as $z ) {
// 	  if ( $z['zone_name'] == $zone_name ) {
// 		$zone = $z;
// 	  }
// 	}
  
// 	if ( $zone ) {
// 	  $shipping_methods_nl = $zone['shipping_methods'];
// 	  $free_shipping_method = null;
// 	  foreach ( $shipping_methods_nl as $method ) {
// 		if ( $method->id == 'free_shipping' ) {
// 		  $free_shipping_method = $method;
// 		  break;
// 		}
// 	  }
  
// 	  if ( $free_shipping_method ) {
// 		$result = $free_shipping_method->min_amount;
// 	  }
// 	}
  
// 	return $result;
// }

// add_action( 'woocommerce_cart_totals_before_shipping', 'bbloomer_free_shipping_cart_notice' );
  
// function bbloomer_free_shipping_cart_notice() {

// 	$free_shipping_min = get_free_shipping_minimum( 'Poland' );

//    $current = WC()->cart->subtotal;
  
//    if ( $current < $free_shipping_min ) {
//       $added_text = 'Do darmowej dostawy brakuje Ci ' . wc_price( $free_shipping_min - $current ) . '';
//       $return_to = wc_get_page_permalink( 'shop' );
//       $notice = sprintf( '<a href="%s" class="button wc-forward add_to_cart_button">%s</a> %s', esc_url( $return_to ), 'Kontynuuj zakupy', $added_text );
//       wc_print_notice( $notice, 'notice' );
//    }
  
// }


add_filter( 'flexible_shipping_free_shipping_notice_text', 'wpdesk_flexible_shipping_free_shipping_notice_text', 10, 2 );
function wpdesk_flexible_shipping_free_shipping_notice_text( $notice_text, $amount ) {
      $added_text = 'Do darmowej dostawy kurierem DPD brakuje Ci tylko:' . wc_price( $amount ) . '';
      $return_to = wc_get_page_permalink( 'shop' );
      $notice = sprintf( '<a href="%s" class="button wc-forward add_to_cart_button">%s</a> %s', esc_url( $return_to ), 'Kontynuuj zakupy', $added_text );

	 return $notice;
	 }


add_filter( 'woocommerce_cart_shipping_method_full_label', 'filter_woocommerce_cart_shipping_method_full_label', 10, 2 ); 

function filter_woocommerce_cart_shipping_method_full_label( $label, $method ) {      
   // Targeting shipping method "Flat rate instance Id 2"
   $delivery_option_1 = get_field('delivery_option_1', get_option( 'woocommerce_cart_page_id' ) );
//    $delivery_option_2 = get_field('delivery_option_2', get_option( 'woocommerce_cart_page_id' ) );
   $delivery_option_3 = get_field('delivery_option_3', get_option( 'woocommerce_cart_page_id' ) );

   if( $method->id === "flexible_shipping_10_1" ) {
       $label .= '<img src="'.$delivery_option_1.'" />';
   }

//    if( $method->id === "flat_rate:8" ) {
// 	$label .= '<img src="'.$delivery_option_2.'" />';
// 	}

	if( $method->id === "free_shipping:7" ) {
		$label .= '<img id="free-shipping-check" src="'.$delivery_option_3.'" />';
	}

   return $label; 
}


//hide shipping method from regular customer
add_filter( 'woocommerce_package_rates', function( $shipping_rates ) {

	// Provide user role and shipping methods values pair
	$role_shipping_method_arr = array(
		'customer' 			=>	array( 'flexible_shipping_10_2'),
	);

	$current_user = wp_get_current_user();
// 	Uncomment below lines to get current user roles and check in Woocommerce->status->Log ,file name will contain xa_current_user_role
//	$log = new WC_Logger();
//	$log->add('xa_current_user_role', print_r($current_user->roles,true));

	// Loop through the user role and shipping method pair
	foreach( $role_shipping_method_arr as $role => $shipping_methods_to_hide ) {
		// Check if defined role exist in current user role or not
		if( in_array( $role, $current_user->roles) ) {
			// Loop through all the shipping rates
			foreach( $shipping_rates as $shipping_method_key => $shipping_method ) {
				$shipping_id = $shipping_method->get_id();
				// Unset the shipping method if found
				if( in_array( $shipping_id, $shipping_methods_to_hide) ) {
					unset($shipping_rates[$shipping_method_key]);
				}
			}
		}
	}

	
	return $shipping_rates;
} );

add_action('init', function(){
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
});

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    } 
}

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {   
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog' ) {
        global $post, $woocommerce;
		$output = '';
		
		$body_classes = get_body_class();
			if(in_array('woocommerce-cart', $body_classes))
			{
				$on_cart_page = true;
			} else {
				//Other Page
				$on_cart_page = false;
			}

        if ( has_post_thumbnail() && $on_cart_page === false ) {
			
			$src = str_replace( ' ', '%20', get_the_post_thumbnail_url( $post->ID, $size ) );
			
            $output .= '<img class="lazy my-lazy-img" src="'. content_url().'/uploads/woocommerce-placeholder-300x300.png" data-src="' . $src . '" data-srcset="' . $src . '" alt="'.get_the_title().'">';
		} elseif ($on_cart_page === true ) {
			$src = str_replace( ' ', '%20', get_the_post_thumbnail_url( $post->ID, $size ) );


            $output .= '<img class="cross-sell-img" src="'.  $src . '" alt="'.get_the_title().'">';
		} else {
             $output .= wc_placeholder_img( $size );
        }

        return $output;
    }
}

// function mynamespace_encode_img_src($sources){
//         foreach($sources as $source => $values ){
//                 $sources[$source]['url'] = str_replace( ' ', '%20', $values['url'] );
//         }
//         return $sources;
// }
// add_filter( 'woocommerce_get_product_thumbnail', 'mynamespace_encode_img_src', 10, 1 );

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
// function my_hide_shipping_when_free_is_available( $rates ) {
// 	$free = array();

// 	foreach ( $rates as $rate_id => $rate ) {
// 		if ( 'free_shipping' === $rate->method_id ) {
// 			$free[ $rate_id ] = $rate;
// 			break;
// 		}
// 	}

// 	return ! empty( $free ) ? $free : $rates;
// }

// add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );

// Remove the product rating display on product loops
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


add_filter( 'the_title', 'shorten_woo_product_title', 10, 2 );
function shorten_woo_product_title( $title, $id ) {
	global $woocommerce_loop;
    if (! is_singular( array( 'product' ) ) && get_post_type( $id ) === 'product' || is_product() && $woocommerce_loop['name'] == 'related' || is_product() && $woocommerce_loop['name'] == 'up-sells' ) {
        return mb_strimwidth( $title, 0, 61, '...' ); // change last number to the number of words you want
    } else {
        return $title;
    }
}

// ---------------------------------------------
// Remove Cross Sells From Default Position 
 
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
 

// ---------------------------------------------
// Add them back UNDER the Cart Table
 
add_action( 'woocommerce_after_cart_totals', 'woocommerce_cross_sell_display' );


add_filter( 'woocommerce_cross_sells_columns', 'bbloomer_change_cross_sells_columns' );
 
function bbloomer_change_cross_sells_columns( $columns ) {
return 4;
}
 

add_filter( 'woocommerce_dpd_disable_ssl_verification', '__return_true' ); 
add_filter( 'woocommerce_dpd_disable_cache_wsdl', '__return_true' );


//text in front of a price at singular product page
// add_filter( 'woocommerce_get_price_html', 'cw_change_product_price_display' );
// function cw_change_product_price_display( $price ) {
// 	// Your additional text in a translatable string
// 	if (is_product()) {
// 		$text = __('TEXT');
// 		// returning the text before the price
// 		return $text . ' ' . $price;
// 	} else {
// 		return $price;
// 	}

// }

//force number of products per row

add_filter('loop_shop_columns',function(){return 3;});

function footer_copyright() {
	global $wpdb;
	$copyright_dates = $wpdb->get_results("
	SELECT
	YEAR(min(post_date_gmt)) AS firstdate,
	YEAR(max(post_date_gmt)) AS lastdate
	FROM
	$wpdb->posts
	WHERE
	post_status = 'publish'
	");
	$output = '';
	if($copyright_dates) {
	$copyright = "&copy; " . $copyright_dates[0]->firstdate;
	if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
	$copyright .= '-' . $copyright_dates[0]->lastdate;
	}
	$output = $copyright;
	}
	return $output;
}

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
return array(
        'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
		'delimiter'   => '<span class="woocommerce-breadcrumb__separator">/</span>',
        'wrap_after'  => '</nav>',
        'before'      => ' ',
        'after'       => ' ',
    );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Generating dynamic sytles.
 */
require get_template_directory() . '/inc/dynamic-styles.php';
