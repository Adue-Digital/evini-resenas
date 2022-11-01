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
            $this->view()->render('public/order_review/order_review');
        }
    }

    private function canReviewOrder($order)
    {
        if(!is_user_logged_in())
            return false;

        return $order->get_user_id() == get_current_user_id();
    }

}