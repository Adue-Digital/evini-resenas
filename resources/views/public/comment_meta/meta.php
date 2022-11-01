<div class="row form-group">
    <div class="col-12">
        <label for="rating"><?php echo $name; ?><span class="required">*</span></label>
        <div class="range-container">
            <input type="range" min="0" max="100" value="0" class="resena-slider form-range" id="resena-<?php echo $key; ?>" name="<?php echo $key; ?>" oninput="this.nextElementSibling.value = this.value">
            <output class="resena-value">0</output>
        </div>
    </div>
</div>