function login() {
    $.ajax({
        url: "../php/actions.php",
        type: "POST",
        data: {action: 'login'},
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
        data: {action: 'vote', votingId: votingId, candidateId: candidateId},
        success: () => {
            window.location.href = "../pages/availableVotes.php";
        },
        error: (xhr, status, error) => {
            console.error("AJAX Error: " + status + " - " + error);
        }
    });
}

function deleteVote(event, votingId) {
    event.stopPropagation()
    showModal('Видалити голосування?', () =>
        $.ajax({
            url: `../php/actions.php`,
            type: "POST",
            data: {action: 'deleteVote', votingId: votingId},
            success: () => {
                location.reload();
            },
            error: (xhr, status, error) => {
                console.error("AJAX Error: " + status + " - " + error);
            }
        })
    )

}

function showModal(text, yesFunction) {
    if (document.getElementById('modal'))
        return;
    const modal = document.createElement('div')
    modal.id = 'modal'

    const title = document.createElement('h1')
    title.innerHTML = text
    const buttons = document.createElement('div')

    const buttonYes = document.createElement('button')
    buttonYes.innerHTML = 'Так'
    buttonYes.addEventListener('click', yesFunction)
    const buttonNo = document.createElement('button')
    buttonNo.innerHTML = 'Ні'
    buttonNo.addEventListener('click', () => document.getElementsByTagName('header')[0].removeChild(modal))

    buttons.appendChild(buttonYes)
    buttons.appendChild(buttonNo)
    modal.appendChild(title)
    modal.appendChild(buttons)
    document.getElementsByTagName('header')[0].appendChild(modal)
}