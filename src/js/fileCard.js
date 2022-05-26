const iconClass = {
    doc: 'fa fa-file',
    csv: 'fa fa-file-csv',
    jpg: 'fa fa-file-image',
    png: 'fa fa-file-image',
    txt: 'fa fa-file-text-o text-primary',
    ppt: 'fa fa-file-powerpoint',
    odt: 'fa fa-file-lines',
    pdf: 'fa fa-file-pdf',
    zip: 'fa fa-file-zipper',
    rar: 'fa fa-file-zipper',
    exe: 'fa fa-file-code',
    svg: 'fa fa-chart-area',
    mp3: 'fa fa-headphones-simple',
    mp4: 'fa fa-file-video',
    folder: 'fa fa-folder',
    default: 'fa fa-file'
}

const createFileCard = params =>{

    return `<div class="drive-item module text-center">
                <div class="drive-item-inner module-inner">
                    <div class="drive-item-title"><a href="#">${params.filename}</a></div>
                    <div class="drive-item-thumb">
                        <a href="#"><i class="${iconClass[params.extension]}" data-element="${params.extension}" data-name="${params.filename}"></i></a>
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
    console.log(fileArray)
    for (const file of fileArray){
        const fileCard = createFileCard(file)
        fileContainer.innerHTML += fileCard
    }
}

export default renderFiles