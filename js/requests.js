function login() {
    $.ajax({
        url: "../php/actions.php",
        type: "POST",
        data: { action: 'login' },
        success: () => {
            window.location.href = "../pages/login.php";
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

function openVote(voteId) {
    window.location.href = `../pages/vote.php?id=${voteId}&v=0`;
}

function openVoted(voteId) {
    window.location.href = `../pages/vote.php?id=${voteId}&v=1`;
}

function selectThis(votingId, candidateId) {
    $.ajax({
        url: `../php/actions.php`,
        type: "POST",
        data: { action: 'vote', votingId: votingId, candidateId: candidateId },
        success: () => {
            window.location.href = "../pages/availableVotes.php";
        },
        error: (xhr, status, error) => {
            console.error("AJAX Error: " + status + " - " + error);
        }
    });
}