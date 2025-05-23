<?php
/**
 * القالب الجزئي للهيدر الحديث
 *
 * @package ProfessionalTheme
 * @version 2.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // الخروج إذا تم الوصول مباشرة

$main_header_bg_color = get_theme_mod( 'main_header_bg_color', '#ffffff' );
$main_header_text_color = get_theme_mod( 'main_header_text_color', '#000000' );

// إعدادات شريط الإعلانات
$ad_bar_bg_color = get_theme_mod('ad_bar_bg_color', '#333333');
$ad_bar_text_color = get_theme_mod('ad_bar_text_color', '#ffffff');
$announcement_text = get_theme_mod( 'announcement_text', 'عروض خاصة! خصم 20% على جميع المنتجات لفترة محدودة' );
?>

<style>
/* إخفاء مربع البحث في الجوال وإظهار زر أيقونة البحث فقط */
@media (max-width: 768px) {
    .search-form-component {
        display: none !important;
    }
    .mobile-search-toggle {
        display: inline-block !important;
    }
}
/* عند الضغط على زر البحث يتم إظهار مربع البحث */
.mobile-search-active .search-form-component {
    display: block !important;
}
</style>

<header class="site-header header-style-modern" id="masthead" style="color: <?php echo esc_attr( $main_header_text_color ); ?>;">
    <!-- 1) شريط الإعلانات -->
    <div class="announcement-bar" style="background-color: <?php echo esc_attr($ad_bar_bg_color); ?>; color: <?php echo esc_attr($ad_bar_text_color); ?>;">
        <div class="container">
            <div class="announcement-content">
                <i class="fas fa-bullhorn"></i>
                <span><?php echo esc_html( $announcement_text ); ?></span>
            </div>
        </div>
    </div>

    <!-- 2) الهيدر الأوسط (Logo + Search + Icons) -->
    <div class="sticky-head" style="background-color: <?php echo esc_attr( $main_header_bg_color ); ?>;">
        <div class="header-mid">
            <div class="container">
                <div class="wrap">
                    <?php 
                    // تحميل مكون الشعار
                    get_template_part( 'template-parts/header/components/logo', '', array(
                        'wrapper_class' => 'logo-wrapper',
                        'show_tagline' => false
                    ) ); 
                    ?>

                    <!-- زر أيقونة البحث يظهر فقط في الجوال -->
                    <div class="mobile-search-toggle" style="display: none;">
                        <button id="toggleMobileSearch" style="background:none; border:none; font-size:20px; color: <?php echo esc_attr( $main_header_text_color ); ?>;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                    <?php 
                    // تحميل مكون نموذج البحث
                    get_template_part( 'template-parts/header/components/search-form', '', array(
                        'form_id' => 'modern-search-form',
                        'input_id' => 'modern-search-input',
                        'placeholder' => __( 'ابحث عن منتج...', 'professional-theme' ),
                        'wrapper_class' => 'search-form-component search-box',
                    ) ); 
                    ?>

                    <?php 
                    // تحميل مكون أيقونات الهيدر
                    get_template_part( 'template-parts/header/components/header-icons', '', array(
                        'wrapper_class' => 'header-icons-component',
                        'icons' => array(
                            'account' => true,
                            'wishlist' => true,
                            'cart' => true
                        ),
                        'show_icon_text' => true
                    ) ); 
                    ?>
                </div>
            </div>
        </div>

        <!-- 3) الهيدر السفلي (Categories + Main Menu) -->
        <div class="header-bot" style="background-color: <?php echo esc_attr( $main_header_bg_color ); ?>; border-top: 1px solid <?php echo esc_attr( professional_theme_adjust_brightness($main_header_bg_color, -20) ); ?>;">
            <div class="container">
                <div class="wrap">
                    <!-- فئات المنتجات -->
                    <div class="categories-menu-wrapper">
                        <button class="cat-btn" aria-expanded="false" aria-controls="cat-menu">
                            <i class="fas fa-bars"></i><span>فئات المنتجات</span><i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="cat-menu" id="cat-menu">
                            <?php
                            if ( class_exists( 'WooCommerce' ) ) {
                                echo '<ul>';
                                wp_list_categories( [ 'taxonomy' => 'product_cat', 'title_li' => '', 'hide_empty' => 0 ] );
                                echo '</ul>';
                            } else {
                                echo '<ul><li><a href="#">فئة 1</a></li><li><a href="#">فئة 2</a></li></ul>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- ✅ القائمة الرئيسية -->
                    <nav class="main-navigation main-menu-dropdown" aria-label="القائمة الرئيسية">
                        <div class="menu-title">
                            <a href="javascript:void(0);"><?php esc_html_e('الرئيسية', 'professional-theme'); ?> <i class="fas fa-angle-down"></i></a>
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'modern_header_menu',
                                'container' => false,
                                'menu_class' => 'dropdown-content',
                                'fallback_cb' => '__return_empty_string'
                            ]);
                            ?>
                        </div>
                    </nav>

                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->

<script>
(function(){
    // تفعيل الهيدر اللاصق
    const head = document.querySelector('.sticky-head');
    if (head) {
        const top = head.offsetTop;
        window.addEventListener('scroll', () => {
            if (window.scrollY > top) {
                head.classList.add('fixed');
            } else {
                head.classList.remove('fixed');
            }
        });
    }

    // تفعيل قائمة الفئات
    const catBtn = document.querySelector('.cat-btn');
    const catMenu = document.getElementById('cat-menu');
    if (catBtn && catMenu) {
        catBtn.addEventListener('click', e => {
            e.stopPropagation();
            const expanded = catBtn.getAttribute('aria-expanded') === 'true';
            catBtn.setAttribute('aria-expanded', !expanded);
            catMenu.classList.toggle('open');
        });

        document.addEventListener('click', e => {
            if (!catMenu.contains(e.target) && !catBtn.contains(e.target)) {
                catMenu.classList.remove('open');
                catBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // تفعيل زر البحث في الجوال
    const searchToggleBtn = document.getElementById('toggleMobileSearch');
    const headerWrap = document.querySelector('.header-mid .wrap');
    if (searchToggleBtn && headerWrap) {
        searchToggleBtn.addEventListener('click', function () {
            headerWrap.classList.toggle('mobile-search-active');
        });
    }
})();
</script>
