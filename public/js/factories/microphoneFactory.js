export const microphoneFactory = (microphones, containerElt) => {
  const createDOMElts = () => {
    microphones.forEach(microphone => {
      const microContainerElt = document.createElement('p')
      microContainerElt.innerText = microphone.name
      containerElt.appendChild(microContainerElt)
    })
  }

  return { createDOMElts }
}
