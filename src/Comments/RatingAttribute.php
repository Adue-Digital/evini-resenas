<?php

namespace Adue\EviniResenas\Comments;

use Adue\WordPressBasePlugin\Helpers\Traits\UseView;
use Adue\WordPressBasePlugin\Modules\Registers\Comments\BaseCommentMeta;

class RatingAttribute extends BaseCommentMeta
{
    use UseView;

    protected $needLogin = 'both';
    protected $key = 'rating';
    public $showAttr = false;

    public function getKey()
    {
        return $this->key;
    }

    public function registerCommentMeta()
    {
        if(is_product()) return;
        ?>
        <script id='wc-single-product-js-extra'>
            var wc_single_product_params = {"i18n_required_rating_text":"Por favor selecciona una puntuaci\u00f3n","review_rating_required":"yes","flexslider":{"rtl":false,"animation":"slide","smoothHeight":true,"directionNav":false,"controlNav":"thumbnails","slideshow":false,"animationSpeed":500,"animationLoop":false,"allowOneSlide":false},"zoom_enabled":"","zoom_options":[],"photoswipe_enabled":"","photoswipe_options":{"shareEl":false,"closeOnScroll":false,"history":false,"hideAnimationDuration":0,"showAnimationDuration":0},"flexslider_enabled":""};

            jQuery(".stars").hide();
            jQuery(".stars.selected").show();
        </script>
        <?php
        echo '<div class="comment-form-rating">
            <label for="rating">Tu puntuación&nbsp;<span class="required">*</span></label>
                <p class="stars selected">
                    <span>
                    <a class="star-1" href="#">1</a>
                    <a class="star-2" href="#">2</a>
                    <a class="star-3" href="#">3</a>
                    <a class="star-4" href="#">4</a>
                    <a class="star-5 active" href="#">5</a>
                    </span>
                </p>
                <select name="rating" id="rating" required="" style="display: none;">
                    <option value="">Puntuar…</option>
                    <option value="5">Perfecto</option>
                    <option value="4">Bueno</option>
                    <option value="3">Normal</option>
                    <option value="2">No está tan mal</option>
                    <option value="1">Muy pobre</option>
                </select>
            </div>';
    }
}