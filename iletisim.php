<?php /*Template Name: Ilteisim*/ get_header();?>
<?php while(have_posts()): the_post(); ?>
<div class="container sayfa beyaz-kutu">
<h1 class="kalin-baslik"><?php the_title(); ?></h1>
 <div class="row">
 	<div class="col-md-4">
 		<h4>iletisim Formu</h4>
 		<?php echo  do_shortcode('[contact-form-7 id="113" title="İletişim formu 1"]');  ?>
 	</div>
 	<div class="col-md-4">
 		  <p><strong>Adres: </strong><?php the_field('firma_adres','option') ?> </p>    
                <p><strong>Telefon: </strong><?php the_field('firma_telefon','option') ?></p> 
                <p><strong>E-Mail: </strong><a href="mailto:<?php the_field('firma_e-posta','option') ?>"><?php the_field('firma_e-posta','option') ?></a></p>  
            </div>
            <div class="col-md-4">
            	 <?php the_field('firma_google_harita_kodu','option'); ?>
            </div>
 	</div>
 </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>