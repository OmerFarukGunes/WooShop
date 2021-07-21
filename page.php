<?php get_header(); ?>
<?php while(have_posts()): the_post(); ?>
<div class="container sayfa beyaz-kutu">
<h1 class="kalin-baslik"><?php the_title(); ?></h1>
<?php the_content(); ?>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>