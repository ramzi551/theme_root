<?php
/**
* قالب الصفحة الرئيسية للمتجر الإلكتروني - مرتبط مباشرة بـ WooCommerce
* * @package ProfessionalTheme
* @version 1.1
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// استدعاء الهيدر المناسب
get_header();
?>

<?php if ( ! is_front_page() && function_exists( 'get_template_part' ) ) : ?>
  <?php get_template_part( 'template-parts/hero' ); ?>
<?php endif; ?>

<?php if ( class_exists( 'WooCommerce' ) ) : // التحقق الشامل: لن يتم عرض أقسام المتجر التالية إلا إذا كان WooCommerce مفعلًا ?>

<section class="featured-categories section-padding">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'featured_categories_title', 'تسوق حسب الفئة' ) ); ?></h2>
      <p class="section-description"><?php echo esc_html( get_theme_mod( 'featured_categories_description', 'اكتشف منتجاتنا المميزة حسب الفئة' ) ); ?></p>
    </div>
    
    <div class="categories-grid">
      <?php
        // عرض الفئات المميزة فقط إذا تم تحديدها في إعدادات القالب
        $featured_categories_ids = get_theme_mod( 'featured_categories', '' );
        
        if ( ! empty( $featured_categories_ids ) ) {
          $category_ids = explode( ',', $featured_categories_ids );
          
          foreach ( $category_ids as $category_id ) {
            $category_id = trim( $category_id );
            $category = get_term( $category_id, 'product_cat' );
            
            if ( $category && ! is_wp_error( $category ) ) {
              $thumbnail_id = get_term_meta( $category_id, 'thumbnail_id', true );
              $image = wp_get_attachment_url( $thumbnail_id );
              
              echo '<div class="category-card">';
              echo '<a href="' . esc_url( get_term_link( $category ) ) . '" class="category-link">';
              
              if ( $image ) {
                echo '<div class="category-image" style="background-image: url(' . esc_url( $image ) . ');"></div>';
              } else {
                echo '<div class="category-image category-no-image"><i class="fas fa-shopping-bag"></i></div>';
              }
              
              echo '<h3 class="category-title">' . esc_html( $category->name ) . '</h3>';
              echo '<span class="category-count">' . sprintf( _n( '%s منتج', '%s منتجات', $category->count, 'professional-theme' ), $category->count ) . '</span>';
              echo '</a>';
              echo '</div>';
            }
          }
        } else {
          // إذا لم يتم تحديد فئات مميزة، يمكن عرض رسالة أو ترك القسم فارغًا
          // echo '<p>' . __( 'لم يتم تحديد فئات مميزة لعرضها.', 'professional-theme' ) . '</p>';
          // للخيار الذي طلبته (أن يرتبط مباشرة)، سنتركه فارغًا إذا لم يتم التحديد.
        }
      ?>
    </div>
  </div>
</section>

<section class="featured-products section-padding">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'featured_products_title', 'منتجات مميزة' ) ); ?></h2>
      <p class="section-description"><?php echo esc_html( get_theme_mod( 'featured_products_description', 'اكتشف أفضل منتجاتنا المختارة خصيصاً لك' ) ); ?></p>
    </div>
    
    <div class="products-grid">
      <?php
        $args = array(
          'post_type'      => 'product',
          'posts_per_page' => 8,
          'meta_key'       => '_featured',
          'meta_value'     => 'yes'
        );
        
        $featured_query = new WP_Query( $args );
        
        if ( $featured_query->have_posts() ) {
          while ( $featured_query->have_posts() ) {
            $featured_query->the_post();
            global $product;
            wc_get_template_part( 'content', 'product' );
          }
          wp_reset_postdata();
        } else {
          echo '<div class="no-products">';
          echo '<p>' . __( 'لا توجد منتجات مميزة حالياً.', 'professional-theme' ) . '</p>';
          echo '</div>';
        }
      ?>
    </div>
    
    <div class="view-all-wrapper">
      <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="view-all-button">
        <?php echo esc_html( get_theme_mod( 'featured_products_button_text', 'عرض جميع المنتجات' ) ); ?>
        <i class="fas fa-long-arrow-alt-left"></i>
      </a>
    </div>
  </div>
</section>

<section class="bestseller-products section-padding">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'bestseller_products_title', 'الأكثر مبيعاً' ) ); ?></h2>
      <p class="section-description"><?php echo esc_html( get_theme_mod( 'bestseller_products_description', 'اكتشف المنتجات الأكثر مبيعاً لدينا' ) ); ?></p>
    </div>
    
    <div class="products-grid">
      <?php
        $args = array(
          'post_type'      => 'product',
          'posts_per_page' => 8,
          'meta_key'       => 'total_sales',
          'orderby'        => 'meta_value_num',
          'order'          => 'DESC'
        );
        
        $bestseller_query = new WP_Query( $args );
        
        if ( $bestseller_query->have_posts() ) {
          while ( $bestseller_query->have_posts() ) {
            $bestseller_query->the_post();
            global $product;
            wc_get_template_part( 'content', 'product' );
          }
          wp_reset_postdata();
        } else {
          echo '<div class="no-products">';
          echo '<p>' . __( 'لا توجد منتجات حالياً ضمن الأكثر مبيعاً.', 'professional-theme' ) . '</p>'; // تم تعديل الرسالة لتكون أوضح
          echo '</div>';
        }
      ?>
    </div>
  </div>
</section>

<?php endif; // نهاية التحقق من وجود WooCommerce للأقسام المرتبطة به ?>

<section class="special-offers section-padding">
  <div class="container">
    <div class="offers-grid">
      <div class="offer-card offer-large">
        <?php
          $offer_large_image = get_theme_mod( 'offer_large_image' ); // تم إزالة القيمة الافتراضية هنا، إذا لم يتم التعيين لن تظهر صورة
          $offer_large_title = get_theme_mod( 'offer_large_title', 'عروض نهاية الموسم' );
          $offer_large_subtitle = get_theme_mod( 'offer_large_subtitle', 'خصم يصل إلى 50%' );
          $offer_large_button_text = get_theme_mod( 'offer_large_button_text', 'تسوق الآن' );
          $offer_large_link = get_theme_mod( 'offer_large_link', '#' );
        ?>
        <?php if ($offer_large_image) : // شرط لعرض هذا الجزء فقط إذا كانت الصورة موجودة ?>
        <div class="offer-image" style="background-image: url('<?php echo esc_url( $offer_large_image ); ?>');">
          <div class="offer-overlay"></div>
          <div class="offer-content">
            <h3 class="offer-subtitle"><?php echo esc_html( $offer_large_subtitle ); ?></h3>
            <h2 class="offer-title"><?php echo esc_html( $offer_large_title ); ?></h2>
            <a href="<?php echo esc_url( $offer_large_link ); ?>" class="offer-button">
              <?php echo esc_html( $offer_large_button_text ); ?>
              <i class="fas fa-long-arrow-alt-left"></i>
            </a>
          </div>
        </div>
        <?php endif; ?>
      </div>
      
      <div class="offer-card offer-small">
        <?php
          $offer_small_1_image = get_theme_mod( 'offer_small_1_image' );
          $offer_small_1_title = get_theme_mod( 'offer_small_1_title', 'منتجات جديدة' );
          $offer_small_1_subtitle = get_theme_mod( 'offer_small_1_subtitle', 'مجموعة 2025' );
          $offer_small_1_button_text = get_theme_mod( 'offer_small_1_button_text', 'اكتشف الآن' );
          $offer_small_1_link = get_theme_mod( 'offer_small_1_link', '#' );
        ?>
        <?php if ($offer_small_1_image) : ?>
        <div class="offer-image" style="background-image: url('<?php echo esc_url( $offer_small_1_image ); ?>');">
          <div class="offer-overlay"></div>
          <div class="offer-content">
            <h3 class="offer-subtitle"><?php echo esc_html( $offer_small_1_subtitle ); ?></h3>
            <h2 class="offer-title"><?php echo esc_html( $offer_small_1_title ); ?></h2>
            <a href="<?php echo esc_url( $offer_small_1_link ); ?>" class="offer-button">
              <?php echo esc_html( $offer_small_1_button_text ); ?>
              <i class="fas fa-long-arrow-alt-left"></i>
            </a>
          </div>
        </div>
        <?php endif; ?>
      </div>
      
      <div class="offer-card offer-small">
        <?php
          $offer_small_2_image = get_theme_mod( 'offer_small_2_image' );
          $offer_small_2_title = get_theme_mod( 'offer_small_2_title', 'منتجات حصرية' );
          $offer_small_2_subtitle = get_theme_mod( 'offer_small_2_subtitle', 'تشكيلة محدودة' );
          $offer_small_2_button_text = get_theme_mod( 'offer_small_2_button_text', 'تسوق الآن' );
          $offer_small_2_link = get_theme_mod( 'offer_small_2_link', '#' );
        ?>
        <?php if ($offer_small_2_image) : ?>
        <div class="offer-image" style="background-image: url('<?php echo esc_url( $offer_small_2_image ); ?>');">
          <div class="offer-overlay"></div>
          <div class="offer-content">
            <h3 class="offer-subtitle"><?php echo esc_html( $offer_small_2_subtitle ); ?></h3>
            <h2 class="offer-title"><?php echo esc_html( $offer_small_2_title ); ?></h2>
            <a href="<?php echo esc_url( $offer_small_2_link ); ?>" class="offer-button">
              <?php echo esc_html( $offer_small_2_button_text ); ?>
              <i class="fas fa-long-arrow-alt-left"></i>
            </a>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<section class="features-section section-padding">
  <div class="container">
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-truck"></i>
        </div>
        <h3 class="feature-title"><?php echo esc_html( get_theme_mod( 'feature_1_title', 'شحن مجاني' ) ); ?></h3>
        <p class="feature-description"><?php echo esc_html( get_theme_mod( 'feature_1_description', 'للطلبات أكثر من 200 ريال' ) ); ?></p>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-undo-alt"></i>
        </div>
        <h3 class="feature-title"><?php echo esc_html( get_theme_mod( 'feature_2_title', 'إرجاع مجاني' ) ); ?></h3>
        <p class="feature-description"><?php echo esc_html( get_theme_mod( 'feature_2_description', 'خلال 30 يوم من الشراء' ) ); ?></p>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-lock"></i>
        </div>
        <h3 class="feature-title"><?php echo esc_html( get_theme_mod( 'feature_3_title', 'دفع آمن' ) ); ?></h3>
        <p class="feature-description"><?php echo esc_html( get_theme_mod( 'feature_3_description', 'حماية 100% للمدفوعات' ) ); ?></p>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-headset"></i>
        </div>
        <h3 class="feature-title"><?php echo esc_html( get_theme_mod( 'feature_4_title', 'دعم على مدار الساعة' ) ); ?></h3>
        <p class="feature-description"><?php echo esc_html( get_theme_mod( 'feature_4_description', 'تواصل معنا 24/7' ) ); ?></p>
      </div>
    </div>
  </div>
</section>

<section class="blog-section section-padding">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'blog_section_title', 'آخر المقالات' ) ); ?></h2>
      <p class="section-description"><?php echo esc_html( get_theme_mod( 'blog_section_description', 'اطلع على آخر الأخبار والمقالات' ) ); ?></p>
    </div>
    
    <div class="blog-grid">
      <?php
        $args = array(
          'post_type'      => 'post',
          'posts_per_page' => 3,
          'orderby'        => 'date',
          'order'          => 'DESC'
        );
        
        $blog_query = new WP_Query( $args );
        
        if ( $blog_query->have_posts() ) {
          while ( $blog_query->have_posts() ) {
            $blog_query->the_post();
            
            echo '<div class="blog-card">';
            
            if ( has_post_thumbnail() ) {
              echo '<div class="blog-image">';
              echo '<a href="' . esc_url( get_permalink() ) . '">';
              the_post_thumbnail( 'medium' );
              echo '</a>';
              echo '</div>';
            } else {
              echo '<div class="blog-image blog-no-image">';
              echo '<a href="' . esc_url( get_permalink() ) . '">';
              echo '<i class="fas fa-image"></i>';
              echo '</a>';
              echo '</div>';
            }
            
            echo '<div class="blog-content">';
            echo '<div class="blog-meta">';
            echo '<span class="blog-date"><i class="far fa-calendar-alt"></i> ' . get_the_date() . '</span>';
            echo '<span class="blog-author"><i class="far fa-user"></i> ' . get_the_author() . '</span>';
            echo '</div>';
            echo '<h3 class="blog-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h3>';
            echo '<div class="blog-excerpt">' . get_the_excerpt() . '</div>';
            echo '<a href="' . esc_url( get_permalink() ) . '" class="read-more">قراءة المزيد <i class="fas fa-long-arrow-alt-left"></i></a>';
            echo '</div>';
            
            echo '</div>';
          }
          wp_reset_postdata();
        } else {
          echo '<div class="no-posts">';
          echo '<p>' . __( 'لا توجد مقالات حالياً.', 'professional-theme' ) . '</p>';
          echo '</div>';
        }
      ?>
    </div>
    
    <div class="view-all-wrapper">
      <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="view-all-button">
        <?php echo esc_html( get_theme_mod( 'blog_section_button_text', 'عرض جميع المقالات' ) ); ?>
        <i class="fas fa-long-arrow-alt-left"></i>
      </a>
    </div>
  </div>
</section>

<?php get_footer(); ?>