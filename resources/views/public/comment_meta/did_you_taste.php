<label>¿Probaste el vino?</label>
<div id="wine_tasted-container" class="radio-toolbar">
    <input type="radio" id="radioSi" name="<?php echo $key; ?>" value="si" onchange="wineTastedChange()" checked>
    <label for="radioSi">SÍ</label>

    <input type="radio" id="radioNo" name="<?php echo $key; ?>" value="no" onchange="wineTastedChange()">
    <label for="radioNo">NO</label>
</div>
<p>&nbsp;</p>