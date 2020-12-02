$('.open-form').click(function(){
    if (!$(this).hasClass('open')){
        $('.form').css('display','block')
        $(this).addClass('open');
        $(this).text('CLOSE FORM');
    }
    else{
        $('.form').css('display','none')
        $(this).removeClass('open');
        $(this).text('OPEN FORM');
    }
});
