<?php

namespace Adue\EviniResenas\Frontend;

use Adue\WordPressBasePlugin\Base\Config;
use Adue\WordPressBasePlugin\Helpers\Traits\UseConfig;
use Adue\WordPressBasePlugin\Helpers\Traits\UseLoader;

class Assets
{

    use UseLoader, UseConfig;

    public static function registerScripts()
    {
        $assets = new self;
        $assets->loader()->addAction('wp_enqueue_scripts', $assets, 'enqueueScripts');
    }

    public function enqueueScripts()
    {
        wp_enqueue_style( 'style', $this->config()->get('base_plugin_dir').'/../resources/assets/css/style.css' );
        wp_enqueue_script( 'scripts', $this->config()->get('base_plugin_dir').'/../resources/assets/js/scripts.js', array('jquery'), '1.0.0', true );

        if(!is_product()) {
            wp_enqueue_script( 'wc-single-product-js', 'http://evini.test/wp-content/plugins/woocommerce/assets/js/frontend/single-product.min.js', array('jquery'), date('YmdHis'));
        }
    }

}