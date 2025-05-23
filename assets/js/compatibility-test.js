/**
 * اختبار توافق المتصفحات والأجهزة
 * 
 * هذا الملف يحتوي على اختبارات للتأكد من توافق القالب مع مختلف المتصفحات والأجهزة
 */

// التأكد من أن القالب يعمل بشكل صحيح على المتصفحات الرئيسية
console.log('بدء اختبار توافق المتصفحات...');

// اختبار توافق CSS
function testCSSCompatibility() {
  console.log('اختبار توافق CSS...');
  
  // التحقق من دعم متغيرات CSS
  const cssVarsSupported = window.CSS && window.CSS.supports && window.CSS.supports('--test', '0');
  console.log('دعم متغيرات CSS:', cssVarsSupported ? 'مدعوم' : 'غير مدعوم');
  
  // التحقق من دعم Flexbox
  const flexboxSupported = window.CSS && window.CSS.supports && window.CSS.supports('display', 'flex');
  console.log('دعم Flexbox:', flexboxSupported ? 'مدعوم' : 'غير مدعوم');
  
  // التحقق من دعم Grid
  const gridSupported = window.CSS && window.CSS.supports && window.CSS.supports('display', 'grid');
  console.log('دعم Grid:', gridSupported ? 'مدعوم' : 'غير مدعوم');
  
  // إضافة الحلول البديلة إذا لزم الأمر
  if (!cssVarsSupported) {
    console.log('إضافة حل بديل لمتغيرات CSS...');
    // هنا يمكن إضافة كود لدعم المتصفحات القديمة
  }
}

// اختبار توافق JavaScript
function testJSCompatibility() {
  console.log('اختبار توافق JavaScript...');
  
  // التحقق من دعم ES6
  let es6Supported = true;
  try {
    eval('let test = () => {}; const x = 1; class Test {}');
  } catch (e) {
    es6Supported = false;
  }
  console.log('دعم ES6:', es6Supported ? 'مدعوم' : 'غير مدعوم');
  
  // التحقق من دعم Fetch API
  const fetchSupported = 'fetch' in window;
  console.log('دعم Fetch API:', fetchSupported ? 'مدعوم' : 'غير مدعوم');
  
  // إضافة الحلول البديلة إذا لزم الأمر
  if (!fetchSupported) {
    console.log('إضافة حل بديل لـ Fetch API...');
    // هنا يمكن إضافة كود لدعم المتصفحات القديمة
  }
}

// اختبار الأجهزة المحمولة
function testMobileCompatibility() {
  console.log('اختبار توافق الأجهزة المحمولة...');
  
  // التحقق مما إذا كان الجهاز محمولاً
  const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  console.log('جهاز محمول:', isMobile ? 'نعم' : 'لا');
  
  // التحقق من دعم اللمس
  const touchSupported = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
  console.log('دعم اللمس:', touchSupported ? 'مدعوم' : 'غير مدعوم');
  
  // التحقق من حجم الشاشة
  console.log('عرض الشاشة:', window.innerWidth);
  console.log('ارتفاع الشاشة:', window.innerHeight);
  
  // اختبار الاستجابة
  if (isMobile) {
    console.log('اختبار الاستجابة للأجهزة المحمولة...');
    // هنا يمكن إضافة اختبارات خاصة بالأجهزة المحمولة
  }
}

// اختبار الأداء
function testPerformance() {
  console.log('اختبار الأداء...');
  
  // قياس وقت تحميل الصفحة
  const loadTime = window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart;
  console.log('وقت تحميل الصفحة:', loadTime, 'مللي ثانية');
  
  // قياس عدد طلبات HTTP
  const resourceList = window.performance.getEntriesByType('resource');
  console.log('عدد طلبات HTTP:', resourceList.length);
  
  // قياس حجم الصفحة
  let totalSize = 0;
  resourceList.forEach(resource => {
    totalSize += resource.transferSize || 0;
  });
  console.log('حجم الصفحة:', Math.round(totalSize / 1024), 'كيلوبايت');
  
  // تحليل الأداء
  if (loadTime > 3000) {
    console.warn('تحذير: وقت تحميل الصفحة طويل جداً');
  }
  
  if (resourceList.length > 50) {
    console.warn('تحذير: عدد كبير من طلبات HTTP');
  }
  
  if (totalSize > 2000 * 1024) {
    console.warn('تحذير: حجم الصفحة كبير جداً');
  }
}

// تشغيل الاختبارات
document.addEventListener('DOMContentLoaded', function() {
  console.log('بدء اختبارات التوافق والأداء...');
  
  testCSSCompatibility();
  testJSCompatibility();
  testMobileCompatibility();
  testPerformance();
  
  console.log('اكتملت اختبارات التوافق والأداء.');
});
