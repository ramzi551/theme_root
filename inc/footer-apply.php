<?php
/**
 * تطبيق إعدادات الفوتر
 * 
 * @package ProfessionalTheme
 * @version 1.0
 */

if (!defined('ABSPATH')) exit;

/**
 * إضافة CSS ديناميكي للفوتر بناءً على إعدادات التخصيص
 */
function professional_theme_footer_dynamic_css() {
    // الحصول على إعدادات الفوتر
    $footer_bg_color = get_theme_mod('footer_bg_color', '#f8f9fa');
    $footer_text_color = get_theme_mod('footer_text_color', '#333333');
    $footer_link_color = get_theme_mod('footer_link_color', '#0f766e');
    $footer_link_hover_color = get_theme_mod('footer_link_hover_color', '#0b5d55');
    $footer_logo_height = get_theme_mod('footer_logo_height', 80);
    $footer_style = get_theme_mod('footer_style', 'standard');
    
    // تطبيق الألوان على الفوتر
    ?>
    <style type="text/css">
        /* ألوان الفوتر */
        .site-footer {
            background-color: <?php echo esc_attr($footer_bg_color); ?>;
            color: <?php echo esc_attr($footer_text_color); ?>;
        }
        .site-footer a, 
        .site-footer .widget-title,
        .site-footer .footer-widget-title {
            color: <?php echo esc_attr($footer_link_color); ?>;
        }
        .site-footer a:hover, 
        .site-footer a:focus {
            color: <?php echo esc_attr($footer_link_hover_color); ?>;
        }
        
        /* تخطيط الشعار في الفوتر */
        .footer-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer-logo img.custom-footer-logo,
        .footer-logo img.custom-logo {
            max-height: <?php echo esc_attr($footer_logo_height); ?>px;
            width: auto;
            height: auto;
            display: inline-block;
        }
        
        /* تخطيط الفوتر */
        <?php
        $footer_layout = get_theme_mod('footer_layout', 'columns-4');
        switch ($footer_layout) {
            case 'columns-1':
                ?>
                .footer-widget-area {
                    flex: 1 1 100%;
                    max-width: 100%;
                }
                <?php
                break;
            case 'columns-2':
                ?>
                .footer-widget-area {
                    flex: 1 1 calc(50% - 30px);
                    max-width: calc(50% - 30px);
                }
                @media (max-width: 768px) {
                    .footer-widget-area {
                        flex: 1 1 100%;
                        max-width: 100%;
                    }
                }
                <?php
                break;
            case 'columns-3':
                ?>
                .footer-widget-area {
                    flex: 1 1 calc(33.333% - 30px);
                    max-width: calc(33.333% - 30px);
                }
                @media (max-width: 992px) {
                    .footer-widget-area {
                        flex: 1 1 calc(50% - 30px);
                        max-width: calc(50% - 30px);
                    }
                }
                @media (max-width: 768px) {
                    .footer-widget-area {
                        flex: 1 1 100%;
                        max-width: 100%;
                    }
                }
                <?php
                break;
            case 'columns-4':
            default:
                ?>
                .footer-widget-area {
                    flex: 1 1 calc(25% - 30px);
                    max-width: calc(25% - 30px);
                }
                @media (max-width: 1200px) {
                    .footer-widget-area {
                        flex: 1 1 calc(33.333% - 30px);
                        max-width: calc(33.333% - 30px);
                    }
                }
                @media (max-width: 992px) {
                    .footer-widget-area {
                        flex: 1 1 calc(50% - 30px);
                        max-width: calc(50% - 30px);
                    }
                }
                @media (max-width: 768px) {
                    .footer-widget-area {
                        flex: 1 1 100%;
                        max-width: 100%;
                    }
                }
                <?php
                break;
        }
        ?>
        
        /* أيقونات التواصل الاجتماعي */
        .footer-social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            justify-content: center;
        }
        .footer-social-icons .social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: <?php echo esc_attr($footer_link_color); ?>;
            color: #ffffff;
            transition: all 0.3s ease;
        }
        .footer-social-icons .social-icon:hover {
            background-color: <?php echo esc_attr($footer_link_hover_color); ?>;
            transform: translateY(-3px);
        }
        
        /* أيقونات طرق الدفع */
        .payment-methods {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
            justify-content: center;
        }
        .payment-method {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 30px;
            background-color: #ffffff;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            font-size: 20px;
            color: #333;
        }
        
        /* زر العودة لأعلى */
        #toTop {
            position: fixed;
            bottom: 25px;
            left: 25px;
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 50%;
            background: <?php echo esc_attr($footer_link_color); ?>;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,.25);
            transition: .3s;
            z-index: 999;
        }
        #toTop.show {
            display: flex;
        }
        #toTop:hover {
            background: <?php echo esc_attr($footer_link_hover_color); ?>;
        }
        
        /* تحسينات نمط الفوتر مع نموذج اشتراك */
        .footer-newsletter {
            display: <?php echo ($footer_style === 'newsletter') ? 'block' : 'none'; ?>;
        }
        
        .footer-style-newsletter .newsletter-wrapper {
            padding: 30px 0;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.03);
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .newsletter-content {
            margin-bottom: 20px;
        }
        
        .newsletter-title {
            font-size: 24px;
            margin-bottom: 10px;
            color: <?php echo esc_attr($footer_text_color); ?>;
        }
        
        .newsletter-description {
            font-size: 16px;
            margin-bottom: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .newsletter-form {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .newsletter-default-form .form-group {
            display: flex;
            gap: 10px;
        }
        
        .newsletter-default-form input[type="email"] {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .newsletter-default-form .newsletter-submit {
            background-color: <?php echo esc_attr($footer_link_color); ?>;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .newsletter-default-form .newsletter-submit:hover {
            background-color: <?php echo esc_attr($footer_link_hover_color); ?>;
        }
        
        /* تحسينات نمط الفوتر مع خريطة */
        .footer-map {
            display: <?php echo ($footer_style === 'map') ? 'block' : 'none'; ?>;
        }
        
/* ====== Footer - Map Layout – Improved  ====== */
.footer-style-map .footer-map-wrapper{
    /* حاوية مرنة تستجيب تلقائياً */
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    align-items:center;
    gap:32px;         /* مسافة آمنة ومريحة بين العناصر */
    padding:40px 24px;
}

/* صندوق الخريطة */
.footer-style-map .map-container{
    height:220px;        /* ارتفاع أوضح للخريطة */
    border-radius:12px;  /* حواف أكثر نعومة */
    overflow:hidden;
    box-shadow:0 4px 18px rgba(0,0,0,.12);
    background:#f7f9fc;
}

/* العمود الأيمن (أيقونات شبكات التواصل + الدفع) */
.footer-style-map .footer-info-right{
    display:flex;
    flex-direction:column;
    gap:24px;            /* فصل واضح بين المجموعتين */
}

/* شبكات التواصل */
.footer-style-map .footer-social-icons{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
    justify-content:flex-start;
}
.footer-style-map .footer-social-icons .social-icon{
    width:40px;
    height:40px;
    font-size:16px;
    border-radius:50%;
    background:<?php echo esc_attr($footer_link_color); ?>;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:.25s ease;
}
.footer-style-map .footer-social-icons .social-icon:hover{
    transform:scale(1.1) translateY(-2px);
    background:<?php echo esc_attr($footer_link_hover_color); ?>;
}

/* وسائل الدفع */
.footer-style-map .payment-methods{
    display:flex;
    flex-wrap:wrap;
    gap:10px 14px; /* صفوف متدرجة بفراغ رأسي أصغر */
}
.footer-style-map .payment-method{
    width:46px;
    height:28px;
    font-size:15px;
    border-radius:6px;
    background:#fff;
    box-shadow:0 2px 6px rgba(0,0,0,.1);
    display:flex;
    align-items:center;
    justify-content:center;
    transition:.25s;
}
.footer-style-map .payment-method:hover{
    transform:scale(1.08);
}

        
        /* تنسيق أيقونة الخريطة في حالة عدم وجود مفتاح API */
        .map-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 300px;
            background-color: #f5f5f5;
            border-radius: 8px;
            text-align: center;
            padding: 20px;
        }
        
        .map-icon {
            font-size: 60px;
            color: <?php echo esc_attr($footer_link_color); ?>;
            margin-bottom: 20px;
        }
        
        .map-placeholder p {
            max-width: 80%;
            margin: 0 auto;
        }
    </style>
    <?php
}
add_action('wp_head', 'professional_theme_footer_dynamic_css');

/**
 * إضافة سكريبت زر العودة لأعلى
 */
function professional_theme_back_to_top_script() {
    if (!get_theme_mod('footer_show_back_to_top', true)) {
        return;
    }
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('toTop');
        if (!btn) return;
        
        window.addEventListener('scroll', () => {
            btn.classList.toggle('show', window.scrollY > 400);
        });
        
        btn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'professional_theme_back_to_top_script');
