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

function addVote(page) {
    if (page === 1)
        window.location.href = "../pages/addVote.php"
    else
        window.location.href = "../pages/availableVotes.php"
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

function toArchive() {
    window.location.href = `../pages/archive.php`;
}

function openArchiveVote(voteId) {
    window.location.href = `../pages/archiveVote.php?id=${voteId}`;
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

    const modalBox = document.createElement('div')
    modalBox.id = 'modalBox'

    const title = document.createElement('h1')
    title.innerHTML = text
    const buttons = document.createElement('div')
    buttons.id = 'buttons'

    const buttonYes = document.createElement('button')
    buttonYes.innerHTML = 'Так'
    buttonYes.id = 'button-yes'
    buttonYes.addEventListener('click', yesFunction)
    const buttonNo = document.createElement('button')
    buttonNo.innerHTML = 'Ні'
    buttonNo.id = 'button-no'
    buttonNo.addEventListener('click', () => document.getElementsByTagName('body')[0].removeChild(modal))

    buttons.appendChild(buttonYes)
    buttons.appendChild(buttonNo)
    modalBox.appendChild(title)
    modalBox.appendChild(buttons)
    modal.appendChild(modalBox)
    document.getElementsByTagName('body')[0].insertBefore(modal, document.getElementsByTagName('main')[0])

    document.addEventListener( 'click', (e) => {
        if (e.target.id === 'modal')
            document.getElementsByTagName('body')[0].removeChild(modal)
    })
}