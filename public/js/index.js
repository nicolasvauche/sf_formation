import { microphoneFactory } from './factories/microphoneFactory.js'
window.addEventListener('DOMContentLoaded', async () => {

  const containerElt = document.getElementById('microphones')

  const ajaxUrl = 'http://localhost:6060/microphone/get'

  fetch(ajaxUrl)
    .then(response => response.json())
    .then(jsonData => {
      const microphoneModel = microphoneFactory(jsonData, containerElt)
      microphoneModel.createDOMElts()

    }).catch(error => {
    console.log(error)
  })
})
