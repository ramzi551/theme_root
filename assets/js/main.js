/**
 * تنفيذ سكريبت جافاسكريبت لتحسين تجربة المستخدم (الإصدار 2.3 - استخدام MutationObserver للسلة)
 * يتضمن:
 * - تفعيل زر العودة لأعلى
 * - تفعيل البحث المنبثق
 * - تفعيل القائمة المتنقلة
 * - تحسينات WooCommerce (مع استخدام MutationObserver لتفاعل أيقونة السلة)
 */
jQuery(document).ready(function($) {
    // زر العودة لأعلى
    var toTopButton = $("#toTop"); 
    if (toTopButton.length) {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                toTopButton.addClass("show");
            } else {
                toTopButton.removeClass("show");
            }
        });
        
        toTopButton.on("click", function(e) {
            e.preventDefault();
            $("html, body").animate({
                scrollTop: 0
            }, 500);
        });
    }
    
    // --- تفعيل البحث المنبثق ---
    var $searchPopup = $(".search-popup"); 
    var $searchTrigger = $(".search-popup-trigger, .icon-link.icon-search"); 
    var $searchClose = $searchPopup.find(".search-close"); 
    var $searchForm = $searchPopup.find("form"); 

    function openSearchPopup() {
        if ($searchPopup.length) {
            $searchPopup.addClass("is-visible"); 
            setTimeout(function() { 
                 $searchPopup.find("input[type=\"search\"]").focus();
            }, 100);
        }
    }

    function closeSearchPopup() {
        if ($searchPopup.length) {
            $searchPopup.removeClass("is-visible"); 
        }
    }

    $searchTrigger.on("click", function(e) {
        e.preventDefault();
        e.stopPropagation(); 
        if ($searchPopup.hasClass("is-visible")) {
            closeSearchPopup();
        } else {
            openSearchPopup();
        }
    });
    
    $searchClose.on("click", function(e) {
        e.preventDefault();
        closeSearchPopup();
    });
    
    $searchPopup.on("click", function(e) {
        if ($(e.target).is($searchPopup)) {
            closeSearchPopup();
        }
    });

    $(document).on("keydown", function(e) {
        if (e.key === "Escape" && $searchPopup.hasClass("is-visible")) { 
            closeSearchPopup();
        }
    });

    if ($searchForm.length) {
        $searchForm.on("submit", function() {
            closeSearchPopup();
        });
    }
    // --- نهاية تعديل البحث المنبثق ---
    
    
    // --- تفعيل القائمة المتنقلة ---
    var $menuToggle = $(".menu-toggle");
    var $mobileMenu = $(".main-navigation"); 
    var $menuOverlay = $(".menu-overlay"); 

    $menuToggle.on("click", function() {
        $(this).toggleClass("active");
        $mobileMenu.toggleClass("active"); 
        if ($menuOverlay.length) {
            $menuOverlay.toggleClass("active");
        }
    });
    
    $mobileMenu.find(".menu-item-has-children > a").on("click", function(e) {
        if ($(this).attr("href") === "#") {
             e.preventDefault();
        }
        $(this).parent().toggleClass("active");
        $(this).next(".sub-menu").slideToggle(300);
        if ($(this).attr("href") === "#") {
             e.stopPropagation();
        }
    });
    
    if ($menuOverlay.length) {
        $(".close-mobile-menu, .menu-overlay").on("click", function() { 
            $menuToggle.removeClass("active");
            $mobileMenu.removeClass("active");
            $menuOverlay.removeClass("active");
        });
    }
    // --- نهاية القائمة المتنقلة ---
    
    // --- تحسين تجربة المستخدم في المتجر (استخدام MutationObserver للسلة v2.3) ---
    
    // استهداف أيقونة السلة الرئيسية
    var $cartIcon = $("a.icon-link.icon-cart.cart-contents");
    // استهداف عنصر عداد السلة
    var cartCountElement = document.querySelector("a.icon-link.icon-cart.cart-contents span.cart-count.count"); 

    // التحقق من وجود عنصر عداد السلة
    if (cartCountElement && $cartIcon.length) {
        console.log("Cart count element found. Setting up MutationObserver.");

        // تخزين القيمة السابقة للعدد للمقارنة
        let previousCartCount = cartCountElement.textContent;

        // إعداد MutationObserver
        const observer = new MutationObserver(function(mutationsList, observer) {
            // المرور على كل التغييرات التي تم رصدها
            for(const mutation of mutationsList) {
                // التحقق إذا كان التغيير في محتوى النص (العدد)
                if (mutation.type === "characterData" || mutation.type === "childList") {
                    const currentCartCount = cartCountElement.textContent;
                    console.log(`Mutation detected. Previous count: ${previousCartCount}, Current count: ${currentCartCount}`);
                    
                    // التحقق إذا تغير العدد فعلاً (لتجنب التشغيل المتكرر)
                    if (currentCartCount !== previousCartCount) {
                        console.log("Cart count changed! Adding bounce class.");
                        $cartIcon.addClass("bounce");
                        
                        // إزالة الكلاس بعد انتهاء الأنيميشن
                        setTimeout(function() {
                            console.log("Removing bounce class.");
                            $cartIcon.removeClass("bounce");
                        }, 500); // مدة الأنيميشن

                        // تحديث القيمة السابقة
                        previousCartCount = currentCartCount;
                        // يمكن إيقاف المراقبة مؤقتًا إذا لزم الأمر لتجنب الحلقات اللانهائية
                        // observer.disconnect(); 
                        // وإعادة تشغيلها لاحقًا
                        // observer.observe(cartCountElement, { characterData: true, childList: true, subtree: true });
                        break; // يكفي رصد تغيير واحد
                    }
                }
            }
        });

        // بدء مراقبة عنصر عداد السلة للتغييرات في المحتوى والنص
        observer.observe(cartCountElement, { 
            characterData: true, // مراقبة التغييرات في النص داخل العنصر
            childList: true,     // مراقبة إضافة أو إزالة عناصر فرعية (احتياطي)
            subtree: true        // مراقبة التغييرات في العناصر الفرعية (احتياطي)
        });

        console.log("MutationObserver is now observing the cart count.");

    } else {
        console.error("Cart count element or cart icon not found. MutationObserver not started.");
        // يمكنك هنا إضافة الكود القديم المعتمد على added_to_cart كخطة بديلة إذا فشل العثور على العنصر
        if (typeof wc_add_to_cart_params !== "undefined") {
            $(document.body).on("added_to_cart", function(event, fragments, cart_hash, $button) {
                console.warn("MutationObserver failed, falling back to added_to_cart event.");
                var $fallbackCartIcon = $("a.icon-link.icon-cart.cart-contents");
                if ($fallbackCartIcon.length) {
                    $fallbackCartIcon.addClass("bounce");
                    setTimeout(function() {
                        $fallbackCartIcon.removeClass("bounce");
                    }, 500);
                }
            });
        }
    }

    // --- الكود الأصلي لتحسينات المتجر الأخرى ---
    // تفعيل التكبير للصور 
    $(".product-gallery-item").on("click", function() { 
        var imgSrc = $(this).attr("data-image");
        if (imgSrc) {
            $(".product-featured-image img").attr("src", imgSrc);
        }
    });
    
    // تفعيل عداد الكمية 
    $(document).on("click", ".quantity-button.plus", function() {
        var input = $(this).siblings("input.qty");
        var val = parseInt(input.val()) || 0;
        var max = input.attr("max");
        if (max === undefined || val < parseInt(max)) {
             input.val(val + 1).trigger("change"); 
        }
    });
    
    $(document).on("click", ".quantity-button.minus", function() {
        var input = $(this).siblings("input.qty");
        var val = parseInt(input.val()) || 0;
        var min = input.attr("min") || 1; 
        if (val > parseInt(min)) {
            input.val(val - 1).trigger("change"); 
        }
    });
    // --- نهاية تحسينات المتجر ---

});

