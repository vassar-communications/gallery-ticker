//	this being WordPress, I need to use the `jQuery` function rather than $


jQuery(document).ready(function(){

	//	the ticker
	jQuery('.tt__ticker-container').flickity({
	  // options
	  cellAlign: 'left',
	  contain: true,
		wrapAround: true,
		fade: true,
		autoPlay: 6000
	});

	//	galleries
	jQuery('.wp-block-gallery').flickity({
	  // options
	  cellAlign: 'left',
	  contain: true,
		wrapAround: true,
	imagesLoaded: true,
	});	
});
