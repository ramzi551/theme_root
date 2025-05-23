<?php
/**
 * ملف الهيدر الرئيسي المحسن
 * يقوم بتحميل نمط الهيدر المناسب بناءً على إعدادات المستخدم
 * ويظهر قسم الهيرو فقط في الصفحة الرئيسية (إذا كان مفعلًا)
 *
 * @package ProfessionalTheme
 * @version 2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // الخروج إذا تم الوصول مباشرة
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>

<div id="page" class="site">
    <?php
    // --- بداية الجزء الخاص بعرض الهيدر المرئي وقسم الهيرو ---

    // التحقق إذا كان هيدر المستخدم المخصص مفعلاً
    if ( get_theme_mod( 'enable_user_header', false ) ) {
        // إذا كان هيدر المستخدم مفعلاً، قم بتحميله
        // الهيدر نفسه (الشعار، القائمة) سيظهر في جميع الصفحات إذا كان enable_user_header مفعل
        get_template_part( 'template-parts/header/header', 'user' );

        // الآن، تحقق إذا كان يجب عرض قسم الهيرو الخاص بهيدر المستخدم وفي الصفحة الرئيسية فقط
        // و (اختياري) إذا كان WooCommerce مفعلًا
        if ( is_front_page() && get_theme_mod( 'user_header_show_hero', false ) /* && class_exists('WooCommerce') */ ) {
            // يفترض أن لديك ملف قالب لجزء الهيرو الخاص بهيدر المستخدم، مثلاً:
            get_template_part( 'template-parts/header/hero', 'user' ); // أو اسم ملف الهيرو الخاص بالمستخدم
        }

    } else {
        // إذا لم يكن هيدر المستخدم مفعلاً، استخدم الهيدر العام
        // الهيدر العام نفسه (الشعار، القائمة) سيظهر في جميع الصفحات
        $header_style = get_theme_mod( 'header_style', 'classic' );

        // تحميل الشريط العلوي العام فقط إذا لم يكن هيدر المستخدم مفعلًا (سيظهر في كل الصفحات إذا كان مفعلًا)
        if ( get_theme_mod( 'show_topbar', true ) ) {
            get_template_part( 'template-parts/header/components/topbar' );
        }

        switch ( $header_style ) {
            case 'modern':
                get_template_part( 'template-parts/header/header', 'modern' );
                break;
            case 'centered':
                get_template_part( 'template-parts/header/header', 'centered' );
                break;
            case 'classic':
            default:
                get_template_part( 'template-parts/header/header', 'classic' );
                break;
        }

        // عرض قسم الهيرو العام فقط إذا كان مفعلاً وفي الصفحة الرئيسية
        // و (اختياري) إذا كان WooCommerce مفعلًا
        if ( is_front_page() && get_theme_mod( 'general_header_show_hero', false ) /* && class_exists('WooCommerce') */ ) {
            get_template_part( 'template-parts/header/hero-section' ); // هذا هو ملف الهيرو الذي أرسلته سابقًا
        }
    }
    // --- نهاية الجزء الخاص بعرض الهيدر المرئي وقسم الهيرو ---
    ?>

    <div id="content" class="site-content">
        <?php // محتوى الصفحة يبدأ هنا ?>