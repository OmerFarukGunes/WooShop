
<div class="container-fluid footer-alani beyaz-kutu">

    <div class="container">
    
        <div class="row">
        
            <div class="col-md-4">
                 
       <?php $footer_logo = get_field('footer_logo','option') ?>
  
       <a href="<?php echo bloginfo('url');?>"><img class="site-logosu img-fluid" src="<?php echo $footer_logo['url'];?>" alt=""/></a>

                <p><strong>Adres: </strong><?php the_field('firma_adres','option') ?> </p>    
                <p><strong>Telefon: </strong><?php the_field('firma_telefon','option') ?></p> 
                <p><strong>E-Mail: </strong><a href="mailto:<?php the_field('firma_e-posta','option') ?>"><?php the_field('firma_e-posta','option') ?></a></p>  
            </div>
            <div class="col-md-4">
                <div class="row">
               <div class="col-md-6">
                               <?php $menu_lokasyonlari = get_nav_menu_locations();
            $menu_id_2 =$menu_lokasyonlari["footermenu2"];
            $footer_menu_2 = wp_get_nav_menu_object($menu_id_2); ?>

            <h3><?php echo $footer_menu_2->name; ?></h3>
                <div id="footer-menu1" class="footer-menu"><ul> 
    <?php wp_nav_menu(array('theme_location' => 'footermenu1','menu_class' => 'footer-menu', 'menu_id' => 'footer-menu1')); ?>
        </div>
                    </div>
                    
                    <div class="col-md-6">
                          <?php $menu_lokasyonlari = get_nav_menu_locations();
            $menu_id_1 =$menu_lokasyonlari["footermenu1"];
            $footer_menu_1 = wp_get_nav_menu_object($menu_id_1); ?>

            <h3><?php echo $footer_menu_1->name; ?></h3>
          <div id="footer-menu2" class="footer-menu">

    <?php wp_nav_menu(array('theme_location' => 'footermenu2','menu_class' => 'footer-menu', 'menu_id' => 'footer-menu2')); ?>
        </div>
                    
                    </div>
                
                </div>
                
                
            </div>
            
            <div class="col-md-4 footer-ebulten">
            <h3>E-Bülten</h3>
            <?php the_field('e-bulten_kodu','option') ?>
            </div>
        </div>
        
    
    
        
    </div>

</div>
    
<div class="container-fluid footer-alani-2 beyaz-kutu">

    <div class="container">
    
        <div class="row">
        
            <div class="col-md-8"><?php echo bloginfo('name'); ?> <?php echo date('Y'); ?> <?php the_field('footer_copyright','option'); ?></div>
            <div class="col-md-4 footer-odeme-logolari">
             <?php $footer_odeme_logo = get_field('odeme_logolari','option'); ?>

            <img src="<?php echo $footer_odeme_logo['url']; ?>" class="img-fluid">
                
               
            </div>
            
        </div>
    </div>
</div>
 <a href="#top" class="sayfa-basi"><i class="fas fa-arrow-up"></i></a>   
<?php wp_footer(); ?>

</body>
</html>
