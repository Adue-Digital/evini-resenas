<?php global $current_user, $post; ?>

<h2><?php echo $post->post_title; ?></h2>

<p>Gracias por comprar en Evini, tu opinión nos importa y nos ayuda a mejorar</p>

<?php if(!$hasComment) : ?>
<div id="order-review-container">
    <form id="order-review-form" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post">
        <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>">
        <input type="hidden" name="action" value="save-reviews">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'my-ajax-nonce' ); ?>">
        <div class="paginator"></div>
        <div id="order-review-stepper">
            <?php foreach ($products as $id => $product) : ?>

            <header>
            </header>

            <section class="product-step">
                <a href="<?php echo $product->get_product()->get_permalink(); ?>" target="_blank">
                    <?php echo $product->get_product()->get_image( 'woocommerce_thumbnail' ); ?>
                </a>
                <p>
                    <a href="<?php echo $product->get_product()->get_permalink(); ?>" target="_blank">
                        <?php echo $product->get_name(); ?>
                    </a>
                </p>
                <?php
                    $usercomment = get_comments( array (
                        'user_id' => $current_user->ID,
                        'post_id' => $product->get_product()->get_id(),
                        'meta_query' => [
                            [
                                'key' => 'order_id',
                                'value' => $_GET['order_id']
                            ]
                        ]
                    ));

                    if ( $usercomment ) : ?>
                        <p>Ya realizaste tu reseña de este producto</p>
                    <?php else : ?>

                        <p><strong>¿Qué te pareció el vino?</strong></p>

                        <div class="rating-container">
                            <input id="custom-rating-<?php echo $product->get_product()->get_id(); ?>" class="product-rating" name="rating-<?php echo $product->get_product()->get_id(); ?>" type="hidden" value="0">
                            <div class="my-rating-8" data-id="<?php echo $product->get_product()->get_id(); ?>"></div>
                            <p>
                                <span style="float: left;">Malo</span>
                                <span style="float: right;">Excelente</span>
                            </p>
                            <a href="#" class="remove-rating" style="display: none;" data-id="<?php echo $product->get_product()->get_id(); ?>">Eliminar voto</a>
                        </div>

                        <div class="clear">
                            <p><strong>¿Qué sabores encontraste?</strong></p>
                        </div>

                        <?php foreach ($metas as $key => $meta) : ?>
                            <div class="row form-group wine-attribute-container">
                                <div class="col-12">
                                    <label for="rating" class="range-label"><?php echo $meta; ?><span class="required">*</span></label>
                                    <div class="range-container">
                                        <input type="range" min="0" max="100" value="0" class="resena-slider" id="resena-<?php echo $key; ?>-<?php echo $product->get_product()->get_id(); ?>" name="<?php echo $key; ?>-<?php echo $product->get_product()->get_id(); ?>" oninput="onChangeSlider(this)" onload="onChangeSlider(this)">
                                        <output class="resena-value">0 %</output>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <p><strong>Agrega un comentario</strong></p>
                        <textarea name="comment-<?php echo $product->get_product()->get_id(); ?>" class="comment" rows="8"></textarea>

                        <div class="alert alert-danger error-message" style="display: none;"></div>
                    <?php endif; ?>
            </section>
            <?php endforeach; ?>
        </div>

    </form>
</div>
<?php endif; ?>

<div id="order-review-thanks" <?php if(!$hasComment) : ?>style="display: none"<?php endif; ?>>
    <p>Tu opinión ha sido enviada, muchas gracias</p>
</div>
<div id="loader" style="display: none">Cargando...</div>