<?php
/**
 * Plugin Name: Olivas Digital - Custom Emails
 * Plugin URI: https://olivas.digital/plugin/custom-emails
 * Description: Adding a custom emails
 * Author: Olivas Digital
 * Author URI: https://olivas.digital
 * Version: 1.0
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( 'includes/WP_Mail.php' );
require_once( 'includes/class-od-custom-emails.php' );

function send_login_email( $user_login, WP_User $user ) {
 
    $send             = new OD_Custom_Emails();
    $send->from       = get_option('admin_email');
    $send->to         = $user;
    $send->subject    = 'Sua conta foi acessada';

    $send->template('customer-login');
    $send->login_email();
}

function send_updated_email( $user_id ) {
    
    $send             = new OD_Custom_Emails();
    $send->from       = get_option('admin_email');
    $send->to         = wp_get_current_user();
    $send->subject    = 'Seu cadastro foi alterado com sucesso';

    $send->template('customer-updated-data');
    $send->updated_email();
}
 
add_action( 'wp_login',                             'send_login_email',   10, 2 );
add_action( 'personal_options_update',              'send_updated_email', 10, 1 );
add_action( 'woocommerce_save_account_details',     'send_updated_email', 10, 1 );
add_action( 'woocommerce_customer_save_address',    'send_updated_email', 10, 1 );
