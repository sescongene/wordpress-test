<?php
/**
 * donation functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package donation
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

if (!defined('DONATION_THEME_NONCE')) {
    define('DONATION_THEME_NONCE', 'DONATION_NONCE');
}
if (!defined('DONATION_THEME_DIR_PATH')) {
    define('DONATION_THEME_DIR_PATH', untrailingslashit(get_template_directory()));
}

require_once DONATION_THEME_DIR_PATH . '/inc/helpers/autoloader.php';

function get_theme_instance()
{
    \Donation\Inc\Classes\DonationTheme::get_instance();
}

get_theme_instance();
