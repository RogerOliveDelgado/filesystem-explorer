const mainPath = window.location.pathname //index.php path
const rootPath = `${previousFolder(mainPath)}/root`
const initPath = `${previousFolder(mainPath)}/modules/init.php`

async function userDirectory(user) {
    try {
        const response = await fetch(initPath, {
            method:'POST',
            headers: {"content-type": "application/json; chartset=UTF-8"},
            body: JSON.stringify(`${rootPath}`)
        })
        const data = await response.json()
        return data
    } catch(error){
        console.error(error)
    }
}

function previousFolder(path){
    return path.substring(0, path.lastIndexOf('/'))}

function nextFolder(path, folderName){
    return `${path}/${folderName}`
}

export default userDirectory
export {previousFolder, nextFolder }