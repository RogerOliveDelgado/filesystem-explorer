import {renderFiles, showPath} from './fileCard.js'

const searchContent = document.getElementById('searchContent')
// const searchButton = document.getElementById('searchButton')
const previousDirButton = document.getElementById('previousDirButton')
const groupBoxBtn = document.getElementById('groupBoxBtn')
const groupListBtn =  document.getElementById('groupListBtn')
const fileContainer = document.getElementById('fileContainer')

//Relative path
const mainPath = previousFolder(window.location.pathname)
const searchFileUrl = `${mainPath}/modules/searchFile.php`
const getFilesUrl = `${mainPath}/modules/getFiles.php`
const uploadUrl = `${mainPath}/modules/upload.php`
const userUrl = 'root'
let currDir = 'root'

const searchOperations = ['input']

onload = async () => {
    const files = await getDirectoryFiles(currDir)
    renderFiles(files, fileContainer, displayMode())
    showPath(currDir)
}

function displayMode(){
    return groupBoxBtn.classList.contains('active')
}

function previousFolder(path){
    return path.substring(0, path.lastIndexOf('/'))}

function nextFolder(path, folderName){
    return `${path}/${folderName}`
}

groupBoxBtn.addEventListener('click', async () => {
    if (!groupBoxBtn.classList.contains('active')){
        groupBoxBtn.classList.toggle('active')
        groupListBtn.classList.toggle('active')
        const nextDirFiles = await getDirectoryFiles(currDir)
        renderFiles(nextDirFiles, fileContainer, displayMode())
        showPath(currDir)
    }
})
groupListBtn.addEventListener('click', async () => {
    if (!groupListBtn.classList.contains('active')){
        groupListBtn.classList.toggle('active')
        groupBoxBtn.classList.toggle('active')
        const nextDirFiles = await getDirectoryFiles(currDir)
        renderFiles(nextDirFiles, fileContainer, displayMode())
        showPath(currDir)
    }
})

fileContainer.addEventListener('dblclick', async (e) => {
    if(e.target.getAttribute('data-element') === "folder"){
        scrollTo(0,0)
        const dirName = e.target.getAttribute('data-name')
        currDir = nextFolder(currDir, dirName)
        const nextDirFiles = await getDirectoryFiles(currDir) //need to use await here?? 
        renderFiles(nextDirFiles, fileContainer, displayMode())
        showPath(currDir)
    }
})

previousDirButton.addEventListener('click', async (e) => {
    if(currDir !== userUrl){
        scrollTo(0,0)
        currDir = previousFolder(currDir)
        const previousDirFiles = await getDirectoryFiles(currDir)
        renderFiles(previousDirFiles, fileContainer, displayMode())
        showPath(currDir)
    }
})

searchContent.addEventListener('input' , async() => {
        if(searchContent.value!==''){
            const matchedFiles = await getMatchedFiles(searchContent.value)
            renderFiles(matchedFiles, fileContainer, displayMode())
        } else {
            const dirFiles = await getDirectoryFiles(currDir)
            renderFiles(dirFiles, fileContainer, displayMode())
        }
    })

searchContent.addEventListener('change', () => {
    searchContent.value = ''
})

async function getMatchedFiles(inputStr) {
    try{
        const response = await fetch(searchFileUrl, {
            method: "POST",
            headers: new Headers({"content-type": "application/json; chartset=UTF-8"}),
            body: JSON.stringify({path: currDir, strToMatch: inputStr})
            }
        )
        const data = response.json()
        return data
    } catch(error){
        console.error(error)
    }
}

async function getDirectoryFiles(dirName){
    try{
        const response = await fetch(getFilesUrl,{
        method: 'POST',
        headers: {"content-type": "application/json; chartset=UTF-8"},
        body: JSON.stringify(dirName)
    })
    const data = await response.json()
    return data
    } catch(error){
        console.error(error)
    }
}