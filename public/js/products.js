let lim = 7;
let productContainer = document.querySelector("#productRows");
function loadProducts(id)
{ 
    productContainer.innerHTML = '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>';
    lim += 7;
    setTimeout(() => theAjax(id, lim),3000);
}

function theAjax( catId, limit)
{
        return $.ajax({
            url:  '/loadProducts',
            type: 'GET',
            data: {categoryId: catId, limit: limit}
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
    //nuk ka response
    productContainer.innerHTML = "";
    response.forEach(product =>{
        productContainer.insertAdjacentHTML('beforeend',`
        <div class="col-md-4">
            <div class="product-item-wrapper">
                <div class="image-wrapper">
                    <form action="" method="POST">
                    <a href="" name="butoniProdukt" value="${product.id}">
                    <img id="images" class="img-fluid" src="${product.image_Path}" alt="">
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
