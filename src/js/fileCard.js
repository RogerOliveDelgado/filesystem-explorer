const iconClass = {
    doc: "fa fa-file text-info",
    csv: "fa fa-file-excel-o text-success",
    jpg: "fa fa-file-image text-warning",
    png: "fa fa-file-image text-warning",
    txt: "fa fa-file-text-o text-primary",
    ppt: "fa fa-file-powerpoint text-warning",
    odt: "fa fa-file-lines text-success",
    pdf: "fa fa-file-pdf text-warning",
    zip: "fa fa-file-zipper text-info",
    rar: "fa fa-file-zipper text-info",
    exe: "fa fa-file-code text-success",
    svg: "fa fa-chart-area text-info",
    mp3: "fa fa-headphones-simple text-warning",
    mp4: "fa fa-file-video text-warning",
    folder: "fa fa-folder",
    default: "fa fa-file"
}

const createFileCard = params => {

    return `<div class="drive-item module text-center file-card-width">
                <div class="drive-item-inner module-inner">
                    <div class="drive-item-title"><a>${params.filename}</a></div>
                    <div class="drive-item-thumb">
                        <a><i class="${iconClass[params.extension]}" data-element="${params.extension}" data-name="${params.filename}"></i></a>
                    </div>
                </div>
                <div class="drive-item-footer module-footer">
                    <ul class="utilities list-inline">
                        <li><i class="fa fa-edit"></i></li>
                        <li><i class="fa fa-trash"></i></li>
                    </ul>
                </div>
            </div>`
}

const createFileGroup = fileArray => {
        let fileGroup = ''
            for (const file of fileArray){
                fileGroup += createFileCard(file)
            }
        return fileGroup
}

const PokemonMssg = `<div class = "empty-folder__container">
                <img class="empty-folder__img" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/384.gif" alt="Pokemon Message">
                <div class="alert alert-danger" role="alert">The folder is empty! Please create a file or get out!</div>
            </div>`

const listHeader = `<thead>
    <tr>
    <th class="type"></th>
    <th class="name truncate">Name</th>
    <th class="extension">Extension</th>
    <th class="size">Size</th>
    <th class="date">Created</th>
    <th class="last_modified">Last modified</th>
    </tr>
    </thead>`

const createListElement = params => {

    return `<tr>
    <td class="type"><i class="${iconClass[params.extension]}" data-element="${params.extension}" data-name="${params.filename}"></i></td>
    <td class="name truncate"><a>${params.filename}</a></td>
    <td class="name">${params.extension}</td>
    <td class="size">${params.size}</td>
    <td class="date">${params.lastModifiedDate}</td>
    <td class="date">${params.creationDate}</td>
    </tr>`
}

const createListItems = (fileArray) => {
    let listRows = ''
        for (const file of fileArray){
            listRows += createListElement(file)
        }
    return listRows
}

const createFileList = (fileArray) =>`<table class="table">
    ${listHeader}
    <tbody>
        ${createListItems(fileArray)}
    </tbody>
    </table>`

function renderFiles(fileArray, fileContainer, isDefault){
    fileContainer.innerHTML = ''
    if (fileArray.length !== 0){
            fileContainer.innerHTML = isDefault ? createFileGroup(fileArray) : createFileList(fileArray)
    } else {
        fileContainer.innerHTML = PokemonMssg
    }
}

function showPath(path){
    const folderTrack = document.getElementById('folderTrack')
    folderTrack.textContent = ''
    const folderArray = path.split('/')
    for (const folder of folderArray){
        const element = document.createElement('li')
        element.style.listStyle = 'none'
        element.style.display = 'inline'
        element.innerHTML = ` <i class="${iconClass.folder}"></i> ${folder} >`
        folderTrack.append(element)
    }
}

export {renderFiles, showPath}