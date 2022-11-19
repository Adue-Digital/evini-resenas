<?php

namespace Adue\EviniResenas\Frontend;

use Adue\WordPressBasePlugin\Base\Config;
use Adue\WordPressBasePlugin\Modules\Views\Assets as AssetsManager;
use Adue\WordPressBasePlugin\Helpers\Traits\UseConfig;
use Adue\WordPressBasePlugin\Helpers\Traits\UseLoader;

class Assets
{

    use UseLoader, UseConfig;

    //public $assetsManager

    public static function registerScripts()
    {
        $assets = new self;
        $assets->loader()->addAction('wp_enqueue_scripts', $assets, 'enqueueScripts');
    }

    public function enqueueScripts()
    {
        $assetsManager = new AssetsManager();
        $assetsManager->enqueueScripts('scripts', $this->config()->get('base_plugin_dir').'/../resources/assets/js/scripts.js', array('jquery'),  date('YmdHis'), true );
        $assetsManager->enqueueScripts('steps', $this->config()->get('base_plugin_dir').'/../resources/assets/js/jquery.steps.min.js', array('jquery'), date('YmdHis'), true );
        $assetsManager->enqueueScripts('star-rating-svg', $this->config()->get('base_plugin_dir').'/../resources/assets/js/jquery.star-rating-svg.min.js', array('jquery'), date('YmdHis'), true );
        $assetsManager->enqueueStyles('style', $this->config()->get('base_plugin_dir').'/../resources/assets/css/style.css' );

        $assetsManager->localizeScript('scripts', 'ajax_var', [
            'url'    => admin_url( 'admin-ajax.php' ),
            'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
            'action' => 'save-reviews'
        ]);

        if(!is_product()) {
            $assetsManager->enqueueScripts('wc-single-product-js', 'http://evini.test/wp-content/plugins/woocommerce/assets/js/frontend/single-product.min.js', array('jquery'), date('YmdHis'));
        }
    }

}