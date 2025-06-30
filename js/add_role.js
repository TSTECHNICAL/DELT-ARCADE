$(document).ready(function() {
    // Function to handle the "Add Role" button click
    $("#add_role").click(function() {
        var add_item = $("#add_item").val().trim();
        var roleid = $("#roleid").val();
        
        // Validate input
        if (add_item === "") {
            $("#add_itemmsg").html("Please enter role name");
            $("#add_item").focus();
            return false;
        } else {
            $("#add_itemmsg").html("");
        }
        
        // AJAX call to save/update role
        $.ajax({
            type: "POST",
            data: "add_item=" + encodeURIComponent(add_item) + "&roleid=" + roleid,
            url: "add_roleNow.php",
            success: function(response) {
                if (response == 1) {
                    // Success - show message and redirect
                    showSuccessAlert("Role saved successfully", "Success", "manage_role.php");
                } else if (response == 0) {
                    // Error
                    showErrorAlert("Some technical problem occurred");
                } else if (response == 2) {
                    // Duplicate entry
                    $("#add_itemmsg").html("This role already exists");
                    $("#add_item").focus();
                }
            },
            error: function() {
                showErrorAlert("An error occurred while processing your request");
            }
        });
    });
    
    // Press Enter to submit form
    $("#add_item").keypress(function(e) {
        if (e.which == 13) { // Enter key
            $("#add_role").click();
            return false;
        }
    });
});

// Function to reset the role form
function rolereset() {
    $("#add_item").val("");
    $("#roleid").val("");
    $("#add_itemmsg").html("");
    setTimeout(function() {
        $("#add_item").focus();
    }, 500); // Focus on the input field after modal is fully shown
}

// Function to load role data for editing
function riledata(id, type) {
    $.ajax({
        type: "POST",
        data: "id=" + id + "&type=" + type,
        url: "add_roleNow.php",
        success: function(response) {
            try {
                var data = JSON.parse(response);
                $("#add_item").val(data.role);
                $("#roleid").val(data.id);
                $("#role").modal("show");
            } catch(e) {
                showErrorAlert("Error parsing role data");
                console.error("Error parsing JSON:", response);
            }
        },
        error: function() {
            showErrorAlert("An error occurred while fetching role data");
        }
    });
}

// Helper function to show success alerts
function showSuccessAlert(message, title, redirectUrl) {
    Swal.fire({
        title: title || "Success",
        text: message,
        icon: "success",
        confirmButtonColor: "#3085d6"
    }).then((result) => {
        if (redirectUrl) {
            window.location.href = redirectUrl;
        }
    });
}

// Helper function to show error alerts
function showErrorAlert(message) {
    Swal.fire({
        title: "Error",
        text: message,
        icon: "error",
        confirmButtonColor: "#3085d6"
    });
}
