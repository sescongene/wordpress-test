<?php

namespace Donation\Inc\Classes;

use Donation\Inc\Traits\SingletonTrait;

class DonationTheme
{
    use SingletonTrait;

    protected function __construct()
    {
        $this->setup_hooks();
        Donation::get_instance();
        DonationAjax::get_instance();
    }

    protected function setup_hooks()
    {
        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
        add_action('after_setup_theme', [$this, 'theme_setup']);
    }

    public function register_scripts()
    {
        wp_enqueue_style('main_style', get_template_directory_uri() . '/dist/css/style.css', array(), _S_VERSION);
        wp_enqueue_script('main_script', get_template_directory_uri() . '/dist/js/style.js', array(), _S_VERSION, true);
        $total = 0;
        $donations = get_posts(array(
            'post_type' => 'donation',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        ));
        foreach ($donations as $post) {
            $total += (int) get_post_meta($post->ID, 'donation_amount', true);
        }
        wp_localize_script('main_script', 'donationData',
            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'donationTarget' => 4000000,
                'currentDonation' => $total,
            )
        );

        if (!is_admin()) {
            wp_deregister_script('jquery');
        }
    }

    public function theme_setup()
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
}
