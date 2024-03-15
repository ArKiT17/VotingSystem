const candidates = document.getElementById('candidates')

let countCandidates = 0
addCandidate()
addCandidate()

function addCandidate() {
    countCandidates++
    let newCandidate = document.createElement('div')
    newCandidate.id = `candidate${countCandidates}`

    let labelName = document.createElement('label')
    labelName.htmlFor = `name${countCandidates}`
    labelName.innerHTML = 'ПІБ'
    newCandidate.appendChild(labelName)
    let inputName = document.createElement('input')
    inputName.type = 'text'
    inputName.id = `name${countCandidates}`
    inputName.name = `name${countCandidates}`
    inputName.required = true
    newCandidate.appendChild(inputName)

    let labelDesc = document.createElement('label')
    labelDesc.htmlFor = `desc${countCandidates}`
    labelDesc.innerHTML = 'Опис'
    newCandidate.appendChild(labelDesc)
    let inputDesc = document.createElement('input')
    inputDesc.type = 'text'
    inputDesc.placeholder = '*Максимум 30 символів'
    inputDesc.id = `desc${countCandidates}`
    inputDesc.name = `desc${countCandidates}`
    inputDesc.maxLength = 30
    newCandidate.appendChild(inputDesc)

    let labelPhoto = document.createElement('label')
    labelPhoto.htmlFor = `photo${countCandidates}`
    labelPhoto.innerHTML = 'Фото'
    newCandidate.appendChild(labelPhoto)
    let inputPhoto = document.createElement('input')
    inputPhoto.type = 'file'
    inputPhoto.accept = '.jpeg, .jpg, .png'
    inputPhoto.id = `photo${countCandidates}`
    inputPhoto.name = `photo${countCandidates}`
    inputPhoto.required = true
    newCandidate.appendChild(inputPhoto)

    let button = document.createElement('img')
    button.className = 'btn add-vote'
    button.src = '../src/close.svg'
    button.alt = 'Видалити'
    button.onclick = function () {
        candidates.removeChild(newCandidate)
        checkCount()
    }
    newCandidate.appendChild(button)

    candidates.appendChild(newCandidate)
    checkCount()
}

function checkCount() {
    for (const button of document.getElementsByTagName('button')) {
        if (button.type === 'submit') {
            button.disabled = document.getElementById('candidates').children.length < 2;
            return
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const date = new Date;
    document.getElementById('t').value = date.getTimezoneOffset() / 60
});