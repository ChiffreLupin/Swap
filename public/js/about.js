let to = document.getElementById('scroll-to');
let by = document.getElementById('scroll-by');
to.addEventListener('click', navigateDown, false);

function navigateDown(e){
    by.scrollIntoView({
        behavior: "smooth"
    });
}

setTimeout(() =>  {
    $(".flash").hide();
},3000);