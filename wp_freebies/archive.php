<?php 
/* Template Name: Archive Team*/ 
?>
<?php get_header(); ?>
 
	<?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        // WP_Query arguments
        $args = array (
            'post_type'      => array( 'team' ),
            'post_status'    => array( 'publish' ),
            'posts_per_page' => 3,
            'paged'          => $paged,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        // The Query
        $post_query = new WP_Query( $args );?>
        <div class="container">
            <?php if ( $post_query->have_posts() ) : ?>
        
            <header class="page-header">
                <?php
                the_title( '<h1 class="page-title">', '</h1>' );
                ?>
            </header>

            <?php
            // Start the Loop.
            while ( $post_query->have_posts() ) :
                // You can list your posts here
                $post_query->the_post();
                ?>
                <div class="archive-item">
                    <div class="post-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </div>

                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                    </div>

                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php
            endwhile;  ?>
            <div class="post-nav">
                <?php custom_post_pagination(); ?>
            </div>
            <?php else :
                // No Post Found
            endif;

            // Restore original Post Data
            wp_reset_postdata();?>
        </div>
<?php get_footer(); ?>