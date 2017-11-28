jQuery(document).ready(function() {
    // for hover dropdown menu
    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
    });
    // slick slider call 
    $('.slick_slider').slick({
        dots: true,
        infinite: true,
        speed: 800,
        slidesToShow: 1,
        slide: 'div',
        autoplay: true,
        autoplaySpeed: 5000,
        cssEase: 'linear'
    });
    // latest post slider call 
    $('.latest_postnav').newsTicker({
        row_height: 64,
        speed: 800,
        prevButton: $('#prev-button'),
        nextButton: $('#next-button')
    });
    jQuery(".fancybox-buttons").fancybox({
        prevEffect: 'none',
        nextEffect: 'none',
        closeBtn: true,
        helpers: {
            title: {
                type: 'inside'
            },
            buttons: {}
        }
    });
    // jQuery('a.gallery').colorbox();
    //Check to see if the window is top if not then display button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });
    //Click event to scroll to top
    $('.scrollToTop').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    $('.tootlip').tooltip();
    $("ul#ticker01").liScroll();

    $('.add_comment').click(function(){
        
        $.ajax({
            dataType: 'json',
            type:"POST",
            data: $("#comment_form").serialize(),
            url:BASE_URL+"pages/add_comment",
            beforeSend: function(){
                $('.loader').show();
            },
            success:function(data){
                if(data.rc)
                {
                    $('.success_msg').html(data.msg);
                    $("#comment_form")[0].reset();
                    $('.validation_errors').html('');
                }
                else
                {
                    $('.validation_errors').html(data.msg);
                }
                $('.loader').hide();
            }
        });
    });
});

wow = new WOW({
    animateClass: 'animated',
    offset: 100
});
wow.init();

jQuery(window).load(function() { // makes sure the whole site is loaded
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(100).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(100).css({
        'overflow': 'visible'
    });
});

function addLikes(id,action) {
    $('.demo-table #news-'+id+' li').each(function(index) {
        $(this).addClass('selected');
        $('#news-'+id+' #rating').val((index+1));
        if(index == $('.demo-table #news-'+id+' li').index(obj)) {
            return false;   
        }
    });
    $.ajax({
    url: BASE_URL+"pages/likes",
    data:'id='+id+'&action='+action,
    dataType: "JSON",
    type: "POST",
    beforeSend: function(){
        $('#news-'+id+' .btn-likes').html("<img src='"+BASE_URL+"/resources/frontend/images/loaderIcon.gif' />");
    },
    success: function(data){
	    var likes = parseInt($('#likes-'+id).val());
	    
	    $('#news-'+id+' .btn-likes').html('<button type="button" title="liked" class="fa fa-thumbs-up like" />');
	    $('#news-'+id+' .btn-unlikes').html('<button type="button" title="Unliked" class="fa fa-thumbs-o-down unlike" />')
	
	    if(data.status)
        {
            likes = likes+1;
        } 
	        
	    $('#likes-'+id).val(likes);
	    if(likes>0) {
	        $('#news-'+id+' .label-likes').html(likes+" Like(s)");
	    } else {
	        $('#news-'+id+' .label-likes').html('');
	    }
    }
    });
}

function addUnlikes(id,action) {
    $('.demo-table #news-'+id+' li').each(function(index) {
        $(this).addClass('selected');
        $('#news-'+id+' #rating').val((index+1));
        if(index == $('.demo-table #news-'+id+' li').index(obj)) {
            return false;   
        }
    });
    $.ajax({
    url: BASE_URL+"pages/unlikes",
    data:'id='+id+'&action='+action,
    dataType: "JSON",
    type: "POST",
    beforeSend: function(){
        $('#news-'+id+' .btn-unlikes').html("<img src='"+BASE_URL+"/resources/frontend/images/loaderIcon.gif' />");
    },
    success: function(data){
        // if(data.rc == true)
        // {
            var unlikes = parseInt($('#unlikes-'+id).val());
            
            $('#news-'+id+' .btn-likes').html('<button type="button" title="liked" class="fa fa-thumbs-o-up like" />');
            $('#news-'+id+' .btn-unlikes').html('<button type="button" title="Unliked" class="fa fa-thumbs-down unlike" />')
            if(data.status)
        {
            unlikes = unlikes+1;
        }

            $('#unlikes-'+id).val(unlikes);
            if(unlikes>0) {
                $('#news-'+id+' .label-unlikes').html(unlikes+" Unlike(s)");
            } else {
                $('#news-'+id+' .label-unlikes').html('');
            }
        // }
    }
    });
}