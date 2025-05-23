<?php
/**
 * نموذج البحث
 *
 * @package ProfessionalTheme
 */

if (!defined('ABSPATH')) {
    exit; // الخروج إذا تم الوصول مباشرة
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x('بحث عن:', 'label', 'professional-theme'); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('بحث...', 'placeholder', 'professional-theme'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">
        <i class="fas fa-search"></i>
        <span class="screen-reader-text"><?php echo _x('بحث', 'submit button', 'professional-theme'); ?></span>
    </button>
</form>