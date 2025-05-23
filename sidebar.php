<?php
/**
 * الشريط الجانبي (السايدبار)
 *
 * @package ProfessionalTheme
 */

if (!defined('ABSPATH')) {
    exit; // الخروج إذا تم الوصول مباشرة
}

// التحقق مما إذا كان السايدبار مفعل ويحتوي على ودجات
if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside><!-- #secondary -->