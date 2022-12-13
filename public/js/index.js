window.addEventListener('DOMContentLoaded', async () => {
  const containerElt = document.getElementById('microphones')

  const getMicrophones = async () => {
    containerElt.innerHTML = ''

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

          const removeContainerElt = document.createElement('p')
          const removeElt = document.createElement('a')
          removeElt.href = '#'
          removeElt.innerText = 'Supprimer'
          removeElt.addEventListener('click', async e => {
            e.preventDefault()
            await fetch('http://localhost:6060/microphone/ajax/remove/' + microphone.id)
              .then(response => response.json())
              .then(data => {
                console.log(data)
                getMicrophones()
              })
          })
          removeContainerElt.appendChild(removeElt)
          containerElt.appendChild(removeContainerElt)
        })
      })
  }

  await getMicrophones()
})
