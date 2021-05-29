
let offerButton  = document.getElementById("OfferButton");
let offersContainer = document.querySelector(".offers");

function setSelectedSent(id) {
    document.querySelector(".sentInputHidden").value = id;
}


let loadOffers = function(id) {
    // Marker class
    lower.classList.toggle("hidden");
    

    if(!lower.classList.contains("hidden")) {

        // lower.insertAdjacentHTML('beforeend',"<div class='spinner-border' role='status'><span class='visually-hidden'>Loading...</span></div>");
        $.ajax({
            url: "/userProducts",
            type: "GET",
            data: {"id": id}
        })
        .done(processProducts);
    }
    else {
        $("#lower").slideToggle("slow");
        offersContainer.innerHTML = "";
    }
}

function processProducts(response) {
    let offerables = JSON.parse(response);
    if(!offerables)
        return;

    offerables.forEach(offer => {
        offersContainer.insertAdjacentHTML('beforeend',`
        <div class="card col-md-3">
            <img src="${offer.imagePath}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">${offer.name}</h5>
                <p class="card-text">${offer.description}</p>
                <a href="#" onclick="setSelectedSent(${offer.id})"class="btn btn-card" data-toggle="modal" data-target="#confirmModal">Send Offer</a>
            </div>
        </div>
        `);
    });
    $("#lower").slideToggle(300);
    

    lower.scrollIntoView({behavior:"smooth"});
}