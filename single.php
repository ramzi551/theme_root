<?php
/**
 * نموذج عرض المقال المفرد
 *
 * @package YourThemeName
 */

get_header();
?>

<div class="container">
    <div class="content-area">
        <main id="main" class="site-main">

            <?php
            while (have_posts()) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

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
                            <?php if (has_tag()) : ?>
                                <span class="post-tags">
                                    <i class="fas fa-tags"></i>
                                    <?php the_tags('', ', ', ''); ?>
                                </span>
                            <?php endif; ?>
                        </div><!-- .post-meta -->
                    </header><!-- .entry-header -->

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('post-full'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content(
                            sprintf(
                                wp_kses(
                                    /* translators: %s: Name of current post. */
                                    __('استمر في القراءة %s <span class="meta-nav">&rarr;</span>', 'your-theme'),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                the_title('<span class="screen-reader-text">"', '"</span>', false)
                            )
                        );
                        
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('الصفحات:', 'your-theme'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <?php
                        // نظام مشاركة المقال
                        if (function_exists('your_theme_social_share')) {
                            your_theme_social_share();
                        }
                        ?>
                        
                        <div class="author-bio">
                            <h3><?php _e('عن الكاتب', 'your-theme'); ?></h3>
                            <div class="author-info">
                                <div class="author-avatar">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
                                </div>
                                <div class="author-description">
                                    <h4><?php echo get_the_author(); ?></h4>
                                    <p><?php echo get_the_author_meta('description'); ?></p>
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="author-link">
                                        <?php printf(__('شاهد جميع مقالات %s', 'your-theme'), get_the_author()); ?>
                                    </a>
                                </div>
                            </div>
                        </div><!-- .author-bio -->
                        
                        <?php
                        // المقالات ذات الصلة
                        your_theme_related_posts();
                        ?>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->

                <?php
                // إذا كانت التعليقات مفعلة أو كان هناك تعليق واحد على الأقل
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                
                // التنقل بين المقالات
                the_post_navigation(array(
                    'prev_text' => '<span class="nav-subtitle">' . __('المقال السابق:', 'your-theme') . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . __('المقال التالي:', 'your-theme') . '</span> <span class="nav-title">%title</span>',
                ));

            endwhile; // نهاية الحلقة
            ?>

        </main><!-- #main -->
    </div><!-- .content-area -->

    <?php get_sidebar(); ?>
</div><!-- .container -->

<?php
get_footer();