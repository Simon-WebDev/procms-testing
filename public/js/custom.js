
 

 $(document).ready(function() {
 	
 	//add class to pagination to make small
 	$('ul.pagination').addClass('pagination-sm');


 	//back to top button
 	if ($('#back_to_top').length) {
 	    var scrollTrigger = 400, // px
 	    backToTop = function () {
 	        var scrollTop = $(window).scrollTop();
 	        if (scrollTop > scrollTrigger) {
 	            $('#back_to_top').addClass('show');
 	        } else {
 	            $('#back_to_top').removeClass('show');
 	        }
 	    };
 	    backToTop();
 	    $(window).on('scroll', function () {
 	        backToTop();
 	    });
 	    $('#back_to_top span').hover(function() {
 	    	$(this).css({'backgroundColor':'#CD2122','color':'#fff'})
 	    }, function() {
 	    	$(this).css({'color':'#cd2122', 'backgroundColor':'transparent'})
 	    });
 	    $('#back_to_top').on('click', function (e) {
 	        e.preventDefault();
 	        $('html,body').animate({
 	        scrollTop: 0
 	        }, 700);
 	    });
 	}
 });

 
