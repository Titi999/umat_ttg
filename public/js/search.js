$('#myInput').on('keyup', function() {
    var value = $(this).val();
    var patt = new RegExp(value, "i");

    $('#myTable').find('tr').each(function() {
        var $table = $(this);
        if (!($table.find('td').text().search(patt) >= 0)) {
            $table.not('.t_head').hide();
        }
        if (($table.find('td').text().search(patt) >= 0)) {
            $(this).show();
        } 
    });

});