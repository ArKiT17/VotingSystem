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
    labelDesc.innerHTML = 'Короткий опис (максимум 30 символів)'
    newCandidate.appendChild(labelDesc)
    let inputDesc = document.createElement('input')
    inputDesc.type = 'text'
    inputDesc.id = `desc${countCandidates}`
    inputDesc.name = `desc${countCandidates}`
    inputDesc.required = true
    inputDesc.maxLength = 30
    newCandidate.appendChild(inputDesc)

    let labelPhoto = document.createElement('label')
    labelPhoto.htmlFor = `photo${countCandidates}`
    labelPhoto.innerHTML = 'Фото'
    newCandidate.appendChild(labelPhoto)
    let inputPhoto = document.createElement('input')
    inputPhoto.type = 'file'
    inputPhoto.id = `photo${countCandidates}`
    inputPhoto.name = `photo${countCandidates}`
    inputPhoto.required = true
    newCandidate.appendChild(inputPhoto)

    let button = document.createElement('button')
    button.type = 'button'
    button.onclick = function () { candidates.removeChild(newCandidate) }
    button.innerHTML = 'X'
    newCandidate.appendChild(button)

    candidates.appendChild(newCandidate)
}