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
    if($(".edit-product-btn").val()) {
        $('#editProductModal').modal('show');
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

function setIdForModal(id, product) {
    console.log(product);
    $("#EditBox input[name = name]").val(product.name);
    $("#EditBox select").val(product.category_id);
    let select = document.querySelector("#EditBox select");
    const options = Array.from(select.options);
    console.log(options);
    options.forEach((option, i) => {
    if (option.value === product.category_id) select.selectedIndex = i+1;
    });
    $("#EditBox input[name = amount]").val(product.amount);
    $(".prod-description").val(product.description);    
    
    $(".product_id").val(id);
}