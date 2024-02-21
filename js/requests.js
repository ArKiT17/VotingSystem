function login() {
    $.ajax({
        url: "../php/actions.php?action=login",
        type: "GET",
        success: () => {
            window.location.href = "../pages/loginPage.php";
        },
        error: (xhr, status, error) => {
            console.error("AJAX Error: " + status + " - " + error);
        }
    });
}

function toVoted() {
    window.location.href = "../pages/voted.php";
}

function toAvailable() {
    window.location.href = "../pages/availableVotes.php";
}