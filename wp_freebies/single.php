<?php include 'header.php'; ?>

<?php 
	wp_reset_query();
	$query = new WP_Query(array(
        'post_type' => 'post',
        'orderby'   => 'date',
        'order'     => 'DESC',
    ));
?>

	<main class="container-fluid">
		<div class="container">
			<?php if ($query->have_posts()) : ?>
			<div class="single-post-section">
				<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');?>
					<div class="row post">
						<div class="col-ls-12 col-md-8">
							<h3><?php the_title(); ?></h3>
							<div class="description">
								<?php the_content(); ?>
							</div>
						</div>
						<div class="col-ls-12 col-md-4">
							<img class="single-img-post" src="<?php echo $large_image_url[0]; ?>" alt="<?php the_title(); ?>" />
						</div>
					</div>
			</div>
			<?php endif; ?>
		</div>
	</main>
									
					
<?php include 'footer.php'; ?>