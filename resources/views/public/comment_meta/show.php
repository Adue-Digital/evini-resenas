<h2>¿Qué sabor tiene este vino?</h2>
<p>Basado en la opinión de nuestros sommeliers</p>
<?php foreach ($averages as $key => $average) : ?>
    <div class="row form-group">
        <div class="col-12">
            <strong><?php echo $average['name']; ?> - <?php echo ($average['sum'] / $average['count']); ?> %</strong><br>
            <div class="progress-light-grey progress-round">
                <div class="progress-container progress-round progress-color" style="width:<?php echo ($average['sum'] / $average['count']); ?>%"></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>