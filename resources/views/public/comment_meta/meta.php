<div class="row form-group wine-attribute-container">
    <div class="col-12">
        <label for="rating"><?php echo $name; ?><span class="required">*</span></label>
        <div class="range-container">
            <input type="range" min="0" max="100" value="0" class="resena-slider" id="resena-<?php echo $key; ?>" name="<?php echo $key; ?>" oninput="onChangeSlider(this)" onload="onChangeSlider(this)">
            <output class="resena-value">0%</output>
        </div>
    </div>
</div>