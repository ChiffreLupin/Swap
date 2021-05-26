$(function(){
    $('input[type = radio]').change(function(){
        if($(this).is(':checked')) {
            var selectedValue = $(this).val();
            $('.form-control').attr('placeholder', 'Search ' + selectedValue);
        }
    });
});