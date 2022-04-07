<?php

namespace Donation\Inc\Classes;

use Donation\Inc\Traits\SingletonTrait;

class Donation
{
    use SingletonTrait;

    /**
     * Custom Post Slug
     *
     * @var string
     */
    protected $slug = 'donation';

    /**
     * Custom Post Type Labels
     *
     * @var array
     */
    protected $labels = array(
        'name' => 'Donations',
        'singular_name' => 'Donation',
        'add_new' => 'Add New Donation',
        'add_new_item' => 'Add New Donation',
        'edit_item' => 'Edit Donation',
        'new_item' => 'New Donation',
        'all_items' => 'All Products',
        'view_item' => 'View Donation',
        'search_items' => 'Search Donation',
        'not_found' => 'No Donations Found',
        'not_found_in_trash' => 'No Donations found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Donations',
    );

    protected function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_action('init', [$this, 'register']);
        add_filter('manage_donation_posts_columns', [$this, 'donation_table_head']);
        add_action('manage_donation_posts_custom_column', [$this, 'donation_table_content'], 10, 2);

    }

    /**
     * Register Custom Post Type Donation
     *
     * @return void
     */
    public function register()
    {
        $args = array(
            'labels' => $this->labels,
            'public' => true,
            'has_archive' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array('slug' => $this->slug),
            'query_var' => true,
            'menu_icon' => 'dashicons-randomize',
            'supports' => array(
                'custom-fields',
            ),
        );
        register_post_type($this->slug, $args);
    }

    /**
     * Override Existing Collumn For The Post Type
     *
     * @param array $columns
     * @return void
     */
    public function donation_table_head($columns)
    {
        return [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'donation_amount' => 'Amount',
            'payment_method' => 'Payment Method',
            'date' => 'Date'
        ];

    }

    /**
     * Load Custom Post Meta to Corresponding Collumn
     *
     * @param string $column_name
     * @param int $post_id
     * @return void
     */
    public function donation_table_content($column_name, $post_id)
    {
        switch ($column_name) {
            case 'first_name':
                echo get_post_meta($post_id, 'first_name', true);
                break;
            case 'last_name':
                echo get_post_meta($post_id, 'last_name', true);
                break;
            case 'email':
                echo get_post_meta($post_id, 'email', true);
                break;
            case 'donation_amount':
                echo get_post_meta($post_id, 'donation_amount', true);
                break;
            case 'payment_method':
                echo get_post_meta($post_id, 'payment_method', true);
                break;
            default:
                break;
        }
    }

}
