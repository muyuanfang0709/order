$(function() {

    //模拟下拉框
    $('.select input').on('click', function () {
        if ($('.select .food').is('.hide')) {
            $('.select .food').removeClass('hide');
        } else {
            $('.select .food').addClass('hide');
        }
    })



    $('.select ul li').on('click', function () {
        console.log($(this).html(), '$(this).html()');
        $('.select input').val($(this).html());
        $('.select .food').addClass('hide');
        $('.select input ').css('border-bottom', '1px solid $d6d6d6');
    })



    $('.select ul li').hover(function () {
        $(this).css({'backgroundColor': '#fd9', 'font-size': '14px'});
    }, function () {
        $(this).css({'backgroundColor': '#fff', 'font-size': '8px'});
    })


})