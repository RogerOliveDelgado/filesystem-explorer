import renderFiles from './fileCard.js'
import userDirectory from './directories.js'
import {previousFolder, nextFolder} from './directories.js'

const searchContent = document.getElementById('searchContent')
const searchButton = document.getElementById('searchButton')
const previousDirButton = document.getElementById('previousDirButton')
const groupBoxBtn = document.getElementById('groupBoxBtn')
const groupListBtn =  document.getElementById('groupListBtn')

//Relative path
const uploadUrl = 'modules/upload.php'
const relSearchFileUrl = 'modules/searchFile.php'
const nextFileUrl = 'modules/nextFile.php'
let currDir = 'root'

const mainPath = previousFolder(window.location.pathname)
const fileContainer = document.getElementById('fileContainer')

onload = async () => {
    const files = await userDirectory()
    renderFiles(files, fileContainer, true)
}

function displayMode(){
    return groupBoxBtn.classList.contains('active')
}

groupBoxBtn.addEventListener('click', async () => {
    if (!groupBoxBtn.classList.contains('active')){
        groupBoxBtn.classList.toggle('active')
        groupListBtn.classList.toggle('active')
        const nextDirFiles = await nextDirectory(currDir)
        renderFiles(nextDirFiles, fileContainer, displayMode())
    }
})
groupListBtn.addEventListener('click', async () => {
    if (!groupListBtn.classList.contains('active')){
        groupListBtn.classList.toggle('active')
        groupBoxBtn.classList.toggle('active')
        const nextDirFiles = await nextDirectory(currDir)
        renderFiles(nextDirFiles, fileContainer, displayMode())
    }
})

fileContainer.addEventListener('dblclick', async (e) => {
    if(e.target.getAttribute('data-element') === "folder"){
        scrollTo(0,0)
        const dirName = e.target.getAttribute('data-name')
        currDir = nextFolder(currDir, dirName)
        const nextDirFiles = await nextDirectory(currDir) //need to use await here?? 
        renderFiles(nextDirFiles, fileContainer, displayMode())
    }
})

previousDirButton.addEventListener('click', async (e) => {
    if(currDir !== 'root'){
        scrollTo(0,0)
        currDir = previousFolder(currDir)
        const previousDirFiles = await nextDirectory(currDir)
        renderFiles(previousDirFiles, fileContainer, displayMode())
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
    return nextDirFiles
    } catch(error){
        console.error(error)
    }
}

