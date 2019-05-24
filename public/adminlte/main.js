$(document).ready(function () {

    $('.overlay').outerHeight($(document).outerHeight()*5);

    $('.loading, .overlay').fadeOut();


    /**
     * Get post details by id and show it on modal
     */

    $('a.posts_model_link').click(function () {

       $.ajax({
           url: $(this).data('href'),
           type: 'get',
           dataType: 'html',
           contentType: false,
           processData: false,
           beforeSend: function(){

               $('.loading, .overlay').fadeIn();
           },

           success: function (data) {
               $('.update_posts_modal .modal-body').html(data);
               $('.loading, .overlay').fadeOut();
           }
       });

   });


    /**
     * Show post image
     */

    $(document).on('change', '.img', function () {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.img_content').html('<img class="post_img" src="'+e.target.result+'">').removeClass('d-none');

        };

        reader.readAsDataURL(this.files[0]);

    });


    /**
     * Delete image
     */

    $(document).on('click', '.delete_img', function(){
        $('.img_content').html('');
        $('input#img').val('')
    });

    /**
     * Create post
     */

    $('.create_post_button').click(function () {

        var form = $('.create_post_form'),
            formData = new FormData(form[0]),
            url = form.attr('action');

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            contentType: false,
            processData: false,
            crossDomain: true,
            data: formData,

            beforeSend: function(){

                $('.loading, .overlay').fadeIn();
            },

            success: function (data) {
                if (data.status === 0){
                    $('.error_msg').removeClass('hidden').show();
                    $('.success_msg').hide();
                    $('.error_msg strong').html(data.msg);
                } else {
                    $('.success_msg').removeClass('hidden').show();
                    $('.error_msg').hide();
                    $('.success_msg strong').html(data.msg);

                    var buffer = setInterval(function () {
                        window.location.reload();
                        clearInterval(buffer)
                    }, 200);

                    // $("html, body").animate({ scrollTop: 0 });
                }

                $('.loading, .overlay').fadeOut();
            }
        });

    })

    /**
     * Update post
     */

    $('.update_post_button').click(function () {

        var form = $('.update_post_form'),
            formData = new FormData(form[0]),
            url = form.attr('action');

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            contentType: false,
            processData: false,
            crossDomain: true,
            data: formData,

            beforeSend: function(){

                $('.loading, .overlay').fadeIn();
            },

            success: function (data) {
                if (data.status === 0){
                    $('.error_msg').removeClass('hidden').show();
                    $('.success_msg').hide();
                    $('.error_msg strong').html(data.msg);
                } else {
                    $('.success_msg').removeClass('hidden').show();
                    $('.error_msg').hide();
                    $('.success_msg strong').html(data.msg);

                    var buffer = setInterval(function () {
                        window.location.reload();
                        clearInterval(buffer)
                    }, 200);

                    // $("html, body").animate({ scrollTop: 0 });
                }

                $('.loading, .overlay').fadeOut();
            }
        });

    })


    /**
     * Delete post
     */

    $('.delete_post_button').click(function (e) {
        e.preventDefault()

        if (confirm('Do you want delete?')){

            var id = $(this).attr('id'),
                tr = $('.tr_'+id);

            var form = $('.delete_post_form'),
                formData = new FormData(form[0]),
                url = form.attr('action');

            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,
                crossDomain: true,
                data: formData,

                beforeSend: function(){

                    $('.loading, .overlay').fadeIn();
                },

                success: function (data) {
                    if (data.status === 0){
                        $('.error_delete_msg').removeClass('hidden').show();
                        $('.success_delete_msg').hide();
                        $('.error_delete_msg strong').html(data.msg);
                    } else {

                        $('.success_delete_msg').removeClass('hidden').show();
                        $('.error_delete_msg').hide();
                        $('.success_delete_msg strong').html(data.msg);

                        tr.remove();

                        // var buffer = setInterval(function () {
                        //     window.location.reload();
                        //     clearInterval(buffer)
                        // }, 200);

                        // $("html, body").animate({ scrollTop: 0 });
                    }

                    $('.loading, .overlay').fadeOut();
                }
            });

        }




    });

});