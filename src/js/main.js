import renderFiles from './fileCard.js'
import userDirectory from './directories.js'
import {previousFolder, nextFolder} from './directories.js'

const searchContent = document.getElementById('searchContent')
const searchButton = document.getElementById('searchButton')
const previousDirButton = document.getElementById('previousDirButton')

//Relative path
const uploadUrl = 'modules/upload.php'
const relSearchFileUrl = 'modules/searchFile.php'
const nextFileUrl = 'modules/nextFile.php'
let currDir = 'root'

const mainPath = window.location.pathname
console.log(mainPath)
const fileContainer = document.getElementById('fileContainer')

onload = async () => {
    const files = await userDirectory()
    renderFiles(files, fileContainer)
}

fileContainer.addEventListener('click', async (e) => {
    if(e.target.getAttribute('data-element')=== "folder"){
        const dirName = e.target.getAttribute('data-name')
        currDir = `${currDir}/${dirName}`
        console.log(currDir)
        const nextDirFiles = await nextDirectory(currDir) //need to use await here?? 
        renderFiles(nextDirFiles, fileContainer)
    }
})

previousDirButton.addEventListener('click', async (e) => {
    if(currDir !== 'root'){
        currDir = previousFolder(currDir)
        const previousDirFiles = await nextDirectory(currDir)
        renderFiles(previousDirFiles, fileContainer)
        console.log(currDir)
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
        const response = await fetch(`${mainPath}${nextFileUrl}`,{
        method: 'POST',
        headers: {"content-type": "application/json; chartset=UTF-8"},
        body: JSON.stringify(dirName)
    })
    const nextDirFiles = await response.json()
    console.log(nextDirFiles)
    return nextDirFiles
    } catch(error){
        console.error(error)
    }
}

