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

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function theme_setup()
{
    add_theme_support('title-tag');

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

}
add_action('after_setup_theme', 'theme_setup');

function donation_scripts()
{
    wp_enqueue_style('main_style', get_template_directory_uri() . '/dist/css/style.css', array(), _S_VERSION);
    wp_enqueue_script('main_script', get_template_directory_uri() . '/dist/js/style.js', array(), _S_VERSION, true);
}
add_action('wp_enqueue_scripts', 'donation_scripts');
