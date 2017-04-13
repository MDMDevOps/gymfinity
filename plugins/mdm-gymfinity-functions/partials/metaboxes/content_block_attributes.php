<p>
	<label for="block_template" class="post-attributes-label">Template</label>
</p>
<select name="block_template" id="block_template" class="widefat">
	<?php foreach($templates as $template => $path ): ?>
		<?php printf( '<option value="%1$s"%2$s>%1$s</option>', $template, ( $selected === $template ) ? ' selected' : '' ) ?>
	<?php endforeach; ?>
</select>
