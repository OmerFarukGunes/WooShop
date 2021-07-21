<?php /* Template Name: Ömer Faruk GÜNEŞ */ get_header();?>
<div class="container beyaz-kutu">
<h3>Varyasyonlu Ürünler</h3>
<div class="row">
    <?php 
       $variation_Array=array( //Tüm ürünler bir diziye çekildi.
       'post_type'=>'product',
       'posts_per_page'=> 20, );
       $variation = new WP_Query($variation_Array); 
       while($variation->have_posts()): $variation->the_post();?><!--Ürünler içerisinde gezen döngü-->
        <?php if($product -> is_type('variable')):?> 
        <div class="col-md-4 col-lg-3 col-xl-4 urun-liste">
        <a href="<?php the_permalink(); ?>"> <!-- Ürün sayfasının linki eklendi -->

        <?php if(has_post_thumbnail($post -> ID)):?> <!--Ürün görselinin varlığı kontrol edildi -->
        <?php the_post_thumbnail('thumbnail', array('class'=>'img-fluid'));?> <!-- ürünün görsel gösterildi -->
        <?php else:?>
        Ürün Görseli Yok <!-- Ürünün görseli bulunmaması durumunda bunun belirtilmesi sağlandı-->
        <?php endif;?> <!--Resim kontrolü yapan if koşulu kapatıldı -->

        </a>

        <a href="<?php the_permalink();?>" class="urun-liste-baslik">
          <!-- Ürün sayfasının linki eklendi -->
          <?php the_title();?>
          <!-- ürünün başlığının gösterilmesi -->
          </a> 
       
        <div class="clearfix"></div>          
       
        <div class="urun-liste-fiyat">      
        <?php echo $product -> get_price_html();?>   <!-- Ürün fiyatı yazıldı-->
        </div> 

        <div class="clearfix"></div>
        </div>

        <?php endif; ?> <!-- Varyasyon kontrolu yapan if kapatıldı -->
        <?php endwhile; ?> <!-- Tüm ürünlerin kayıt olduğu dizi içerisinde dönmeyi sağlayan while kapatıldı-->
</div>    
</div>


<div class="clearfix"></div>
<!-- düzenleme komutu-->
<div class="container beyaz-kutu">
<h3>Fotoğrafsız Ürünler</h3>
<div class="row">
    <?php 
    $has_No_Photo_Array=array(
    'post_type'=>'product',
    'posts_per_page'=> 20, );

    $has_No_Photo = new WP_Query($has_No_Photo_Array); 
    while($has_No_Photo->have_posts()): $has_No_Photo->the_post();?> <!--Ürünler içerisinde gezen döngü-->
    <?php if(!has_post_thumbnail($post -> ID)):?> <!-- Görseli olmayan ürün kontrolu yapıldı-->
    <div class="col-md-4 col-lg-3 col-xl-2 urun-liste">
        <a href="<?php the_permalink();?>">  
             <!-- Ürün sayfasının linki eklendi -->
          Urun Gorseli Yok <!--Ürün Görselinin olmadığı belirtildi-->
        </a>

        <a href="<?php the_permalink();?>" class="urun-liste-baslik">
             <!-- Ürün sayfasının linki eklendi -->
          <?php the_title(); ?>
        <!-- Ürün başlığı yazıldı-->
          </a>

        <div class="clearfix"></div>
        
        <div class="urun-liste-fiyat">
           <?php echo $product->get_price_html();?> <!-- Ürün fiyatı yazıldı-->
           
       </div>

        <div class="urun-liste-sepete-ekle">
        <?php if(!$product -> is_type('variable')):?> <!--Ürün varyasyonlu değil ise...-->
        <?php woocommerce_template_loop_add_to_cart();?> <!-- ...Sepete ekleme seçeneği eklendi--> 
        <?php endif; ?>
       </div> 

        <div class="clearfix"></div>
        </div>
      
      <?php endif; ?><!--Resim kontrolü yapan if koşulu kapatıldı -->
     <?php endwhile;  ?><!-- Tüm ürünlerin kayıt olduğu dizi içerisinde dönmeyi sağlayan while kapatıldı-->
</div>    
</div>  


<div class="clearfix"></div>
<!-- düzenleme komutu-->
<div class="container beyaz-kutu">
<h3>18-25 TL Ürünler</h3>
<div class="row">
    <?php 
     $has_No_Photo_Array=array(
    'post_type'=>'product',
    'posts_per_page'=> 20, );
    $has_No_Photo = new WP_Query($has_No_Photo_Array); 
    while($has_No_Photo->have_posts()): $has_No_Photo->the_post();?>
   
    <?php if(($product -> get_price() >=18 ) && ($product -> get_price() <=25 )):?><!-- Fiyat kontrolünün yapıldığı koşul.-->
    <div class="col-md-4 col-lg-3 col-xl-2 urun-liste">

        <a href="<?php the_permalink();?>"> 
        <!-- Ürün sayfasının linki eklendi -->
        <?php if(has_post_thumbnail($post -> ID)):?> <!--Ürün görselinin varlığı kontrol edildi -->
        <?php the_post_thumbnail('thumbnail', array('class'=>'img-fluid'));?><!-- ürünün görsel gösterildi -->
        <?php else:  ?>
        Ürün Görseli Yok<!-- Ürünün görseli bulunmaması durumunda bunun belirtilmesi sağlandı-->
        <?php endif; ?><!--Resim kontrolü yapan if koşulu kapatıldı -->

        </a>

        <a href="<?php the_permalink();?>" class="urun-liste-baslik">
             <!-- Ürün sayfasının linki eklendi -->
          <?php the_title(); ?> 
              <!-- Ürün başlığı yazıldı-->   
        </a>
        
        <div class="clearfix"></div>
        <div class="urun-liste-fiyat">
           <?php echo $product->get_price_html();?> <!-- Ürün fiyatı yazıldı-->
        </div>

        <div class="urun-liste-sepete-ekle">
        <?php if(!$product -> is_type('variable')):?> <!--Ürün varyasyonlu değil ise...-->
        <?php woocommerce_template_loop_add_to_cart();?> <!-- ...Sepete ekleme seçeneği eklendi--> 
        <?php endif; ?>
        </div> 

        <div class="clearfix"></div>
        </div>

     <?php endif; ?><!--Fiyat kontrolü yapan if koşulu kapatıldı -->
     <?php endwhile; ?><!-- Tüm ürünlerin kayıt olduğu dizi içerisinde dönmeyi sağlayan while kapatıldı-->

</div>    
</div>  