<?php

namespace Adue\EviniResenas\Frontend;

use Adue\EviniResenas\Comments\AcidAttribute;
use Adue\EviniResenas\Comments\FruityAttribute;
use Adue\EviniResenas\Comments\RatingAttribute;
use Adue\EviniResenas\Comments\SweetAttribute;
use Adue\EviniResenas\Comments\WoodyAttribute;
use Adue\WordPressBasePlugin\Helpers\Traits\UseLoader;
use Adue\WordPressBasePlugin\Helpers\Traits\UseView;

class Attributes
{
    use UseLoader, UseView;

    private $attributes = [];

    public function __construct()
    {
        $this->attributes = [
            new AcidAttribute(),
            new SweetAttribute(),
            new WoodyAttribute(),
            new FruityAttribute(),
            new RatingAttribute()
        ];
    }

    public static function registerAttributes()
    {
        $object = new self;
        foreach ($object->attributes as $attribute) {
            $attribute->register();
        }
        self::registerShowAttributesFunction();
    }

    public static function registerShowAttributesFunction()
    {
        $object = new self;
        $object->loader()->addAction('woocommerce_after_add_to_cart_form', $object, 'showAttributes');
    }

    public function showAttributes()
    {
        $averages = [];
        $comments = get_comments();
        foreach ($comments as $comment) {
            foreach ($this->attributes as $attribute) {
                if(!$attribute->showAttr)
                    continue;
                if(!isset($averages[$attribute->getKey()])) $averages[$attribute->getKey()] = [
                    'name' => $attribute->name,
                    'sum' => 0,
                    'count' => 0
                ];
                if($value = get_comment_meta( $comment->comment_ID, $attribute->getKey(), true )) {
                    $averages[$attribute->getKey()]['sum'] += $value;
                    $averages[$attribute->getKey()]['count']++;
                }
            }
        }

        $this->view()->set('averages', $averages);
        $this->view()->render('public/comment_meta/show');
    }

}