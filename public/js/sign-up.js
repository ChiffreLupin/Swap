$('.terms-checkbox').on('click', function () {
    if($(".term-cond-btn").hasClass('disabled')){
        $(".term-cond-btn").removeClass("disabled");
    } else {
        $(".term-cond-btn").addClass("disabled");
    }
});