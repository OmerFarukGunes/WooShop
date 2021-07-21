<?php

/*Tema Setup*/
function wooshop_setup(){

add_theme_support('post-thumbnails');
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array(
    // Any or all of these.
    'comment-list', 
    'comment-form',
    'search-form',
    'gallery',
    'caption',
) );

register_nav_menu('primary',__('Ana Menu','wooshop') );
register_nav_menu('footermenu1',__('Footer Menu 1','wooshop') );
register_nav_menu('footermenu2',__('Footer Menu 2','wooshop') );

register_nav_menu('mobilmenu',__('mobil menu 2','wooshop') );

set_post_thumbnail_size(604,270,true);

add_filter('use_default_gallery_style', '__return_false');
 add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}
add_action('after_setup_theme','wooshop_setup' );

/* tema still ve script dosylari */
function wooshop_scriptler_stiller()
{
wp_enqueue_style('bootstrep-css', get_template_directory_uri().'/inc/bootstrap/css/bootstrap.min.css', array() );
wp_enqueue_style('slider', get_template_directory_uri().'/inc/slider/css/swiper.min.css', array() );
wp_enqueue_style('fontawesome', get_template_directory_uri().'/inc/fontawesome/css/all.min.css', array() );
wp_enqueue_style('wooshop-style', get_template_directory_uri() .'/style.css', array() );


wp_enqueue_script('Popper', get_template_directory_uri().'/inc/popper.min.js', array('jquery') );
wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/inc/bootstrap/js/bootstrap.min.js', array('jquery'), '2016-19-08', true);
wp_enqueue_script('slider2', get_template_directory_uri().'/inc/slider/js/swiper.min.js', array('jquery'), '2016-19-08', true );
wp_enqueue_script('slider3', get_template_directory_uri().'/inc/slider/js/swiper.thumbnails.js', array('jquery'), '2016-19-08', true );
wp_enqueue_script('jsscript', get_template_directory_uri().'/inc/scripts.js', array('jquery'), '2016-19-08', true );
}
add_action('wp_enqueue_scripts', 'wooshop_scriptler_stiller');

/*ACF Bileseni*/
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
    $path = get_stylesheet_directory() . '/inc/acf/';
    return $path;
}
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir( $dir ) {
 
    $dir = get_stylesheet_directory_uri() . '/inc/acf/';
    return $dir;
}
//add_filter('acf/settings/show_admin', '__return_false');
include_once( get_stylesheet_directory() . '/inc/acf/acf.php' );
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Site Ayarları',
		'menu_title'	=> 'Site Ayarları',
		'menu_slug' 	=> 'site-ayarlari',
		'capability'	=> 'manage_options',
		'redirect'		=> false,
		'update_button'		=> __('Güncelle', 'acf'),
		'updated_message'	=> __("Ayarlar Güncellendi", 'acf'),
	));
}

/*Sepet Guncelleyici*/
function wookod_sepet($urunler){
	ob_start();  //anlik guncelleme yapar
	?>
	<span class="sepet-guncel"> 
	<span class="sepet-urun"><?php echo WC()->cart->cart_contents_count;?></span>
	<span class="sepet-fiyat"><?php echo WC()->cart->get_cart_total(); ?></span>
	</span>
	 <?php

	 $urunler['.sepet-guncel'] =ob_get_clean();
	 return $urunler;
}
add_filter('woocommerce_add_to_cart_fragments' , 'wookod_sepet');
/*Klasik Editore Geri Donus*/

add_filter('use_block_editor_for_post','__return_false',10);
add_filter('use_block_editor_for_post_type','__return_false',10);

/* Resim boyutlari*/

function resim_boyutlari(){
  add_image_size('thumb-blog-kapak',1110,438,true);
  add_image_size('thumb-kategori-2-kapak',350,206,true);

}
/*ozel ozet*/

function ozel_ozet(){
   $excerpt = get_the_content();
   $excerpt = preg_replace("[.*?]",'',$excerpt);
   $excerpt = strip_shortcodes($excerpt);
   $excerpt = strip_tags($excerpt);
   $excerpt = substr($excerpt,0,50);
   $excerpt = substr($excerpt,0,strripos($excerpt," "));
   $excerpt = trim(preg_replace('/\s+/',' ',$excerpt));
   $excerpt = $excerpt.'<div class="clearfix"></div> <a href-="'.get_the_permalink().'" class="devamini-oku">devamini oku<i class="fas fa-long-arrow-alt-right"></i></a>';
   return $excerpt;
}
/*urun detay sayfasinda tab ikinci basligini kapatir*/
add_filter('woocommerce_product_description_heading','__return_null');
add_filter('woocommerce_product_additional_information_heading','__return_null');

/*urun detay sayfasinda tab isimlendirme */
add_filter('woocommerce_product_tabs','tab_isimlendirme', 98);
function tab_isimlendirme( $tabs) {
$tabs['description']['title']= __('Genel Bakis');
return $tabs;
}
/*ilgili urunler ve capraz satis kolionlari*/
add_filter('woocomerce_output_related_product_args','ilgili_urunler_args',20);
function ilgili_urunler_args($args){
	$args['posts_per_page']=6;
	$args['columns']=6;
	return $args;
}

add_filter('woocomerce_upsell_display_args','capraz_satis_args',20);
function capraz_satis_args($args){
	$args['posts_per_page']=6;
	$args['columns']=6;
	return $args;
}

/*magaza basligini gizler */
add_filter('woocommerce_show_page_title','magaza_basligi_gizle');
function magaza_basligi_gizle( $title){
	if(is_shop()) $title =false;
	return false;
}
/*ozel magazza  sidebari */
function magaza_sidebar(){
	register_sidebar(
      array(
        'name'=> __('Mağaza Sidebarı', 'wookod'),
        'id'=> 'magaza-sidebar',
        'description'=> __('Mağaza Sidebarı','wookod'),
        'before_widget'=>'<div class="beyaz-kutu">',
        'after_widget'=> "</div>",
        'before_title'=> '<h3 class"tab-baslik kalin-baslik">',
        'after_title'=>'</h3><div class="clearfix"></div>',
      )
	);
	register_sidebar(array(
        'name'=> 'Blog Sidebar',
        'id'=> 'blog-sidebar',
        'description'=> "Blog Sidebar",
        'before_widget'=>'<div id="%1$s" class="widget %2$s">',
        'after_widget'=> '</div>',
        'before_title'=> '<h3 class"tab-baslik kalin-baslik">',
        'after_title'=>'</h3><div class="clearfix"></div>',
	)
);
}
add_action('widgets_init','magaza_sidebar');

/*Arama sonuclarini direkt urune yonlendirmez*/
add_filter('woocommerce_redirect_single_search_result','__return_false');

/*sepet sayfasini otomatik guncelleme*/

add_action('wp_footer' , 'otomatik_sepet_guncelleme');

function otomatik_sepet_guncelleme(){
   if(is_cart()){
    ?>
   <script type="text/javascript">
	jQuery('div_commerce').on('click','input.qty', function(){
       jQuery("[name='update_cart']").trigger("click");
	});
 </script>
  <?php
  }
}

/*odeme ekrani duzenlemeleri*/

add_filter('woocommerce_checkout_fields','odeme_alan_ozellestirmeleri');

function odeme_alan_ozellestirmeleri( $fields){
 
   unset($fields['billing']['billing_postcode']);
   unset($fields['billing']['order_comments']);
   return $fields;
  
}
//add_filter('woocommerce_enable_order_notes_field','__return_false'); order commentsi kaldirmak icin ayni gorevi gorur ama onerilmez
 
 /*ekstra siparis alanmi ekleme */

add_action('woocommerce_after_checkout_billing_form','ekstra_alan');

 function ekstra_alan($checkout){

  woocommerce_form_field('tckimlikno', array(
  'type'=>'text',
  'class'=>array('my-field-class form-row-wide'),
  'label'=> __('Tc Kimlik Numaraniz'),
  'placeholder'=>__('Tc Kimlik Numaraniz'),
  'required' =>"true"
 ),
 $checkout->get_value('tckimlikno'));
}
 add_action('woocommerce_checkout_process','ozel_alan_uyari');

 function ozel_alan_uyari(){
 	if(!$_POST['tckimlikno']) wc_add_notice(__('lutfen 11 Haneli Tc Kimlik Numaranizi Yaziniz'),'error');
 }


 add_action('woocommerce_checkout_update_order_meta','ozel_alan_sipariste_guncelleme');

function ozel_alan_sipariste_guncelleme($order_id){
 if( $_POST['tckimlikno']) update_post_meta($order_id,'_tckimlikno',sanitize_text_field($_POST['tckimlikno']));
}

 add_action('woocommerce_admin_order_data_after_billing_adress','ozel_alan_sipariste_gosterme',10,1);
 function ozel_alan_sipariste_gosterme($order){
 	echo '<p><strong>'.__('Musteri Tc Kimlik Numarasi').':</strong>' . get_post_meta($order->id, '_tckimlikno',true) . '</p>';
 }

 /*isleniyor siparis durumu degistirme*/
add_filter('wc_order_statuses','siparis_durumu_degistirme');
function  siparis_durumu_degistirme($order_statuses){
  foreach( $order_statuses as $key => $status) {
  	if ('wc-completed' === $key) 
  	    $order_statuses['wc-processing'] = _x('Sipariş Hazırlanıyor','Order status','woocommerce');
   }
  return $order_statuses;
}

/*yeni siparis durumu ekleme*/
add_filter('woocommerce_register_shop_order_post_statuses','yeni_siparis_durumu');	
function yeni_siparis_durumu($order_statuses){

	$order_statuses['wc-siparis-kargolandi']= array(
          'label' => _x('siparis kargolandi','Order status', 'woocommerce'),
          'public' => false,
          'exclue_from_search' =>false,
          'show_in_admin_all_list'=> true,
          'show_in_admin_status_list' =>true,
          'label_count' => _n_noop('Siparis kargolandi <span class="count">(%s)</span>','siparis kargolandi <span class="count">(%s)</span>','woocommerce'),
	);
}
add_filter ('wc_order_statuses','yeni_siparis_durumu_1');
function yeni_siparis_durumu_1($order_statuses){
	$order_statuses['wc-siparis-kargolandi'] =_x('siparis kargolandi','Order status','woocommerce');
	return $order_statuses;
}

add_filter ('bulk_actions-edit-shop-order', 'yeni_siparis_durumu_2');
function yeni_siparis_durumu_2($bulk_actions){
 $bulk_actions['mark_custom-status']= 'siparisi kargolandi olarak degistir';
 return $bulk_actions;


}

/*Admin bar kaldirma*/

add_action('after_setup_theme','admin_bar_kaldir');
function admin_bar_kaldir(){
	show_admin_bar(false);
}
/*fav icon ayarlari */

function favicon_ekle(){
	$favicon= get_field('facivon','option');
	echo '<link rel="shortcut icon" href="'.$favicon['url'].' "type="image/x-icon"/>';
}
add_action('login_head','favicon_ekle');
add_action('admin_head','favicon_ekle');