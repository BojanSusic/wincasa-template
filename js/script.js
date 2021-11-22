// Find all iframes
var $iframes = $( "iframe" );
 
// Find & save the aspect ratio for all iframes
$iframes.each(function () {
$( this ).data( "ratio", this.height / this.width )
// Remove the hardcoded width & height attributes
.removeAttr( "width" )
.removeAttr( "height" );
});
 
// Resize the iframes when the window is resized
$( window ).resize( function () {
$iframes.each( function() {
// Get the parent container's width
var width = $( this ).parent().width();
$( this ).width( width )
.height( width * $( this ).data( "ratio" ) );
});
// Resize to fix all iframes on page load.
}).resize(); 


  // Open external links in a new window or tab
  $(document).on('click', 'a[rel$="external"]', function() {
    $(this).attr('target', "_blank");
  });
    
  $(document).on('click', 'a[href$=".pdf"]', function() {
    $(this).attr('target', "_blank");
  }); 
    
  // Open all urls that don't belong to our domain in a new window or tab
  $(document).on('click', "a[href^='http:']:not([href*='" + window.location.host + "'])", function() {
    $(this).attr("target", "_blank");
  });
  




$(document).ready(function() {
       
	
	
     
    
    
    $(".wp-caption").removeAttr("style");

    
    
    // Add minus icon for collapse element which is open by default
    $(".accordion .collapse.show").each(function(){
        $(this).prev(".card-header").find(".fas").addClass("collapse-icon-minus").removeClass("collapse-icon-plus");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".accordion .collapse").on('show.bs.collapse', function(){
        $(this).prev(".card-header").find(".fas").removeClass("collapse-icon-plus").addClass("collapse-icon-minus");
    }).on('hide.bs.collapse', function(){
        $(this).prev(".card-header").find(".fas").removeClass("collapse-icon-minus").addClass("collapse-icon-plus");
    });          
    
    
    
    /*
    $('.gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300, 
            opener: function (element) {
                return element.find('img');
            }
        }

    });
    */
    
  $('.gallery').each(function() { // the containers for all your galleries
      $(this).magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300, // don't foget to change the duration also in CSS
            opener: function (element) {
                return element.find('img');
            }
        }
      });
  });    
    
    
    
    
    
    $('.foto').magnificPopup({
        type: 'image',
        zoom: {
            enabled: true,
            duration: 300, // don't foget to change the duration also in CSS
            opener: function (element) {
                return element.find('img');
            }
        }
        // other options
    });
    
    
    
});

$(document).on('click', '#modal',function(){
	 var id = $(this).data('target').substring(1);
	 var reference_number = $(this).data('number');
	 $('.modal').removeAttr('id');
	 var modal = $('.modal').attr('id',id);
	 $('.modal-title').html('Objekt-Nr. ' +reference_number);
	 $('#' + id).modal('show'); 
     if($('#' + id + ' ' + '.modal-body .carousel')['length'] !== 0){ 
	 $('.modal-body').html('<div class="spinner   d-flex flex-column justify-content-center align-items-center w-100"><div class="d-none  spinner-border text-secondary " role="status"><span class="sr-only">Loading...</span></div></div>');
	 }
	 const request = $.ajax({
        url: window.location.origin + "/wp-json/api/v1/get-slider?id=" + reference_number,
        type: "get",
        data:''
    });
	$('.modal-body .spinner-border').removeClass('d-none');
    // Callback handler that will be called on success

   request.always(function(response) {
	   $('.modal-body').append(response['responseText']);
		   $('.modal-body .spinner-border').addClass('d-none');
    
  });

});

$( document ).ready(function() {
		let i = 0;
	$(document).scroll(function(){
		if(i < 1){
			$('.hero2').removeClass('d-none');
				if(!$(".um-field-checkbox").hasClass('active')){
						$("#um-submit-btn").attr("disabled", true);
					}
	$(".um-terms-conditions-content").remove();
	$(".um-toggle-terms").attr("href", document.location.origin + '/datenschutzerklaerung/');
	$(".um-field-type_terms_conditions").attr("style", "display: flex; flex-direction: row-reverse; justify-content: center;");
	
	 $(".um-field-checkbox").click(function() {
                    if($(".um-field-checkbox").hasClass('active')){
						$("#um-submit-btn").attr("disabled", true);
					}else{
						$("#um-submit-btn").attr("disabled", false);
					}
                });
			i++;
		}
	})
	 var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
		breakpoints: {
			991: {
      			slidesPerView: 3,
      			spaceBetween: 10
    		},
			520: {
      			slidesPerView: 2,
      			spaceBetween: 10
    		},
			
    	},
      });

});
