<?php

namespace Adue\EviniResenas\Frontend;

use Adue\WordPressBasePlugin\Helpers\Traits\UseView;
use Adue\WordPressBasePlugin\Modules\Misc\BaseShortcode;

class OrderReviewShortcode extends BaseShortcode
{
    use UseView;

    protected $signature = 'order-review';

    public function run($attr)
    {
        $orderId = $_GET['order_id'] ?? 0;
        $order = wc_get_order($orderId);

        if(!$this->canReviewOrder($order)) {
            $this->view()->render('public/order_review/no_order');
        } else {
            $this->view()->set('products', $order->get_items());
            $this->view()->set('metas', [
                'sweet' => 'Dulce',
                'woody' => 'Amaderado',
                'fruity' => 'Frutado',
                'acid' => 'Ácido',
            ]);

            $hasComment = get_comments( array (
                'user_id' => get_current_user_id(),
                'meta_query' => [
                    [
                        'key' => 'order_id',
                        'value' => $_GET['order_id']
                    ]
                ]
            ));

            $this->view()->set('hasComment', $hasComment);

            $this->view()->render('public/order_review/order_review_stepper');
        }
    }

    private function canReviewOrder($order)
    {
        if(!is_user_logged_in() || !$order)
            return false; //TODO CHANGE TO FALSE

        return $order->get_user_id() == get_current_user_id();
    }

}