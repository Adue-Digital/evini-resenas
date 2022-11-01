<h2>No se puede mostrar la orden</h2>

<?php if(!is_user_logged_in()) : ?>

    <p>Debes iniciar sesión para poder realizar la reseña</p>

    <?php echo wp_login_form(); ?>

<?php else : ?>

    <p>La orden no pertenece al usuario loggeado</p>

<?php endif; ?>
