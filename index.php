<?php
/**
 * الصفحة الرئيسية للمدونة
 *
 * @package YourThemeName
 */

get_header();
?>

<div class="container">
    <div class="content-area">
        <main id="main" class="site-main">

            <?php if (have_posts()) : ?>

                <header class="page-header">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header><!-- .page-header -->

                <div class="posts-grid">
                    <?php
                    /* بداية الحلقة */
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('post-thumbnail'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="post-content">
                                <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>

                                <div class="post-meta">
                                    <span class="post-date">
                                        <i class="far fa-calendar-alt"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="post-author">
                                        <i class="far fa-user"></i>
                                        <?php the_author(); ?>
                                    </span>
                                    <?php if (has_category()) : ?>
                                        <span class="post-categories">
                                            <i class="far fa-folder-open"></i>
                                            <?php the_category(', '); ?>
                                        </span>
                                    <?php endif; ?>
                                </div><!-- .post-meta -->

                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div><!-- .post-excerpt -->

                                <a href="<?php the_permalink(); ?>" class="btn btn-primary read-more">
                                    <?php esc_html_e('اقرأ المزيد', 'your-theme'); ?>
                                </a>
                            </div><!-- .post-content -->
                        </article><!-- #post-<?php the_ID(); ?> -->
                        <?php
                    endwhile;
                    ?>
                </div><!-- .posts-grid -->

                <div class="pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => __('السابق', 'your-theme'),
                        'next_text' => __('التالي', 'your-theme'),
                    ));
                    ?>
                </div><!-- .pagination -->

            <?php else : ?>

                <p><?php esc_html_e('لم يتم العثور على مقالات.', 'your-theme'); ?></p>

            <?php endif; ?>

        </main><!-- #main -->
    </div><!-- .content-area -->

    <?php get_sidebar(); ?>
</div><!-- .container -->

<?php
get_footer();