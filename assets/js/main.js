/**
 * تنفيذ سكريبت جافاسكريبت لتحسين تجربة المستخدم
 * يتضمن:
 * - تفعيل زر العودة لأعلى
 * - تفعيل البحث المنبثق
 * - تغيير خلفية الهيدر عند التمرير
 */
jQuery(document).ready(function($) {
    // زر العودة لأعلى
    var toTopButton = $('#toTop');
    
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            toTopButton.addClass('show');
        } else {
            toTopButton.removeClass('show');
        }
    });
    
    toTopButton.on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        return false;
    });
    
    // تفعيل البحث المنبثق
    $('.search-icon').on('click', function(e) {
        e.preventDefault();
        $('.search-popup').addClass('active');
    });
    
    $('.search-close, .search-popup-overlay').on('click', function() {
        $('.search-popup').removeClass('active');
    });
    
    
    // تفعيل القائمة المتنقلة
    $('.menu-toggle').on('click', function() {
        $(this).toggleClass('active');
        $('.mobile-menu').toggleClass('active');
        $('.menu-overlay').toggleClass('active');
    });
    
    // تفعيل القوائم الفرعية في الجوال
    $('.mobile-menu .menu-item-has-children > a').on('click', function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('active');
        $(this).next('.sub-menu').slideToggle(300);
    });
    
    // إغلاق القائمة المتنقلة
    $('.close-mobile-menu, .menu-overlay').on('click', function() {
        $('.menu-toggle').removeClass('active');
        $('.mobile-menu').removeClass('active');
        $('.menu-overlay').removeClass('active');
    });
    
    // تحسين تجربة المستخدم في المتجر
    
    // تحديث السلة بشكل متحرك
    $('body').on('added_to_cart', function() {
        $('.cart-icon').addClass('bounce');
        setTimeout(function() {
            $('.cart-icon').removeClass('bounce');
        }, 1000);
    });
    
    // تفعيل التكبير للصور
    $('.product-gallery-item').on('click', function() {
        var imgSrc = $(this).attr('data-image');
        $('.product-featured-image img').attr('src', imgSrc);
    });
    
    // تفعيل عداد الكمية
    $('.quantity-button.plus').on('click', function() {
        var input = $(this).siblings('input.qty');
        var val = parseInt(input.val());
        input.val(val + 1).change();
    });
    
    $('.quantity-button.minus').on('click', function() {
        var input = $(this).siblings('input.qty');
        var val = parseInt(input.val());
        if (val > 1) {
            input.val(val - 1).change();
        }
    });
});
