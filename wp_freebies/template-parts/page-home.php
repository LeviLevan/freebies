<?php /* Template Name: Home page */ ?>
<?php get_header(); ?>

<?php
if (have_rows('constructor_home_page_data')) {
    while (have_rows('constructor_home_page_data')) {
        the_row();
        switch (get_row_layout()) {
            case 'team_section':
                $team_section_vision = get_sub_field('turn_on');
                if ($team_section_vision == true) {
                    $query = new WP_Query(array(
                        'post_type' => 'team',
                        'posts_per_page' =>3,
                        'orderby'     => 'date',
                        'order'       => 'DESC',
                    ));
                    if ($query->have_posts()) : ?>
                        <section class="container-fluid team">
                            <div class="container">
                                  <div class="title-subtitle-section">
                                    <span><?php the_sub_field('team_subtitle'); ?></span>
                                    <h2><?php the_sub_field('team_title'); ?></h2>
                                    <hr class="red">
                                    <p><?php the_sub_field('team_description'); ?></p>
                                  </div>
                                  <div class="row">
                                    <?php while ($query->have_posts()): $query->the_post();?>
                                    <div class="col-12 col-md-4 box-item-team">
                                        <div class="team-image-container">
                                          <div class="background-team"></div>
                                            <div style="background-image: url(<?php the_post_thumbnail_url(); ?>)" class="team-img">
                                                <?php $rows = get_field('team_socials');
                                                    if( $rows ) {
                                                        echo '<ul class="team_socials">';
                                                        foreach( $rows as $row ) {
                                                            $team_icon = $row['team_icon'];
                                                            echo '<li><a href="#">';
                                                                echo $team_icon;
                                                            echo '</a></li>';
                                                        }
                                                        echo '</ul>';
                                                    }; 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="content-social">
                                            <a href="<?php the_permalink(); ?>">
                                              <span class="name"><?php the_title(); ?></span>
                                              <span class="position"><?php the_field('team_position'); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php endwhile; ?>
                                  </div>
                                <div class="button_team">
                                    <a href="<?php the_sub_field('button_all_team'); ?>">All Team</a>
                                </div>
                            </div>   
                        </section>                
                    <?php endif; ?>
                    <?php wp_reset_postdata();
                }
                break;
            case 'posts_section': 
            $posts_section_vision = get_sub_field('turn_on');
                if ($posts_section_vision == true) {
                    $query = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' =>3,
                        'orderby'     => 'date',
                        'order'       => 'DESC',
                    ));
                    if ($query->have_posts()) : ?>
                    <section class="posts">
                        <div class="container">
                          <div class="title-subtitle-section">
                            <span><?php the_sub_field('post_subtitle'); ?></span>
                            <h2><?php the_sub_field('post_title'); ?></h2>
                            <hr class="red">
                          </div>
                          <div class="row">
                            <?php while ($query->have_posts()): $query->the_post();?>
                            <div class="col-12 col-md-4">
                              <article>
                                <img title="posts" class="img-fluid" src="<?php the_post_thumbnail_url(); ?>">
                                <time><?php echo get_the_date('d F');?></time>
                                <header>
                                  <h4><a href="#"><?php the_title();?></a></h4>
                                </header>
                                <p><?php the_content();?></p>
                              </article>
                            </div>
                            <?php endwhile; ?>
                          </div>
                          <div class="button_team">
                            <a href="<?php the_sub_field('button_all_posts'); ?>">All Posts</a>
                          </div>
                        </div>   
                    </section>
                <?php endif;
                wp_reset_postdata();
            }
            break;   
        }
    }
}
?>

<?php get_footer(); ?>