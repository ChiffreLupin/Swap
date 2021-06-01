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
let id;
$('.delete-user').on('click', function () {
    id = this.value;
    $("#exampleModal-delete-user").modal('show');
});
$('.close').on('click', function () {
    $("#exampleModal-delete-user").modal('hide');
});
$('.btn-close').on('click', function () {
    $("#exampleModal-delete-user").modal('hide');
});
$(".modal-delete").on('click', function() {
    $("#exampleModal-delete-user").modal('hide');

})

///block-buton CHANGE IT INTO unblock AND REVERSE
$('.block-buton').on('click', function () {
    console.log(this);
    if(this.classList.contains("unblock")){
        this.innerHTML = "Block";
        this.classList.remove("unblock");
    } else {
        this.innerHTML = "Unblock";
        this.classList.add("unblock");
    }
});




///ADMIN-NOTIF
let limit = 5;
let totalDisplayed = 5;
let loadUsers = document.querySelector(".load-users");
let allUsersNo = $(".load-users").val();
let usersContainer = document.querySelector(".users-container");
loadUsers.addEventListener('click', () => {
    $.ajax({
        url: "/getUsers",
        method: "GET",
        data: {limit: limit, totalDisplayed: totalDisplayed, searchValue: ""}
    }).done((resp) => {
        console.log(resp);
        if(!resp)
            return;
        totalDisplayed += limit;
        
        if(totalDisplayed >= allUsersNo ) {
            $(".load-users").hide();
        }

        resp = JSON.parse(resp);

        resp.forEach(user => {
            let blocked = user.blocked ? "Unblock" : "Block";

            usersContainer.insertAdjacentHTML("beforeend", `
            <ul class='list-group list-group-horizontal user-${user.id}'>
                    <li class='list-group-item col-md-2'>
                        <img src='/images/avat-01-512.png' class='img-fluid' width='50%'>
                    </li>
                    <li class='list-group-item col-md-6'>
                        <a href='#'>${user.username}</a>
                    </li>
                    <li class='list-group-item col-md-2'>
                        <button onclick="toggleBlockedUser(${user.id})" class='btn btn-warning block-buton block-buton-${user.id}' type='submit'>
                            ${blocked}
                        </button>
                    </li>
                    <li class='list-group-item col-md-2'>
                        <button value='${user.id}' class='btn btn-danger delete-user del-${user.id}' type='button'>
                            Delete
                        </button>
                    </li>
                </ul>
            `);
        });
        ///block-buton CHANGE IT INTO unblock AND REVERSE
        $('.block-buton').on('click', function () {
            console.log(this);
            if(this.classList.contains("unblock")){
                this.innerHTML = "Block";
                this.classList.remove("unblock");
            } else {
                this.innerHTML = "Unblock";
                this.classList.add("unblock");
            }
        });

        
    })
    
});



function toggleBlockedUser(id) {
    let btn = document.querySelector(`.block-buton-${id}`);
    let val;
    
    if(btn.innerText.trim() === 'Block') {
        val = 1;
    }
    else val = 0;
    console.log(val);
    $.ajax({
        url: "/toggleBlocked",
        method: "POST",
        data: {block_val: val, user_id: id}
    }).done((resp) => {
        if(val == 1) {
        $(".message").html("User has been blocked successfully!");
        }
        else {
            $(".message").html("User has been unblocked successfully!");
        }
        $(".message").slideDown();
        $(".message").addClass("alert-success");
        setTimeout(() => {
            $(".message").slideUp();
        },5000);
    });
}

function deleteUser() {
console.log(id);
    $.ajax({
        url: "/deleteUser",
        method: "POST",
        data: {user_id: id}
    }).done((resp) => {
        console.log(resp);
        if(resp) {
            $(`.user-${id}`).fadeOut();
            $(".message").html("User has been deleted successfully!");

            $(".message").slideDown();
            $(".message").addClass("alert-success");
            setTimeout(() => {
                $(".message").slideUp();
            },5000);
        }
    });
}