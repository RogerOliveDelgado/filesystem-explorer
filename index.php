<?php
session_start();
require("./modules/fileInfo.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Drive files documents user profile - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./src/css/styles.css">
    <script src="./src/js/main.js" type="module"></script>
</head>
<body>
    <div class="container">
        <div class="view-account">
            <section class="module">
                <div class="module-inner">
                    <div class="side-bar">
                        <div class="user-info">
                            <img class="img-profile img-circle img-responsive center-block" src="./src/img/darth-vader.png" alt="">
                            <ul class="meta list list-unstyled">
                                <li class="name">Darth Vader
                                    <label class="label label-info">Full Stack Developer</label>
                                </li>
                                <li class="email"><a href="#">darth@vader.com</a></li>
                                <li class="activity">Last logged in: 24/05/2022 at 2:18pm</li>
                            </ul>
                        </div>
                        <nav class="side-menu">
                            <ul class="nav">
                                <li class="active"><a href="#"><span class="fa-solid fa-folder"></span> Files</a></li>
                                <li class=""><a href="#"><span class="fa-solid fa-trash"></span> Trash</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="content-panel" id="controlPanel">
                        <div class="content-header-wrapper">
                            <h2 class="title">Assembler Drive</h2>
                            <div class="actions">
                                <form action="./modules/upload.php" method="POST" enctype = "multipart/form-data">
                                    <input type="file" name="fileToUpload">
                                    <input type ="submit" name="submit" class="btn btn-success"><i class="fa fa-plus"></i>Upload File</input>
                                </form>
                            </div>
                        </div>
                        <div class="content-utilities">
                            <div class="page-nav">
                                <span class="indicator">View:</span>
                                <div class="btn-group" role="group">
                                    <button class="active btn btn-default" id="groupBoxBtn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Grid View" id="drive-grid-toggle"><i class="fa fa-th-large"></i></button>
                                    <button class="btn btn-default" id="groupListBtn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="List View" id="drive-list-toggle"><i class="fa fa-list-ul"></i></button>
                                </div>
                            </div>
                            <div class="actions">
                                <div class="btn-group">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">All Items <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="fa fa-file"></i> Documents</a></li>
                                        <li><a href="#"><i class="fa fa-file-image-o"></i> Images</a></li>
                                        <li><a href="#"><i class="fa fa-file-video-o"></i> Media Files</a></li>
                                        <li><a href="#"><i class="fa fa-folder"></i> Folders</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false"><i class="fa fa-filter"></i> Sorting <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Newest first</a></li>
                                        <li><a href="#">Oldest first</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></button>
                                    <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Archive"><i class="fa fa-archive"></i></button>
                                    <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Report spam"><i class="fa fa-exclamation-triangle"></i></button>
                                    <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
                                </div>
                                <div class="wrap">
                                    <div class="search">
                                        <input type="text" class="searchTerm" id="searchContent" name="searchContent" placeholder="What are you looking for?">
                                        <button type="submit" class="searchButton" id="searchButton"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <button id="previousDirButton">Back</button>
                            </div>
                        </div>
                        <div>
                            <ul class="folderTrack" id="folderTrack"></ul>
                        </div>
                        <div class="drive-wrapper drive-grid-view" >
                            <div id = "fileContainer" class="grid-items-wrapper file-container"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>