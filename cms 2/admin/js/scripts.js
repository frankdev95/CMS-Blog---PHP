$('#selectAllBoxes').click(function() {
    if (this.checked) {
        $('.checkBoxes').each(function() {
            this.checked = true;
        });
    } else {
        $('.checkBoxes').each(function() {
            this.checked = false;
        });
    }
});

$("#load-screen").delay(100).fadeOut(500, function() {
    $(this).remove();
});

function loadUsersOnline() {
    $.get("functions.php?onlineUsers=result", function(data) {
     $(".users-online").text(data);
    });
}

setInterval(function() {
    loadUsersOnline();  
}, 500);

