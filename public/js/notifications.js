
let buttons = document.querySelector(".notification-action");
function acceptSwap(swap_id, notif_id) {
    $.ajax({
        url: "/acceptSwap",
        type: "POST",
        data: {"swap_id": swap_id, "notif_id": notif_id}
    })
    .done((res) => { 
        console.log(res);
        buttons.classList.add("d-none");
    });
}