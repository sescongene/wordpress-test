<?php

namespace Donation\Inc\Classes;

use Donation\Inc\Traits\SingletonTrait;

class DonationAjax
{
    use SingletonTrait;

    /**
     * WP Ajax Action Name
     *
     * @var string
     */
    protected $action = 'submit_donation';

    protected function __construct()
    {
        $this->init();
    }

    private function init()
    {
        add_action("wp_ajax_nopriv_" . $this->action, [$this, 'handle']);

        add_action("wp_ajax_" . $this->action, [$this, 'handle']);

    }

    /**
     * Request handler
     *
     * @return void
     */
    public function handle()
    {

        if (!wp_verify_nonce($_POST['nonce'], DONATION_THEME_NONCE)) {
            return;
        }

        $data = [
            'post_type' => 'donation',
            'post_status' => 'publish',
        ];

        $id = wp_insert_post($data);

        add_post_meta($id, 'donation_amount', $_POST['donation_amount']);

        add_post_meta($id, 'payment_method', $_POST['payment_method']);

        add_post_meta($id, 'first_name', $_POST['first_name']);

        add_post_meta($id, 'last_name', $_POST['last_name']);

        add_post_meta($id, 'email', $_POST['email']);

        add_post_meta($id, 'phone', $_POST['phone']);

        return $id;

    }
}
