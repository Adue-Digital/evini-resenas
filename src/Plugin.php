<?php

namespace Adue\EviniResenas;

use Adue\EviniResenas\Comments\AcidAttribute;
use Adue\EviniResenas\Frontend\Assets;
use Adue\EviniResenas\Frontend\Attributes;
use Adue\EviniResenas\Frontend\OrderReviewShortcode;
use Adue\WordPressBasePlugin\BasePlugin;

class Plugin extends BasePlugin
{

    protected string $configFilePath = __DIR__.'/../config/config.php';

    public function init()
    {
        Assets::registerScripts();

        Attributes::registerAttributes();

        add_filter( 'comment_post_redirect', [$this, 'commentPostRedirect'], 10,2 );

        $shortcode = new OrderReviewShortcode();
        $shortcode->add();
    }

    public function commentPostRedirect($location, $commentdata)
    {
        if(strpos('revision-de-orden', $_SERVER['HTTP_REFERER']) !== false) {
            return site_url().'/revision-de-orden';
        }
        return $location;
    }

}