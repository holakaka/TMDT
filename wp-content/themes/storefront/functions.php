<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

/**

 * @snippet       Hide Dashboard on the My Account Page

  */

add_filter( 'woocommerce_account_menu_items', 'njengah_remove_my_account_dashboard' );

function njengah_remove_my_account_dashboard( $menu_links ){

            unset( $menu_links['dashboard'] );
			unset( $menu_links[ 'downloads' ] );
			unset( $menu_links[ 'edit-address' ] );
            return $menu_links;

 }
add_action('template_redirect', 'njengah_redirect_to_orders_from_dashboard' );

function njengah_redirect_to_orders_from_dashboard(){

if( is_account_page() && empty( WC()->query->get_current_endpoint() ) ){

wp_safe_redirect( wc_get_account_endpoint_url( 'orders' ) );
	

exit;

}
	
function disable_shipping_calc_on_cart( $show_shipping ) {
    if( is_cart() ) {
        return false;
    }
    return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99 );
	
/**

 * @snippet       Rename State Field Label @ WooCommerce Checkout

*/

add_filter( 'woocommerce_default_address_fields' , 'njengah_rename_state_province', 9999 );

function njengah_rename_state_province( $fields ) {

    $fields['first_name']['label'] = 'Full name';
	$fields['first_name']['class'][0] = 'form-row-wide';

    return $fields;

}
//set order status after payment successfully
add_action( 'woocommerce_payment_complete', 'webappick_set_completed_for_paid_orders' );

function webappick_set_completed_for_paid_orders( $order_id ) {

$order = wc_get_order( $order_id );

$order->update_status( 'payment-received' );

}
//set order status after user select Cash on delivery
add_action( 'woocommerce_thankyou', 'woocommerce_thankyou_change_order_status', 10, 1 );

function woocommerce_thankyou_change_order_status( $order_id ){

if( ! $order_id ) return;

$order = wc_get_order( $order_id );

if( $order->get_status() == 'processing' )

     $order->update_status( 'preparingcash' );

}
//unset pay button
add_filter( 'woocommerce_my_account_my_orders_actions', 'bbloomer_order_again_action', 9999, 2 );
    
function bbloomer_order_again_action( $actions, $order ) {
//     if ( $order->has_status( 'payment-received' ) || $order->has_status( 'preparing' ) ) {
//         $actions['cancelled-payed'] = array(
// //             'url' => $order->update_status( 'cancelled-payed' ),
// //            'url' => wp_nonce_url( add_query_arg( array('cancelled-payed'=>'true', 'order'=>$order->get_order_key() ,'order_id' => $order->get_id()), wc_get_page_permalink( 'myaccount' ) ), 'woocommerce-cancelled_payed' ),
// 			'name' => __( 'Cancel', 'woocommerce' ),
//         );
//     }
	   	unset($actions['pay']);
    return $actions;
}
	add_action('admin_init', 'set_user_screen_options'); 
// Use this if you want it to work for users that already exist, just go to admin and reload once, then you can use only the function 'user_register'

function set_user_screen_options() {
    $meta_key['hidden'] = 'manageedit-shop_ordercolumnshidden';
    $meta_value = array(
        'billing_address',
        'shipping_address',
    );
	
	 $meta_key['hidden'] = 'metaboxhidden_shop_order';
    $meta_value = array(
        'woocommerce-order-data',
    );

    // set the default hiddens if it has not been set yet, you can remove this for testing, so it will work no matter the preferences saved
    if ( ! get_user_meta( $user->ID, $meta_key['hidden'], true) ) {
        update_user_meta( $user->ID, $meta_key['hidden'], $meta_value );
    }

}

}
