$(document).ready(function () {

    $('.overlay').outerHeight($(document).outerHeight()*5);

    $('.loading, .overlay').fadeOut();


    /**
     * Delete client
     */

    $('.delete_client_button').click(function (e) {
        e.preventDefault()
        if (confirm('Do you want delete?')){

            var id = $(this).attr('id'),
                tr = $('.tr_'+id),
                form = $(this).parent('.delete_client_form'),
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


    /**
     * Active/de active client
     */

    $('.active_client_link').click(function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $(this).toggleClass('btn-success btn-warning');
        $(this).children().toggleClass('fa-check fa-close');
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
        });

    });


    /**
     * Get government details by id and show it on modal
     */

    $('a.update_government_link').click(function () {

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
                $('.update_government_modal .modal-body').html(data);
                $('.loading, .overlay').fadeOut();
            }
        });

    });


    /**
     * Create government
     */

    $('.create_government_button').click(function () {


        var form = $('.create_government_form'),
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

                    $('input[type="text"]').val('');

                    var buffer = setInterval(function () {
                        window.location.reload();
                        clearInterval(buffer)
                    }, 200);
                }

                $('.loading, .overlay').fadeOut();
            }
        });

    })



    /**
     * Update government
     */

    $('.update_government_button').click(function () {


        var form = $('.update_government_form'),
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

                }

                $('.loading, .overlay').fadeOut();
            }
        });

    })


    /**
     * Delete government
     */

    $('.delete_government_button').click(function (e) {
        e.preventDefault()
        if (confirm('Do you want delete?')){

            var id = $(this).attr('id'),
                tr = $('.tr_'+id),
                form = $(this).parent('.delete_government_form'),
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


    /**
     * Get city details by id and show it on modal
     */

    $('a.update_city_link').click(function () {

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
                $('.update_city_modal .modal-body').html(data);
                $('.loading, .overlay').fadeOut();
            }
        });

    });

    /**
     * Create city
     */

    $('.create_city_button').click(function () {


        var form = $('.create_city_form'),
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

                    $('input[type="text"]').val('');

                    var buffer = setInterval(function () {
                        window.location.reload();
                        clearInterval(buffer)
                    }, 200);
                }

                $('.loading, .overlay').fadeOut();
            }
        });

    })


    /**
     * Update city
     */

    $('.update_city_button').click(function () {


        var form = $('.update_city_form'),
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

                }

                $('.loading, .overlay').fadeOut();
            }
        });

    })


    /**
     * Delete city
     */

    $('.delete_city_button').click(function (e) {
        e.preventDefault()
        if (confirm('Do you want delete?')){

            var id = $(this).attr('id'),
                tr = $('.tr_'+id),
                form = $(this).parent('.delete_city_form'),
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


    /**
     * Get category details by id and show it on modal
     */

    $('a.update_category_link').click(function () {

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
                $('.update_category_modal .modal-body').html(data);
                $('.loading, .overlay').fadeOut();
            }
        });

    });


    /**
     * Create category
     */

    $('.create_category_button').click(function () {


        var form = $('.create_category_form'),
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

                    $('input[type="text"]').val('');

                    var buffer = setInterval(function () {
                        window.location.reload();
                        clearInterval(buffer)
                    }, 200);
                }

                $('.loading, .overlay').fadeOut();
            }
        });

    });


    /**
     * Update category
     */

    $('.update_category_button').click(function () {


        var form = $('.update_category_form'),
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

                }

                $('.loading, .overlay').fadeOut();
            }
        });

    })


    /**
     * Delete city
     */

    $('.delete_category_button').click(function (e) {
        e.preventDefault()
        if (confirm('Do you want delete?')){
            var id = $(this).attr('id'),
                tr = $('.tr_'+id),
                form = $(this).parent('.delete_category_form'),
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

            var form = $(this).parent('.delete_post_form'),
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


    $('.mark_as_read').click(function () {

        var id = $(this).data('id'),
            tr = $('.tr_'+id),
            url = $(this).data('url');

        $.ajax({
            url: url,
            type: 'get',
            success: function () {
                tr.remove();
                $('.read').html(Number($('.read').html()) + 1)
                $('.no_read').html(Number($('.no_read').html()) - 1)
            }
        });

    });

    $('.mark_as_unread').click(function () {

        var id = $(this).data('id'),
            tr = $('.tr_'+id),
            url = $(this).data('url');

        $.ajax({
            url: url,
            type: 'get',
            success: function () {
                tr.remove();
                $('.read').html(Number($('.read').html()) - 1)
                $('.no_read').html(Number($('.no_read').html()) + 1)
            }
        });

    });

    $('.delete_button').click(function () {
        
    });

});