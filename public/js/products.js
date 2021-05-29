let lim = 7;
let totalNow = 7;
let productContainer = document.querySelector("#productRows");
let allProducts = $(".btn-white").val();

function loadProducts(id, isCatChosen)
{ 
    console.log(allProducts);
    if(totalNow < allProducts) {
        productContainer.insertAdjacentHTML("beforeend",'<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
        theAjax(id, lim, isCatChosen, totalNow);
    }
}

function theAjax( catId, limit, isCatChosen, totalDisplayed)
{
        let id = isCatChosen ? catId : -1;
        return $.ajax({
            url:  '/loadProducts',
            type: 'GET',
            data: {categoryId: id, limit: limit, totalDisplayed: totalDisplayed}
        }).done(processData);
}

// function doAjax()
// {   lim = lim + 7;
//     let cId = categoryId;
//     //alert(JSON.stringify($('#showMore').val()));
//     //category Id of the products showed
//     ajax = theAjax('loadProducts', cId, lim);
//     ajax.done(processData);
//     ajax.fail(function(){alert("failure")});
// }

function processData(response) {
    response = JSON.parse(response);
    if(!response)
    {
        alert("is not set");
    }
    totalNow += response.length;
    //nuk ka response
    let spinner = document.querySelector(".spinner-border");
    productContainer.removeChild(spinner);

    response.forEach(product =>{
        productContainer.insertAdjacentHTML('beforeend',`
        <div class="col-md-4">
            <div class="product-item-wrapper">
                <div class="image-wrapper">
                    <form action="" method="POST">
                    <a href="" name="butoniProdukt" value="${product.id}">
                    <img id="images" class="img-fluid" src="${product.imagePath}" alt="">
                    </a>
                    </form>
                </div>
                <div class="product-description">
                    <p class="product-text">
                     ${product.description}                    
                    </p>
                </div>
            </div>
        </div>`);
    });
}
