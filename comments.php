<?php
/**
 * قالب التعليقات
 *
 * @package ProfessionalTheme
 */

if (!defined('ABSPATH')) {
    exit; // الخروج إذا تم الوصول مباشرة
}

/*
 * إذا كانت التعليقات محمية بكلمة مرور والزائر لم يدخل كلمة المرور،
 * ارجع إلى نموذج كلمة المرور.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // عنوان التعليقات مع عدد التعليقات
    if (have_comments()) :
        ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('تعليق واحد على "%1$s"', 'professional-theme'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    esc_html(_n('%1$s تعليق على "%2$s"', '%1$s تعليقات على "%2$s"', $comment_count, 'professional-theme')),
                    number_format_i18n($comment_count),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2><!-- .comments-title -->

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size' => 60,
                'reply_text' => __('رد', 'professional-theme'),
            ));
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // إذا كانت التعليقات مغلقة وهناك تعليقات
        if (!comments_open()) :
            ?>
            <p class="no-comments"><?php esc_html_e('التعليقات مغلقة.', 'professional-theme'); ?></p>
            <?php
        endif;

    endif; // Check for have_comments().

    // نموذج ترك تعليق
    comment_form(array(
        'title_reply'         => __('اترك تعليقاً', 'professional-theme'),
        'title_reply_to'      => __('اترك تعليقاً لـ %s', 'professional-theme'),
        'title_reply_before'  => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'   => '</h3>',
        'comment_notes_before' => '<p class="comment-notes">' . __('لن يتم نشر بريدك الإلكتروني.', 'professional-theme') . '</p>',
        'comment_field'       => '<p class="comment-form-comment"><label for="comment">' . __('التعليق', 'professional-theme') . '</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>',
        'must_log_in'         => '<p class="must-log-in">' . sprintf(__('يجب أن تكون <a href="%s">مسجل الدخول</a> لترك تعليق.', 'professional-theme'), wp_login_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
        'logged_in_as'        => '<p class="logged-in-as">' . sprintf(__('تم تسجيل دخولك كـ <a href="%1$s">%2$s</a>. <a href="%3$s" title="تسجيل الخروج من هذا الحساب">تسجيل الخروج؟</a>', 'professional-theme'), admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
        'label_submit'        => __('إرسال التعليق', 'professional-theme'),
        'class_submit'        => 'submit btn btn-primary',
    ));
    ?>

</div><!-- #comments -->