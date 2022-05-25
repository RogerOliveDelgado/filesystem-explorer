const searchContent = document.getElementById('searchContent')
const searchButton = document.getElementById('searchButton')

const uploadUrl = './modules/upload.php' //Path from index.php
const relSearchFileUrl = './modules/searchFile.php'
const currDir = window.location.pathname //Returns location from index.php --> Have to search to return index.php location

searchButton.addEventListener('click', (e) => {
    try{
        fetch(`${currDir}/${relSearchFileUrl}`, {
            method: "POST",
            headers: new Headers({"content-type": "application/json; chartset=UTF-8"}),
            body: JSON.stringify(searchContent.value)
            }
        )
        .then(response => response.text())
        .then(data => console.log(data))
    } catch(error){
        console.error(error)
    }
})

