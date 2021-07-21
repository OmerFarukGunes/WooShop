<?php /*Template Name: Ana Sayfa*/ get_header();?>

<!-- sablon template bir sayfa olusmasini saglar. -->
    
<div class="container slider-alani">

<div class="swiper-container giris-slider swiper-container-horizontal">

<div class="swiper-wrapper">

<?php if( have_rows('ana_sayfa_slider','option')): ?>
<?php while(have_rows('ana_sayfa_slider','option')): the_row(); ?>
<?php $slide_gorseli =get_sub_field('slide_gorseli'); ?>
<div class="swiper-slide">
<a href="<?php the_sub_field('slide_link');?>"> <img src="<?php echo $slide_gorseli['url']; ?>"></a>
</div>

<?php endwhile; ?>
<?php endif; ?>

</div>
</div>
</div>    
    
  <div class="clearfix"></div> 
  <!-- bolumler arasi birbirine girmesini engeller duzenler -->


<div class="container slider-alti">
  <div class="container slider-alti-kutulari">   
  <div class="row">
    
        	<?php if( have_rows('slider_alti_kutulari','option')): ?>
          <?php while(have_rows('slider_alti_kutulari','option')): the_row(); ?>
        <div class="col-md-6 col-lg-3 slide-alti-kutu">
          <div class="row">
            <div class="col-md-2 col-lg-2 col-2 slide-alti-kutu-icon"><?php the_sub_field('slider_alti_kutu_icon'); ?></div>
            <div class="col-md-10 col-lg-10 col-10"><strong> <?php the_sub_field('slider_alti_kutu_baslik'); ?></strong><br><?php the_sub_field('slider_alti_kutu_yazi');?> 
        </div>
       </div>
    </div>
<?php endwhile; ?>
<?php endif; ?> 
  </div>
  </div>
</div>   
   
   <div class="clearfix"></div>


<div class="container anasayfa-bugunun-indirimleri">

<div class="row">
<div class="col-md-6">
<h2 class="anasayfa-bolum-baslik kalin-baslik"><?php the_field('bugunun_indirimleri_baslik','option'); ?></h2>    
</div>    
    
<?php $kalan_SURE=get_field('bugunun_indirimleri_sayac','option');
 $tercumeler= ['Ocak' =>'Jun','Şubat' =>'Feb', 'Mart'=>'Mar','Nisan'=>'April','Mayis'=>'May','Haziran'=>'Jun','Temmuz'=>'Jul','Ağustos'=>'Aug','Eylül'=>'Sep','Ekim'=>'Oct','Kasım'=>'Nov','Aralık'=>'Dec',]; 
 $tarih=strtr($kalan_SURE,$tercumeler);?>


<div class="col-md-6 anasayfa-sayac">
<span class="sayac-baslik"><?php the_field('bugunun_indirimleri_baslik_kopyala','option') ?></span>
<div class="sayac">

<div id="sayac-zaman"></div> 
<script>
(function($){   
    
$(document).ready(function(){    
    
var deadline = new Date("<?php echo $tarih; ?>").getTime(); 
var x = setInterval(function() { 
var now = new Date().getTime(); 
var t = deadline - now; 
var gun = Math.floor(t / (1000 * 60 * 60 * 24)); 
var saat = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
var dakika = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
var saniye = Math.floor((t % (1000 * 60)) / 1000); 
 
    if (t < 0) { 
       clearInterval(x); 
       $('.anasayfa-sayac').hide();
    } 
    else {
       document.getElementById("sayac-zaman").innerHTML = gun + " gün " + saat + " saat " + dakika + " dakika " + saniye + " saniye kaldı."; 
    }
    
}, 0);
     
});
     
    	
})(jQuery); 
     
</script>    
</div>   

    
</div>    
    
</div>

<div class="clearfix"></div>

<div class="container beyaz-kutu">
    
<div class="row">
            
       <?php $gunun_indirimli_urunleri = get_field('anasayfa_indirim_urunleri','option');
           if ($gunun_indirimli_urunleri):
            foreach ($gunun_indirimli_urunleri as $post):
            	setup_postdata($post);
            
        ?>
        <div class="col-md-4 col-lg-3 col-xl-2 urun-liste">
        <a href="<?php the_permalink(); ?>"> 
         <?php if(has_post_thumbnail($post->ID)): ?>
         <?php the_post_thumbnail('thumbnail',array('class'=>'img-fluid')); ?>
         <?php else: ?>
         	Urun Gorseli Yok
         <?php endif; ?>
        </a>
        <a href="<?php the_permalink(); ?>" class="urun-liste-baslik"><?php the_title(); ?></a>
        <div class="clearfix"></div>

          <?php if ($product->is_type('simple')){
        	$normal_fiyat=(float) $product->get_regular_price();
            $indirimli_fiyat= (float) $product->get_price();
            $indirim_orani=round (100 - ($indirimli_fiyat /$normal_fiyat *100),1).'%';
            if ($product->is_on_sale()) echo '<span class="urun-liste-indirim-orani">-'. $indirim_orani.'</span>';
                  } 
               ?>

        <div class="urun-liste-fiyat">
           <?php echo $product->get_price_html(); ?>
       </div>
        <div class="urun-liste-sepete-ekle">
      <?php woocommerce_template_loop_add_to_cart(); ?>
       </div>	
        <div class="clearfix"></div>

        </div>
        <?php endforeach; 
        endif; ?>  
                
</div>    
</div>

</div>

    <div class="clearfix">
    </div>
    <div class="container bannerlar1">
<div class="row">

<?php if( have_rows('anasayfa_bannerlari','option')): ?>
          <?php while(have_rows('anasayfa_bannerlari','option')): the_row(); 

          	$banner_gorsel= get_sub_field('banner_gorsel');
          	?>
   <div class="col-md-4">

  <a href="<?php the_sub_field('banner_link');?>"> <img src="<?php echo $banner_gorsel['url']; ?>" class="img-fluid"></a>

</div>
<?php endwhile; ?>
<?php endif; ?> 


</div>
</div>    
  <div class="clearfix"></div>

<div class="container anasayfa-blog">
<div class="row">
<div class="col-md-3">
<h2 class="anasayfa-bolum-baslik kalin-baslik"><?php the_field('anasayfa_blok_baslik','option'); ?></h2>    
</div>    
</div>
    
<div class="clearfix"></div>    
   
<div class="container beyaz-kutu">
<div class="row">

<?php 
  $anasayfa_son_postlar_array=array(
  	'post_type'=>'post',
'posts_per_page'=> 4, );

$anasayfa_son_postlar = new WP_Query($anasayfa_son_postlar_array); ?>
<?php while($anasayfa_son_postlar->have_posts()): $anasayfa_son_postlar->the_post();?>


<div class="col-md-4 col-lg-3 anasayfa-blog-kutu">
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumb-blog-kapak',array('class'=> 'img-fluid')); ?></a>
<div class="clearfix"></div>
<a href="<?php the_permalink(); ?>" class="anasayfa-blog-kutu-baslik"><?php the_title(); ?></a>	 
<div class="clearfix"></div>    
<?php echo ozel_ozet(); ?>
</div>
	<?php endwhile; ?>

</div>    
</div>  
<?php get_footer();?>