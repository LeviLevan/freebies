<?php get_header(); ?>
	<div class="container-fluid">
		<div class="container">
			<?php
				if ( have_posts() ){
					while ( have_posts() ){
						the_post();

						echo '<h3><a href="'. get_permalink() .'">'. get_the_title() .'</a></h3>';

						echo '<p>'.get_the_excerpt().'</p>';
					} ?>
					<div class="post-nav">
						<?php post_pagination();?>
					</div>
				<?php }
				else{
					echo ' <p>Posts not founds...</p>';
				}
			?>
		</div>
	</div>
<?php get_footer(); ?>