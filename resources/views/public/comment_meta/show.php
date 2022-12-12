<?php if($showData) : ?>
    <div id="progress-bars">
        <h2>¿Qué sabor tiene este vino?</h2>
        <p>Basado en la opinión de las personas que lo probaron</p>
        <?php foreach ($averages as $key => $average) : if(!$average['count']) continue; ?>
            <div class="row form-group">
                <div class="col-12">
                    <strong><?php echo $average['name']; ?> - <?php echo round($average['sum'] / $average['count'], 2); ?> %</strong><br>
                    <div class="progress-light-grey progress-round">
                        <div class="progress-container progress-round progress-color" data-width="<?php echo ($average['sum'] / $average['count']); ?>" style="width: 0%;"></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>