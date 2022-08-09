<div class="site-logo">
	<?php if( has_custom_logo() ): the_custom_logo(); ?>
    <?php else: ?>
    	<a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
	<?php endif; ?>
</div>
