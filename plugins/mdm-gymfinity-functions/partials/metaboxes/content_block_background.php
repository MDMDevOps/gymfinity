<div class="mdm-metabox">
	<p>
		<label for="bgcolor" class="post-attributes-label">Background Color</label>
	</p>

	<input type="text" class="color-field" name="bgcolor" id="bgcolor" value="<?php echo $bgcolor; ?>">

	<p>
		<label for="bgimage" class="post-attributes-label">Background image</label>
	</p>

	<div class="image-preview">
	    <div class="image-background">
	        <a class="choose" href="#" data-action="choose"><img data-default="<?php echo esc_url_raw( $default ); ?>" id="preview" src="<?php echo esc_url_raw( $preview ); ?>"></a>
	        <input type="text" class="hidden" name="bgimage" id="bgimage" data-input="src" value="<?php echo $bgimage; ?>">
	    </div>
	</div>
	<p class="howto"><?php _e( 'Click the image to edit or update', parent::$plugin_name ); ?></p>
	<div class="buttons">
		<button data-action="remove" class="button button-default button-block">Remove Image</button>
	</div>
</div>