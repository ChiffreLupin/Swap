let searchBy = "product";
let productsContainer = document.querySelector(".products");
$(function(){
    $('input[type = radio]').change(function(){
        if($(this).is(':checked')) {
            var selectedValue = $(this).val();
            searchBy = selectedValue;
            $('.form-control').attr('placeholder', 'Search ' + selectedValue);
        }
    });
});

document.querySelector(".searchbar").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        let searchValue = $(".searchbar").val();
        window.location.replace(`/home?searchBy=${searchBy}&searchValue=${searchValue}`);
    }
});

function performSearch() {
    let searchValue = $(".searchbar").val();
    window.location.replace(`/home?searchBy=${searchBy}&searchValue=${searchValue}`);
}

$(document).ready(() => {
    if($(".pass-btn").val()) {
        $('#changePasswordModal').modal('show');
    }
});

function deleteProduct(prod_id) {
    $.ajax({
        url: "/deleteProduct",
        method: "POST",
        data: {product_id: prod_id}
    }).done(function(resp) {
        if(resp) {
            let toRemove = document.querySelector(`.prod-${prod_id}`);
            productsContainer.removeChild(toRemove);
        }
    });
}