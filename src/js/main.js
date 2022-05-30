import {renderFiles, showPath} from './fileCard.js'

const searchContent = document.getElementById('searchContent')
// const searchButton = document.getElementById('searchButton')
const previousDirButton = document.getElementById('previousDirButton')
const groupBoxBtn = document.getElementById('groupBoxBtn')
const groupListBtn =  document.getElementById('groupListBtn')
const fileContainer = document.getElementById('fileContainer')
const createFolderBtn = document.getElementById('createFolderBtn')
const editFolderBtn = document.getElementById('editFolderBtn')

//Relative path
const mainPath = previousFolder(window.location.pathname)
const searchFileUrl = `${mainPath}/modules/searchFile.php`
const getFilesUrl = `${mainPath}/modules/getFiles.php`
const fileManageUrl = `${mainPath}/modules/file-management.php`
const folderManageUrl = `${mainPath}/modules/folder-management.php`
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

fileContainer.addEventListener('click', async (e) => {
    const operation = e.target.getAttribute('data-file-operation')
    if(operation === 'delete'){
        const filename = e.target.getAttribute('data-name')
        const filePath = `${currDir}/${filename}`
        console.log(operation);
        await folderOperation(filePath,'',  operation)
        const previousDirFiles = await getDirectoryFiles(currDir)
        renderFiles(previousDirFiles, fileContainer, displayMode())
    } else if (operation === 'edit') {
        const filename = e.target.getAttribute('data-name')
        document.getElementById('editFolderNameInput').value = filename
        editFolderBtn.setAttribute('data-name', filename)
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

createFolderBtn.addEventListener('click', async () => {
    const folderName = document.getElementById('newFolderNameInput').value
    const folderPath = `${currDir}/${folderName}`
    await folderOperation(folderPath, '' , "create")
    const nextDirFiles = await getDirectoryFiles(currDir)
    renderFiles(nextDirFiles, fileContainer, displayMode())
})

editFolderBtn.addEventListener('click', async () => {
    const editFolderInput = document.getElementById('editFolderNameInput')
    const folderName = editFolderBtn.getAttribute('data-name')
    const newFolderPath = `${currDir}/${editFolderInput.value}`
    const folderPath = `${currDir}/${folderName}`
    if(folderPath !== newFolderPath){
        await folderOperation(folderPath, newFolderPath, 'edit')
        const nextDirFiles = await getDirectoryFiles(currDir)
        renderFiles(nextDirFiles, fileContainer, displayMode())
    }
})


async function folderOperation(folderPath, folderNewPath, folderOp){
    try{
        const response = await fetch(folderManageUrl,{
        method: 'POST',
        headers: {"content-type": "application/json; chartset=UTF-8"},
        body: JSON.stringify({
            path : folderPath, 
            newPath: folderNewPath,
            operation: folderOp})
    })
        const data = await response.text()
        console.log(data);
        return data
    } catch(error){
        console.error(error)
    }
}

async function fileOperation(path, operation){
    try{
        const response = await fetch(fileManageUrl,{
        method: 'POST',
        headers: {"content-type": "application/json; chartset=UTF-8"},
        body: JSON.stringify(path)
    })
        const data = await response.text()
        return data
    } catch(error){
        console.error(error)
    }
}

async function getMatchedFiles(inputStr) {
    try{
        const response = await fetch(searchFileUrl, {
            method: "POST",
            headers: new Headers({"content-type": "application/json; chartset=UTF-8"}),
            body: JSON.stringify({path: currDir, strToMatch: inputStr})
            }
        )
        const data = await response.json()
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