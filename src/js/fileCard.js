const createFileCard = params =>{

    return `<div class="drive-item module text-center">
                <div class="drive-item-inner module-inner">
                    <div class="drive-item-title"><a href="#">${params.filename}</a></div>
                    <div class="drive-item-thumb">
                        <a href="#"><i class="fa fa-folder text-primary" data-element="folder" data-name="${params.filename}"></i></a>
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

function renderFiles(fileArray, fileContainer){
    fileContainer.innerHTML = ''
    for (const file of fileArray){
        const fileCard = createFileCard(file)
        fileContainer.innerHTML += fileCard
    }
}

export default renderFiles