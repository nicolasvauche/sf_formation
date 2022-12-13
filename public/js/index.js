window.addEventListener('DOMContentLoaded', () => {
  const containerElt = document.getElementById('microphones')

  fetch('http://localhost:6060/microphone/ajax')
    .then(response => response.json())
    .then(data => {
      data.forEach(microphone => {
        const separatorElt = document.createElement('hr')
        containerElt.appendChild(separatorElt)

        const imgContainerElt = document.createElement('p')
        const imgElt = document.createElement('img')
        imgElt.src = '/img/' + microphone.image
        imgElt.alt = microphone.name
        imgElt.width = 75
        imgContainerElt.appendChild(imgElt)
        containerElt.appendChild(imgContainerElt)

        const nameContainerElt = document.createElement('dt')
        const nameElt = document.createElement('strong')
        nameElt.innerText = microphone.name
        nameContainerElt.appendChild(nameElt)
        containerElt.appendChild(nameContainerElt)

        const noteContainerElt = document.createElement('dd')
        const noteElt = document.createElement('em')
        noteElt.innerText = 'Note : ' + microphone.note + '/5'
        noteContainerElt.appendChild(noteElt)
        containerElt.appendChild(noteContainerElt)
      })
    })
})
