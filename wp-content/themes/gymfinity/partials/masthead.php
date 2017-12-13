<?php if ( is_active_sidebar( 'masthead-widget-area' ) ) : ?>
    <div class="title-banner">
    	<div class="wrapper">
    		<div class="row">
    			<div class="column bannerwrapper">
    				<?php dynamic_sidebar( 'masthead-widget-area' ); ?>
    			</div>
    		</div>
    	</div>
    </div>
<?php endif; ?>