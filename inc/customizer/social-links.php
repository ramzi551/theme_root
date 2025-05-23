<?php
/**
 * تطبيق إعدادات الروابط الاجتماعية
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * إضافة إعدادات الروابط الاجتماعية إلى لوحة تخصيص ووردبرس
 */
function professional_theme_social_links_options($wp_customize) {
    
    // ===== قسم الروابط الاجتماعية =====
    $wp_customize->add_section('professional_theme_social_links', array(
        'title'       => __('روابط التواصل الاجتماعي', 'professional-theme'),
        'description' => __('إضافة روابط حسابات التواصل الاجتماعي الخاصة بك.', 'professional-theme'),
        'priority'    => 95,
    ));
    
    // Facebook
    $wp_customize->add_setting('social_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('social_facebook', array(
        'label'       => __('رابط Facebook', 'professional-theme'),
        'section'     => 'professional_theme_social_links',
        'type'        => 'url',
        'priority'    => 10,
    ));
    
    // Twitter
    $wp_customize->add_setting('social_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('social_twitter', array(
        'label'       => __('رابط Twitter', 'professional-theme'),
        'section'     => 'professional_theme_social_links',
        'type'        => 'url',
        'priority'    => 20,
    ));
    
    // Instagram
    $wp_customize->add_setting('social_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('social_instagram', array(
        'label'       => __('رابط Instagram', 'professional-theme'),
        'section'     => 'professional_theme_social_links',
        'type'        => 'url',
        'priority'    => 30,
    ));
    
    // LinkedIn
    $wp_customize->add_setting('social_linkedin', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('social_linkedin', array(
        'label'       => __('رابط LinkedIn', 'professional-theme'),
        'section'     => 'professional_theme_social_links',
        'type'        => 'url',
        'priority'    => 40,
    ));
    
    // YouTube
    $wp_customize->add_setting('social_youtube', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('social_youtube', array(
        'label'       => __('رابط YouTube', 'professional-theme'),
        'section'     => 'professional_theme_social_links',
        'type'        => 'url',
        'priority'    => 50,
    ));
    
    // Pinterest
    $wp_customize->add_setting('social_pinterest', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('social_pinterest', array(
        'label'       => __('رابط Pinterest', 'professional-theme'),
        'section'     => 'professional_theme_social_links',
        'type'        => 'url',
        'priority'    => 60,
    ));
    
    // TikTok
    $wp_customize->add_setting('social_tiktok', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('social_tiktok', array(
        'label'       => __('رابط TikTok', 'professional-theme'),
        'section'     => 'professional_theme_social_links',
        'type'        => 'url',
        'priority'    => 70,
    ));
}
add_action('customize_register', 'professional_theme_social_links_options');
