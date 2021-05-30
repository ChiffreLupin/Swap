// let editBtn = document.querySelector(".edit");
// console.log(editBtn);
// editBtn.addEventListener('click', () => {
//     $("#exampleModal").modal('show');
// });

// let closeBtn = document.querySelector(".close");
// console.log(closeBtn);
// closeBtn.addEventListener('click', () => {
//     $("#exampleModal").modal('hide');
// });

// let closeXBtn = document.querySelector(".btn-close");
// console.log(closeXBtn);
// closeXBtn.addEventListener('click', () => {
//     $("#exampleModal").modal('hide');
// });

// let blockBtn = document.querySelector(".block-buton");
// console.log(blockBtn);

///ADMIN-CATEGORY
//Modal for edit button
$('.edit').on('click', function () {
    $("#exampleModal").modal('show');
});
$('.close').on('click', function () {
    $("#exampleModal").modal('hide');
});
$('.btn-close').on('click', function () {
    $("#exampleModal").modal('hide');
});

//Modal for Delete Button
$('.delete').on('click', function () {
    $("#exampleModal-danger").modal('show');
});
$('.close').on('click', function () {
    $("#exampleModal-danger").modal('hide');
});
$('.btn-close').on('click', function () {
    $("#exampleModal-danger").modal('hide');
});

//Modal for add Button
$('.add-cat').on('click', function () {
    $("#exampleModal-add").modal('show');
});
$('.close').on('click', function () {
    $("#exampleModal-add").modal('hide');
});
$('.btn-close').on('click', function () {
    $("#exampleModal-add").modal('hide');
});

///ADMIN-USER

//Modal for Delete Button
$('.delete-user').on('click', function () {
    $("#exampleModal-delete-user").modal('show');
});
$('.close').on('click', function () {
    $("#exampleModal-delete-user").modal('hide');
});
$('.btn-close').on('click', function () {
    $("#exampleModal-delete-user").modal('hide');
});

///block-buton CHANGE IT INTO unblock AND REVERSE
$('.block-buton').on('click', function () {
    if($(".block-buton").hasClass('unblock')){
        $(".block-buton").html('Block');
        $(".block-buton").removeClass("unblock");
    } else {
        $(".block-buton").html('Unblock');
        $(".block-buton").addClass("unblock");
    }
});


///ADMIN-NOTIF