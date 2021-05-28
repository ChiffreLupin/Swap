
function acceptSwap(swap_id, notif_id) {
    $.ajax({
        url: "/acceptSwap",
        type: "POST",
        data: {"swap_id": swap_id, "notif_id": notif_id}
    })
    .done((res) => { 
        console.log(res);
        let buttons = document.querySelector(`.actions-${notif_id}`);
        buttons.classList.add("d-none");
    });
}

function deleteNotification(req_id) {
    $.ajax({
        url: "/deleteNotification",
        type: "POST",
        data: {"notif_id": req_id}
    })
    .done((res) => { 
        console.log(res);
        let row = document.querySelector(`.row-${req_id}`);
        row.classList.add("d-none");
    });
}