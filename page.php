<?php
/**
 * قالب الصفحة العادية
 *
 * @package ProfessionalTheme
 */

if (!defined('ABSPATH')) {
    exit; // الخروج إذا تم الوصول مباشرة
}

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="page-content-wrapper">
                <div class="page-main-content">
                    <?php
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            </header><!-- .entry-header -->

                            <?php if (has_post_thumbnail()) : ?>
                                <div class="featured-image">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="entry-content">
                                <?php
                                the_content();

                                wp_link_pages(array(
                                    'before' => '<div class="page-links">' . esc_html__('الصفحات:', 'professional-theme'),
                                    'after'  => '</div>',
                                ));
                                ?>
                            </div><!-- .entry-content -->

                            <?php if (get_edit_post_link()) : ?>
                                <footer class="entry-footer">
                                    <?php
                                    edit_post_link(
                                        sprintf(
                                            wp_kses(
                                                /* translators: %s: Name of current post. Only visible to screen readers */
                                                __('تعديل <span class="screen-reader-text">%s</span>', 'professional-theme'),
                                                array(
                                                    'span' => array(
                                                        'class' => array(),
                                                    ),
                                                )
                                            ),
                                            get_the_title()
                                        ),
                                        '<span class="edit-link">',
                                        '</span>'
                                    );
                                    ?>
                                </footer><!-- .entry-footer -->
                            <?php endif; ?>
                        </article><!-- #post-<?php the_ID(); ?> -->

                        <?php
                        // إذا كانت التعليقات مفتوحة أو هناك تعليق واحد على الأقل
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                    endwhile; // نهاية الحلقة
                    ?>
                </div><!-- .page-main-content -->

                <?php get_sidebar(); ?>
            </div><!-- .page-content-wrapper -->
        </div><!-- .container -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();