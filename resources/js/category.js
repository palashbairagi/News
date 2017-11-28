/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){

    $( "#sortable tbody" ).sortable({ revert: true,
        update:function(event, ui){
            $.ajax({
                dataType: 'json',
                type:"POST",
                data: $("#sortable tbody").sortable("serialize"),
                url:BASE_URL+"admin/sort_news_order",
                success:function(data){
                    
                }
            });
        }
    });
    $( "#sortable tbody" ).disableSelection();
   
    $('.edit_news').click(function(){
        
        var id = $(this).parent().siblings('#id').text();
        var title = $(this).parent().siblings('.detail_title').val();
        var url = $(this).parent().siblings('.detail_url').val();
        var description = $(this).parent().siblings('.detail_description').html();
        var image = $(this).parent().siblings('#image').text();
        
        $(".edit_id").val(id);
        $(".edit_title").val(title);
        CKEDITOR.instances.description.setData(description);
        $('.edit_description').html(description);
        $(".edit_url").val(url);
        
        $('.image_placeholder').hide();
        if(image != '')
        {
            var image_url = BASE_URL+"resources/img/news_image/"+id+"/"+image;
            $(".edit_image").after("<br><img class='image_placeholder' src="+image_url+" style='height:150px;width:150px;'>");
        }
        else
        {
            $(".edit_image").after("<label class='image_placeholder'>No Image</label>");
        }
        
    });
    
    $('.view_news').click(function(){
        
        var id = $(this).parent().siblings('#id').text();
        var title = $(this).parent().siblings('.detail_title').val();
        var url = $(this).parent().siblings('.detail_url').val();
        var description = $(this).parent().siblings('.detail_description').html();
        var image = $(this).parent().siblings('#image').text();
        
        $(".view_id").text(id);
        $(".view_title").text(title);
        $(".view_description").html(description);
        
        $('.image_placeholder').hide();
        if(image != '')
        {
            var image_url = BASE_URL+"resources/img/news_image/"+id+"/"+image;
            $(".view_image").after("<br><img class='image_placeholder' src="+image_url+" style='height:150px;width:150px;margin-bottom:20px;'>");
        }
        else
        {
            $(".view_image").after("<label class='image_placeholder'>No Image</label>");
        }
        
    });
    
    $('.delete_news').click(function(e){
        
        if(confirm("Are you sure to delete this?")==false)
        {
            e.preventDefault();
        }
    });
    
    $('.save_news').click(function(e){
        e.preventDefault();
        if($('.save_image').val()!='')
        {
            
            var ext = $('.save_image').val().split('.').pop().toLowerCase();
            if($.inArray(ext,['jpg','jpeg','gif','bmp','png'])== -1)
            {
                $('.image_error').remove();
                $('.save_image').after("<span class='image_error'><br>Please select a valid image.</span>");
                return;
            }
            else
            {
                $('.image_error').remove();
                $('.save_form .modal-content').waitMe({
                	effect : 'bounce'
            	});
                $('.save_form').submit();
            }
        }
        else
        {
            $('.image_error').remove();
            $('.save_image').after("<span class='image_error'><br>Please select an Image</span>");
            return;
        }
        
    });
    
    $('.update_news').click(function(e){
        
        e.preventDefault();
        if($('.update_image').val()!='')
        {
            var ext = $('.update_image').val().split('.').pop().toLowerCase();
            if($.inArray(ext,['jpg','jpeg','gif','bmp','png'])== -1)
            {
                $('.image_error').remove();
                $('.image_placeholder').after("<span class='image_error'><br>Please select a valid image.</span>");
                
                return;
            }
            else
            {
                $('.image_error').remove();
                $('.update_form .modal-content').waitMe({
                	effect : 'bounce'
            	});
                $('.update_form').submit();
            }
        }
        else
        {
            $('.update_form .modal-content').waitMe({
                effect : 'bounce'
            });
            $('.update_form').submit();
        }
    });
    
    $('.edit_video').click(function(){
        
        var id = $(this).parent().siblings('#id').text();
        var title = $(this).parent().siblings('.detail_title').val();
        var url = $(this).parent().siblings('.detail_url').val();
        var description = $(this).parent().siblings('.detail_description').html();
        var image = $(this).parent().siblings('#image').text();
        
        $(".edit_id").val(id);
        $(".edit_title").val(title);
        CKEDITOR.instances.description.setData(description);
        $('.edit_description').html(description);
        $(".edit_url").val(url);
        
        $('.image_placeholder').hide();
        if(image != '')
        {
            var image_url = BASE_URL+"resources/img/news_image/"+id+"/"+image;
            $(".edit_image").html('<video width="320" height="240" controls><source src="'+image_url+'" type="video/mp4"></video>');
        }
        else
        {
            $(".edit_image").html("<label class='image_placeholder'>No Image</label>");
        }
        
    });
    
    $('.view_video').click(function(){
        
        var id = $(this).parent().siblings('#id').text();
        var title = $(this).parent().siblings('.detail_title').val();
        var url = $(this).parent().siblings('.detail_url').val();
        var description = $(this).parent().siblings('.detail_description').html();
        var image = $(this).parent().siblings('#image').text();
        
        $(".view_id").text(id);
        $(".view_title").text(title);
        $(".view_description").html(description);
        
        $('.image_placeholder').hide();
        if(image != '')
        {
            var image_url = BASE_URL+"resources/img/news_image/"+id+"/"+image;
            $(".view_image").html('<video width="320" height="240" controls><source src="'+image_url+'" type="video/mp4"></video>');
        }
        else
        {
            $(".view_image").html("<label class='image_placeholder'>No Image</label>");
        }
        
    });
    
    $('.save_video').click(function(e){
        e.preventDefault();
        if($('.save_image').val()!='')
        {
            
            var ext = $('.save_image').val().split('.').pop().toLowerCase();
            if($.inArray(ext,['mp4'])== -1)
            {
                $('.image_error').remove();
                $('.save_image').after("<span class='image_error'><br>Please select a valid video.</span>");
                return;
            }
            else
            {
                $('.image_error').remove();
                $('.save_form .modal-content').waitMe({
                	effect : 'bounce'
            	});
                $('.save_form').submit();
            }
        }
        else
        {
            $('.image_error').remove();
            $('.save_image').after("<span class='image_error'><br>Please select a Video</span>");
            return;
        }
        
    });
    
    $('.update_video').click(function(e){
        
        e.preventDefault();
        if($('.update_image').val()!='')
        {
            var ext = $('.update_image').val().split('.').pop().toLowerCase();
            if($.inArray(ext,['mp4'])== -1)
            {
                $('.image_error').remove();
                $('.image_placeholder').after("<span class='image_error'><br>Please select a valid video.</span>");
                
                return;
            }
            else
            {
                $('.image_error').remove();
                $('.update_form .modal-content').waitMe({
                	effect : 'bounce'
            	});
                $('.update_form').submit();
            }
        }
        else
        {
            $('.update_form .modal-content').waitMe({
                effect : 'bounce'
            });
            $('.update_form').submit();
        }
    });
    
    $('.main_news').click(function(){
        var news_id = $(this).val();
        var category_id = $(this).data('category-id');
        window.location.href = BASE_URL+"admin/update_main_news/"+news_id+"/"+category_id;
    });

    $('.other_news').click(function(){
        var news_id = $(this).val();
        var category_id = $(this).data('category-id');
        if($(this).is(':checked'))
        {
            window.location.href = BASE_URL+"admin/update_other_news/"+news_id+"/"+category_id+"/1";
        }
        else
        {
            window.location.href = BASE_URL+"admin/update_other_news/"+news_id+"/"+category_id+"/0";
        }
    });

    $('.popular_news').click(function(){
        var news_id = $(this).val();
        var category_id = $(this).data('category-id');
        if($(this).is(':checked'))
        {
            $.ajax({
                type:"POST",
                dataType: "JSON",
                data: "is_checked=1",
                url:BASE_URL+"admin/update_popular_news/"+news_id+"/"+category_id,
                success:function(response)
                {
                    $('.alert-success').find('i').html(response.msg);
                    $('.alert-success').show();
                }
            });
            
        }
        else
        {
            $.ajax({
                type:"POST",
                dataType: "JSON",
                data: "is_checked=0",
                url:BASE_URL+"admin/update_popular_news/"+news_id+"/"+category_id,
                success:function(response)
                {
                    $('.alert-success').find('i').html(response.msg);
                    $('.alert-success').show();
                }
            });
        }
    });
    
});
