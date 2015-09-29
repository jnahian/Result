(function ($) {

    submitMyForm = function (that, e) {
        var t = $(that),
                form = t.parents('form'),
                method = form.attr('method'),
                action = form.attr('action');

        form.one("submit", function (e) {
            e.preventDefault();

            data = new FormData(this);

            $.ajax({
                url: action,
                type: method,
                data: data,
                processData: false,
                contentType: false,
                mimetype: "multipart/form-data",
                dataType: "json",
                success: function (ret) {
//                    alert(ret);
                    if (ret.success) {
                        if(ret.redirect){
                            window.location.href = ret.redirect_to;
                        }
                        if (ret.message != '') {
                            alert(ret.message);
                        }
                    } else {
                        alert(ret.message);
                    }
<<<<<<< HEAD
                    $('.reset').click();
=======
                    window.location.href = './';
>>>>>>> origin/master
                },
                error: function (ret) {
                    alert('AJAX Error!');
                }
            });

        });
    }

    load_part = function (that, e) {
        e.preventDefault();
        $t = $(that).attr('href');
        $('.content').load($t);
    }

    addnew = function (that, e) {
        e.preventDefault();
        $t = $(that).parents('.col-sm-12').children('.single:first-child').html();
        $(that).parents('.col-sm-12').append('<div class="row single">' + $t + '</div>');
    }

    $(document).on('keyup', function (e) {

        if (e.keyCode == 18) {
            $('.add').removeClass('btn-danger').children('i').removeClass('fa-close').addClass('fa-plus');
            addnew = function (that, e) {
                e.preventDefault();
                $t = $(that).parents('.col-sm-12').children('.single:first-child').html();
                $(that).parents('.col-sm-12').append('<div class="row single">' + $t + '</div>');
            }
        }

    });

    $(document).on('keydown', function (e) {

        if (e.keyCode == 18) {
            $('.add').addClass('btn-danger').children('i').removeClass('fa-plus').addClass('fa-close');

            addnew = function (that, e) {
                e.preventDefault();
                $(that).parents('.single:not(:only-child)').remove();
            }

        }

    });


    $('#add').on('click', function (e) {
        e.preventDefault();
        alert('hay!');
    });

    cngSection = function (that) {
        var t = $(that),
                value = t.val();

        $.ajax({
            url: 'inc/options.php',
            type: 'post',
            data: {val: value, OP: 'CNGSEC'},
            success: function (ret) {
                $('.option2').html(ret);
            },
            error: function () {
                alert('ajax error');
            }
        });
    }
    
    stu_list = function (that) {
        var t = $(that),
                value = t.val(),
                cls = $('.option1').val();

        $.ajax({
            url: 'inc/options.php',
            type: 'post',
            data: {section: value, class: cls, OP: 'STULST'},
            success: function (ret) {
                $('.option3').html(ret);
            },
            error: function () {
                alert('ajax error');
            }
        });
    }

    sub_list = function (that) {
        var t = $(that),
                id = t.val(),
                sec = $('.option2').val(),
                cls = $('.option1').val();
        
//        alert(id+'/'+sec+'/'+cls);

        $.ajax({
            url: 'inc/options.php',
            type: 'post',
            data: {section: sec, class: cls, stuid: id, OP: 'SUBLST'},
            success: function (ret) {
//                alert(ret);
                $('.subjects').html(ret);
            },
            error: function () {
                alert('ajax error');
            }
        });
    }
    
    search_res = function (that, e) {
        var t = $(that),
                form = t.parents('form'),
                method = form.attr('method'),
                action = form.attr('action');

        form.one("submit", function (e) {
            e.preventDefault();

            data = new FormData(this);

            $.ajax({
                url: action,
                type: method,
                data: data,
                processData: false,
                contentType: false,
                mimetype: "multipart/form-data",
                success: function (ret) {
//                    alert(ret);
                    if(ret != ''){
                        $('.show_res').html(ret);
                    } else {
                        alert('Input field Empty!');
                    }
                },
                error: function (ret) {
                    alert('AJAX Error!');
                }
            });

        });
    }
    
    deleteItem = function (that, $tablename) {
        var t = $(that),
            rowId = t.data('id');
//        alert($id)

        if (confirm('Warning!!! Are You Sure, you want to delete this item')) {
            $.ajax({
                url: 'func/form_submit.php',
                type: 'POST',
                data: ({table: $tablename, OP: "DEL", rowid: rowId }),
                dataType: 'json',
                success: function (ret) {
                    t.parents('tr').remove();
                },
                error: function () {
                    alert("Ajax Error!!!");
                }
            });
        }
        return false;
    }
    
    cng_option_value = function (that) {
        $val = $(that).val();
        if( $val == 0 ){
            $val = $(that).val(1);
        } else if( $val == 1 ){
            $val = $(that).val(0);
        }
       
//        alert($val);
       
    }
}(jQuery))
