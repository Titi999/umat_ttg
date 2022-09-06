$(document).ready(function(){
    $(".tab-item").click(function(){
        var filterValue = $(this).attr('data-filter');

        $('.filter-item').not('.'+filterValue).hide();

        $('.filter-item').filter('.'+filterValue).show();

        $(this).parent().find('.active').removeClass('active')
        $(this).addClass('active');
        

    });
});
