
console.log("Product Details executed");
let offerButton  = document.getElementById("OfferButton");
let offersContainer = document.querySelector(".offers");

console.log(offersContainer);

let loadOffers = function(id) {
    lower.classList.toggle("hidden");
    if(!lower.classList.contains("hidden")) {
        // lower.insertAdjacentHTML('beforeend',"<div class='spinner-border' role='status'><span class='visually-hidden'>Loading...</span></div>");
        $.ajax({
            url: "/php/loadOffers.php",
            type: "POST",
            data: {"method": "loadOffers", "id": id}
        })
        .done(processData);
    }
    else {
        offersContainer.innerHTML = "";
    }
}

function processData(response) {
    let offerables = JSON.parse(response);

    offerables.forEach(offer => {
        offersContainer.insertAdjacentHTML('beforeend',`
        <div class="card col-md-3" style='width: 18rem;'>
            <form action="" method="POST">
            <img src="${offer.imagePath}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">${offer.name}</h5>
                <p class="card-text">${offer.description}</p>
                <a href="#" class="btn btn-primary btn-card">Send Offer</a>
            </div>
            </form>
        </div>
        `);
    });
    offersContainer.scrollIntoView({behavior:"smooth"});
}