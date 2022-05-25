import renderFiles from './fileCard.js'
import userDirectory from './directories.js'
import {previousFolder, nextFolder} from './directories.js'

const searchContent = document.getElementById('searchContent')
const searchButton = document.getElementById('searchButton')

//Relative path
const uploadUrl = 'modules/upload.php'
const relSearchFileUrl = 'modules/searchFile.php'
const nextFileUrl = 'modules/nextFile.php'
let currDir = 'root'

const mainPath = window.location.pathname
const fileContainer = document.getElementById('fileContainer')

window.onload = async () => {
    const files = await userDirectory()
    renderFiles(files, fileContainer)
}

fileContainer.addEventListener('dblclick', (e) => {
    if(e.target.getAttribute('data-element')=== "folder"){
        const dirName = e.target.getAttribute('data-name')
        currDir = `${currDir}/${dirName}`
        nextDirectory(currDir)
    }
})

searchButton.addEventListener('click', (e) => {
    try{
        fetch(`${mainPath}/${relSearchFileUrl}`, {
            method: "POST",
            headers: new Headers({"content-type": "application/json; chartset=UTF-8"}),
            body: JSON.stringify(searchContent.value)
            }
        )
        .then(response => response.json())
        .then(data => console.log(data))
    } catch(error){
        console.error(error)
    }
})

async function nextDirectory(dirName){
    try{
        const response = await fetch(`${mainPath}/${nextFileUrl}`,{
        method: 'POST',
        headers: {"content-type": "application/json; chartset=UTF-8"},
        body: JSON.stringify(dirName)
    })
    const nextDirFiles = await response.json()
    renderFiles(nextDirFiles, fileContainer)
    } catch(error){
        console.error(error)
    }
}

