/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){

    $('.edit_news').click(function(){
        
        var id = $(this).parent().siblings('#id').text();
        var address = $(this).parent().siblings('.address').text();
        var state = $(this).parent().siblings('.state').text();
        var city = $(this).parent().siblings('.city').text();
        var pin = $(this).parent().siblings('.pin').text();
        var phone = $(this).parent().siblings('.phone').text();

        $(".edit_id").val(id);
        $(".edit_address").val(address);
        $(".edit_city").val(city);
        $(".edit_pin").val(pin);
        $(".edit_state").val(state);
        $(".edit_phone").val(phone);
        
    });
    
    $('.save_news1').click(function(e){
        e.preventDefault();
        if($('.save_image').val()!='')
        {
            
            var ext = $('.save_image').val().split('.').pop().toLowerCase();
            if($.inArray(ext,['jpg','jpeg','gif','bmp','png'])== -1)
            {
                $('.image_error').remove();
                $('.save_image').after("<span class='image_error'><br>Selecteer een geldige afbeelding.</span>");
                return;
            }
            else
            {
                $('.image_error').remove();
                $('.save_form').submit();
            }
        }
        else
        {
            $('.image_error').remove();
            $('.save_image').after("<span class='image_error'><br>Afbeelding is verplicht.</span>");
            return;
        }
        
    });
    
    $('.update_news1').click(function(e){
        
        if($('.update_image').val()!='')
        {
           e.preventDefault();
            var ext = $('.update_image').val().split('.').pop().toLowerCase();
            if($.inArray(ext,['jpg','jpeg','gif','bmp','png'])== -1)
            {
                $('.image_error').remove();
                $('.image_placeholder').after("<span class='image_error'><br>Selecteer een geldige afbeelding.</span>");
                
                return;
            }
            else
            {
                $('.image_error').remove();
                $('.update_form').submit();
            }
        }
        
    });
    
});
