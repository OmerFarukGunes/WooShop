;(function($){
	
$('.sayfa-basi').click(function () {
$('html, body').animate({
	scrollTop: 0
}, 800);
return false;
});		

$('.mobil-menu-icon').click(function(){
	
	$('.mobil-menu').toggleClass('mobilgostergizle');
	
	
});
	
	
$('.giris-slider').each(function () {
var swiper = new Swiper(this,{
autoplay: {
delay: 5000,
disableOnInteraction: false,

},
loop: true,
});
});

    
$('.kalin-baslik').html(function(){	
		var ayirma= $(this).text().split(' ');
		var sonkelime = ayirma.pop();
		return ayirma.join(" ") + (ayirma.length > 0 ? ' <strong>'+sonkelime+'</strong>' : sonkelime);   
});	    

	
})(jQuery);