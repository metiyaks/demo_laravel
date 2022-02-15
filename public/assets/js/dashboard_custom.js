$(document).ready(function () {
    var userData = JSON.parse(window.localStorage.getItem("user"));
    $("#usr_name").text(userData.email);
    $("#events_menu").hide();
    $("#sm").hide();
    $("#m").hide();
    $("#clients").hide();
    $("#op").hide();
    $("#user-bets").hide();
    if (userData.u_role == "1") {
        $("#events_menu").show();
        $("#default_setting").show();
        $("#sm").hide();
        $("#m").hide();
        $("#clients").hide();
        $("#op").hide();
    }
    if (userData.u_role == "2") {
        $("#sm").show();
        $("#m").show();
        $("#clients").show();
        $("#op").show();
    }
    
});

function logout() {
    window.localStorage.removeItem("token");
    window.localStorage.removeItem("user");
    window.location.href = hostname + "login";
}

function getBalance_bk() {
    return $.ajax({
        type: "POST",
        url: hostname + "api/getExposerAdmin",
        headers: {
            Authorization: "Bearer " + window.localStorage.getItem("token"),
        },
        dataType: "json",
        cache: false,
        success: function (data) {
            if (data.data) {
                $("#balance").text(data.data.bal);
                $("#exposer").html(data.data.exp);
                $("#current_balance").html(data.data.bal);
                $("#mainBalance").val(data.data.bal);
            }

        },
        error: function (xhr) {
            if (xhr.status == 401) {
                swal({
                    title: xhr.responseJSON.message,
                    text: "Please Login Again...",
                    type: "success",
                    confirmButtonText: "Login",
                    confirmButtonClass: "btn btn-default",
                });
                $(".swal2-confirm").click(function () {
                    window.location.href = hostname + "login";
                });
            }
        },
    });
}

function dateFormate(date) {
    var new_date = date + "+00:00";
    var d = new Date(new_date);
    return d.toLocaleDateString("en-US",
        {
            month: 'short',
            day: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
}


function getParams(key) {
    return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
}


