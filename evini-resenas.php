<?php
/*
Plugin Name:  Evini Reseñas
Description:  Integra la funcionalidad de reseñas para los productos
Version:      0.0.1
Author: Marcio Fuentes
Author URI: https://adue.digital
 */

use Adue\EviniResenas\Plugin;

require 'vendor/autoload.php';

class EviniResenas
{

    public $plugin;

    public static function instance(): self
    {
        static $instance;
        if (! $instance) {
            $instance = new self();
            $instance->plugin = new Plugin();
            $instance->run();
        }
        return $instance;
    }

    private function run()
    {
        $this->plugin->init();
        $this->plugin->run();
    }

}

class_exists(EviniResenas::class) && EviniResenas::instance();