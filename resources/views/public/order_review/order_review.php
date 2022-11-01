<?php global $current_user, $post; ?>

<h2><?php echo $post->post_title; ?></h2>

<p>Gracias por comprar en Evini, tu opinión nos importa y nos ayuda a mejorar</p>

<?php foreach ($products as $product) : ?>

<h3><?php echo $product->get_name(); ?></h3>

<?php
    $usercomment = get_comments( array (
        'user_id' => $current_user->ID,
        'post_id' => $product->get_product()->get_id(),
    ) );

    // If the user has commented, output a message.
    if ( $usercomment ) {
        echo '<p>Ya realizaste tu reseña de este producto</p>';
    } else { // Otherwise, show the comment form.
        comment_form([], $product->get_product()->get_id());
    }
?>

<?php endforeach; ?>
