<?php

namespace Adue\EviniResenas\Frontend;

use Adue\WordPressBasePlugin\Helpers\Traits\UseLoader;

class OrderReviewActions
{
    use UseLoader;

    public static function register()
    {
        $self = new self();
        $self->loader()->addAction('wp_ajax_nopriv_save-reviews', $self, 'saveReviews');
        $self->loader()->addAction('wp_ajax_save-reviews', $self, 'saveReviews');
    }

    public function saveReviews()
    {
        $nonce = sanitize_text_field( $_POST['nonce'] );

        if ( ! wp_verify_nonce( $nonce, 'my-ajax-nonce' ) ) {
            die ( 'Busted!');
        }

        $orderId = $_POST['order_id'] ?? 0;
        $order = wc_get_order($orderId);

        if(!$this->canReviewOrder($order)) {
            echo json_encode(['success' => false, 'message' => 'La orden no pertenece al usuario actual']);
            wp_die();
        }

        try {
            $products = $order->get_items();

            foreach ($products as $product) {

                $rating = isset($_POST['rating-'.$product->get_product()->get_id()]) && $_POST['rating-'.$product->get_product()->get_id()] ? $_POST['rating-'.$product->get_product()->get_id()] : 0;
                $sweet = isset($_POST['sweet-'.$product->get_product()->get_id()]) && $_POST['sweet-'.$product->get_product()->get_id()] ? $_POST['sweet-'.$product->get_product()->get_id()] : 0;
                $acid = isset($_POST['acid-'.$product->get_product()->get_id()]) && $_POST['acid-'.$product->get_product()->get_id()] ? $_POST['acid-'.$product->get_product()->get_id()] : 0;
                $fruity = isset($_POST['fruity-'.$product->get_product()->get_id()]) && $_POST['fruity-'.$product->get_product()->get_id()] ? $_POST['fruity-'.$product->get_product()->get_id()] : 0;
                $woody = isset($_POST['woody-'.$product->get_product()->get_id()]) && $_POST['woody-'.$product->get_product()->get_id()] ? $_POST['woody-'.$product->get_product()->get_id()] : 0;

                wp_insert_comment([
                    'comment_post_ID' => $product->get_product()->get_id(),
                    'comment_content' => $_POST['comment-'.$product->get_product()->get_id()],
                    'comment_meta' => [
                        'order_id' => $orderId,
                        'rating' => $rating,
                        'wine_tasted' => 'si',
                        'sweet' => $sweet,
                        'acid' => $acid,
                        'fruity' => $fruity,
                        'woody' => $woody,
                    ],
                    'user_id' => get_current_user_id()
                ]);
            }
            echo json_encode(['success' => true, 'message' => '']);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }

        wp_die();
    }

    private function canReviewOrder($order)
    {
        if(!is_user_logged_in() || !$order)
            return false; //TODO CHANGE TO FALSE

        return $order->get_user_id() == get_current_user_id();
    }
}