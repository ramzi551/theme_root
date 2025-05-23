<?php
/**
* قالب قسم الهيرو (Hero Section) المتميز - نسخة محسّنة نهائية
* مع إصلاح مشكلة التداخل في وضع الهاتف
*
* @package ProfessionalTheme
* @version 3.3
*/
if ( ! defined( 'ABSPATH' ) ) exit;

// بيانات الشرائح مع إضافة ألوان مخصصة لكل شريحة
$slides = [
    [
        'title' => 'نقدم لك أفضل الحلول الرقمية',
        'description' => 'خدمات احترافية لتطوير أعمالك ومضاعفة أرباحك',
        'button_text' => 'تواصل معنا',
        'button_url' => '#contact',
        'image' => get_template_directory_uri() . '/assets/images/slide1.jpg',
        'accent_color' => '#f97316', // برتقالي
        'overlay_color' => 'linear-gradient(to left, rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.4))'
    ],
    [
        'title' => 'تصميم مواقع بمعايير عالمية',
        'description' => 'مواقع سريعة ومتوافقة مع محركات البحث وجميع الأجهزة',
        'button_text' => 'اطلب الخدمة',
        'button_url' => '#services',
        'image' => get_template_directory_uri() . '/assets/images/slide2.jpg',
        'accent_color' => '#3b82f6', // أزرق
        'overlay_color' => 'linear-gradient(to left, rgba(30, 58, 138, 0.8), rgba(30, 58, 138, 0.4))'
    ],
    [
        'title' => 'استشارات تسويقية مجانية',
        'description' => 'احصل على استشارة مجانية لتطوير استراتيجيتك التسويقية',
        'button_text' => 'احجز الآن',
        'button_url' => '#booking',
        'image' => get_template_directory_uri() . '/assets/images/slide3.jpg',
        'accent_color' => '#10b981', // أخضر
        'overlay_color' => 'linear-gradient(to left, rgba(6, 78, 59, 0.8), rgba(6, 78, 59, 0.4))'
    ]
];

// عدد الشرائح
$total_slides = count($slides);

// إعدادات السلايدر - يمكن تعديلها حسب الحاجة
$slider_settings = [
    'height' => 400, // ارتفاع السلايدر (بالبكسل) - يمكن تعديله حسب الحاجة
    'height_mobile' => 300, // ارتفاع السلايدر على الجوال
    'autoplay_speed' => 5000, // سرعة التبديل التلقائي (5 ثوانٍ)
];
?>

<!-- قسم الهيرو المتميز -->
<section id="hero-slider-section" class="hero-slider-section" 
         style="--slider-height: <?php echo esc_attr($slider_settings['height']); ?>px; 
                --slider-height-mobile: <?php echo esc_attr($slider_settings['height_mobile']); ?>px;">
    <!-- حاوية السلايدر -->
    <div class="hero-slider" id="hero-slider">
        <?php foreach ($slides as $index => $slide) : 
            $is_active = $index === 0 ? 'active' : '';
        ?>
        <!-- الشريحة <?php echo $index + 1; ?> -->
        <div class="hero-slide <?php echo $is_active; ?>" 
             data-index="<?php echo $index; ?>"
             style="--accent-color: <?php echo esc_attr($slide['accent_color']); ?>">
            
            <!-- خلفية الشريحة -->
            <div class="slide-bg" style="background-image: url('<?php echo esc_url($slide['image']); ?>')">
                <div class="slide-overlay" style="background: <?php echo esc_attr($slide['overlay_color']); ?>"></div>
            </div>
            
            <!-- محتوى الشريحة -->
            <div class="slide-content container">
                <div class="slide-text">
                    <h2 class="slide-title"><?php echo esc_html($slide['title']); ?></h2>
                    <p class="slide-description"><?php echo esc_html($slide['description']); ?></p>
                    <a href="<?php echo esc_url($slide['button_url']); ?>" class="slide-button">
                        <?php echo esc_html($slide['button_text']); ?>
                        <i class="fas fa-long-arrow-alt-left"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- منطقة التحكم بالسلايدر (خارج السلايدر) -->
    <div class="slider-controls-wrapper">
        <div class="slider-controls">
            <button class="slider-arrow prev-arrow" aria-label="السابق">
                <i class="fas fa-chevron-right"></i>
            </button>
            
            <div class="slider-dots">
                <?php for ($i = 0; $i < $total_slides; $i++) : 
                    $active_dot = $i === 0 ? 'active' : '';
                ?>
                <button class="slider-dot <?php echo $active_dot; ?>" 
                        data-index="<?php echo $i; ?>" 
                        aria-label="الشريحة <?php echo $i + 1; ?>">
                    <span class="dot-progress"></span>
                </button>
                <?php endfor; ?>
            </div>
            
            <button class="slider-arrow next-arrow" aria-label="التالي">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
    </div>
</section>

<style>
/* ===== أنماط قسم الهيرو المتميز ===== */
:root {
    --primary-color: #0f766e;
    --secondary-color: #2563eb;
    --dark-color: #0f172a;
    --light-color: #f8fafc;
    --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

/* القسم الرئيسي - ملتصق بالهيدر مع حجم مخصص */
.hero-slider-section {
    position: relative;
    width: 100%;
    height: var(--slider-height); /* ارتفاع مخصص يمكن تعديله */
    overflow: hidden;
    margin-top: 0; /* لضمان الالتصاق بالهيدر */
    padding-top: 0;
}

/* حاوية السلايدر */
.hero-slider {
    position: relative;
    width: 100%;
    height: 100%;
}

/* الشرائح */
.hero-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: opacity 1s ease, visibility 1s ease;
    overflow: hidden;
}

.hero-slide.active {
    opacity: 1;
    visibility: visible;
    z-index: 2;
}

/* خلفية الشريحة */
.slide-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transform: scale(1.1);
    transition: transform 6s ease;
    z-index: 1;
}

.hero-slide.active .slide-bg {
    transform: scale(1);
}

/* طبقة التراكب */
.slide-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
}

/* محتوى الشريحة */
.slide-content {
    position: relative;
    height: 100%;
    display: flex;
    align-items: center;
    z-index: 3;
    padding: 0 50px;
}

.slide-text {
    max-width: 600px;
    color: #fff;
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.8s ease, transform 0.8s ease;
    transition-delay: 0.3s;
}

.hero-slide.active .slide-text {
    opacity: 1;
    transform: translateY(0);
}

/* عنوان الشريحة */
.slide-title {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #fff;
    line-height: 1.2;
    position: relative;
    padding-right: 15px;
}

.slide-title::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 5px;
    height: 100%;
    background-color: var(--accent-color);
    border-radius: 3px;
}

/* وصف الشريحة */
.slide-description {
    font-size: 18px;
    line-height: 1.6;
    margin-bottom: 30px;
    text-shadow: 0 1px 3px rgba(0,0,0,0.3);
}

/* زر الشريحة */
.slide-button {
    display: inline-flex;
    align-items: center;
    padding: 14px 30px;
    background-color: var(--accent-color);
    color: #fff;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 16px;
    transition: var(--transition);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.slide-button i {
    margin-right: 8px;
    transition: transform 0.3s ease;
}

.slide-button:hover {
    filter: brightness(1.1);
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
}

.slide-button:hover i {
    transform: translateX(-5px);
}

/* منطقة التحكم بالسلايدر - خارج السلايدر تماماً */
.slider-controls-wrapper {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 10;
    display: flex;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(5px);
    padding: 10px 0;
}

.slider-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

.slider-arrow {
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 50%;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.slider-arrow:hover {
    background-color: var(--accent-color);
    transform: scale(1.1);
}

/* نقاط التنقل */
.slider-dots {
    display: flex;
    align-items: center;
    gap: 10px;
}

.slider-dot {
    width: 12px;
    height: 12px;
    background-color: rgba(255, 255, 255, 0.3);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    padding: 0;
    position: relative;
    overflow: hidden;
    transition: var(--transition);
}

.slider-dot.active {
    background-color: var(--accent-color);
    transform: scale(1.2);
}

.slider-dot:hover {
    background-color: rgba(255, 255, 255, 0.5);
}

.dot-progress {
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 100%;
    background-color: var(--accent-color);
    transition: width 5s linear;
}

.slider-dot.active .dot-progress {
    width: 100%;
}

/* تجاوب الشاشات */
@media (max-width: 1200px) {
    .slide-title {
        font-size: 38px;
    }
    
    .slide-description {
        font-size: 17px;
    }
}

@media (max-width: 992px) {
    .slide-title {
        font-size: 34px;
    }
    
    .slide-description {
        font-size: 16px;
    }
    
    .slide-content {
        padding: 0 30px;
    }
}

@media (max-width: 768px) {
    .hero-slider-section {
        height: var(--slider-height-mobile);
    }
    
    .slide-title {
        font-size: 28px;
    }
    
    .slide-description {
        font-size: 15px;
        margin-bottom: 20px;
    }
    
    .slide-button {
        padding: 12px 25px;
        font-size: 15px;
    }
    
    .slider-arrow {
        width: 36px;
        height: 36px;
        font-size: 14px;
    }
}

@media (max-width: 576px) {
    .slide-title {
        font-size: 24px;
        margin-bottom: 15px;
    }
    
    .slide-description {
        font-size: 14px;
        margin-bottom: 15px;
    }
    
    .slide-button {
        padding: 10px 20px;
        font-size: 14px;
    }
    
    .slider-arrow {
        width: 32px;
        height: 32px;
        font-size: 12px;
    }
    
    .slider-controls {
        gap: 15px;
    }
    
    .slider-dots {
        gap: 8px;
    }
    
    .slider-dot {
        width: 10px;
        height: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // الحصول على عناصر السلايدر
    const slider = document.getElementById('hero-slider');
    const slides = slider.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    const prevArrow = document.querySelector('.prev-arrow');
    const nextArrow = document.querySelector('.next-arrow');
    
    // متغيرات السلايدر
    const totalSlides = slides.length;
    let currentSlide = 0;
    let slideInterval;
    const slideDelay = <?php echo esc_js($slider_settings['autoplay_speed']); ?>; // سرعة التبديل التلقائي
    
    // دالة لعرض شريحة محددة
    function showSlide(index) {
        // التأكد من أن الرقم ضمن النطاق
        if (index < 0) index = totalSlides - 1;
        if (index >= totalSlides) index = 0;
        
        // تحديث الشريحة الحالية
        currentSlide = index;
        
        // إزالة الفئة النشطة من جميع الشرائح والنقاط
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => {
            dot.classList.remove('active');
            const progressBar = dot.querySelector('.dot-progress');
            if (progressBar) {
                progressBar.style.width = '0';
            }
        });
        
        // إضافة الفئة النشطة للشريحة والنقطة الحالية
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
        
        // تحديث لون الأزرار حسب لون الشريحة الحالية
        const accentColor = slides[currentSlide].style.getPropertyValue('--accent-color');
        document.documentElement.style.setProperty('--accent-color', accentColor);
        
        // إعادة تشغيل شريط التقدم
        setTimeout(() => {
            const activeProgressBar = dots[currentSlide].querySelector('.dot-progress');
            if (activeProgressBar) {
                activeProgressBar.style.width = '100%';
            }
        }, 50);
    }
    
    // دالة للانتقال إلى الشريحة التالية
    function nextSlide() {
        showSlide(currentSlide + 1);
    }
    
    // دالة للانتقال إلى الشريحة السابقة
    function prevSlide() {
        showSlide(currentSlide - 1);
    }
    
    // بدء التبديل التلقائي
    function startSlideInterval() {
        // إيقاف أي تشغيل سابق
        clearInterval(slideInterval);
        
        // بدء تشغيل جديد
        slideInterval = setInterval(nextSlide, slideDelay);
    }
    
    // معالجة النقر على زر التالي
    if (nextArrow) {
        nextArrow.addEventListener('click', function() {
            nextSlide();
            startSlideInterval(); // إعادة تشغيل المؤقت
        });
    }
    
    // معالجة النقر على زر السابق
    if (prevArrow) {
        prevArrow.addEventListener('click', function() {
            prevSlide();
            startSlideInterval(); // إعادة تشغيل المؤقت
        });
    }
    
    // معالجة النقر على النقاط
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            showSlide(index);
            startSlideInterval(); // إعادة تشغيل المؤقت
        });
    });
    
    // إيقاف التبديل التلقائي عند تحويم الماوس على السلايدر
    slider.addEventListener('mouseenter', function() {
        clearInterval(slideInterval);
    });
    
    // إعادة تشغيل التبديل التلقائي عند مغادرة الماوس للسلايدر
    slider.addEventListener('mouseleave', function() {
        startSlideInterval();
    });
    
    // دعم اللمس للأجهزة المحمولة
    let touchStartX = 0;
    let touchEndX = 0;
    
    slider.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    slider.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        
        // التحقق من اتجاه السحب
        if (touchStartX - touchEndX > 50) {
            // سحب لليسار - الشريحة التالية
            nextSlide();
        } else if (touchEndX - touchStartX > 50) {
            // سحب لليمين - الشريحة السابقة
            prevSlide();
        }
        
        startSlideInterval(); // إعادة تشغيل المؤقت
    });
    
    // إخفاء الهيرو عند التمرير للأسفل
    window.addEventListener('scroll', function() {
        const heroSection = document.getElementById('hero-slider-section');
        if (!heroSection) return;
        
        const scrollPosition = window.scrollY;
        
        // إذا تجاوز التمرير ارتفاع الهيرو، نقوم بتقليل الارتفاع تدريجياً
        if (scrollPosition > 50) {
            const opacity = Math.max(0, 1 - (scrollPosition / heroSection.offsetHeight));
            heroSection.style.opacity = opacity;
            
            // إخفاء الهيرو تماماً عند التمرير بعيداً
            if (opacity < 0.1) {
                heroSection.style.pointerEvents = 'none';
            } else {
                heroSection.style.pointerEvents = 'auto';
            }
        } else {
            heroSection.style.opacity = 1;
            heroSection.style.pointerEvents = 'auto';
        }
    });
    
    // بدء السلايدر
    showSlide(0);
    startSlideInterval();
});
</script>