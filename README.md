`#html` `#css` `#js` `#php` `#master-in-software-engineering`


# Project Title: PHP Local FileSystem explorer

>In this project we have created a system file explorer that allows the user to navigate, create directories and upload files in the same way as we would in his usual operating system. 


## Getting Started

First, we started using managament tools like trello to organize and schedule all the project. 

![PHP_trello_1](https://user-images.githubusercontent.com/90200166/171102839-86d306f9-523d-4600-9ff3-7f2b948507d9.png)


The HTML and CSS was done using a template, so we can focus all the work on develop all the php and javascript logic.

![PHP_mpcokup_1](https://user-images.githubusercontent.com/90200166/171108060-e891fa7d-e64f-414a-84e9-aaf9040b3d4a.png)


## Code

The most important lessons that we have learnt with this project are separate clearly the frontend and backend logic. The "comunication" between frontend and backend was using JSON. 

On javascript we used fetch promises to catch json data of the php files.

![PHP_fetch_js](https://user-images.githubusercontent.com/90200166/171106345-000a2a96-86ba-447e-9454-775a71055ed8.png)

On the other hand, on PHP we used the command file_get_contents('php://input') to take raw data from the request, and json_decode() function to convert these data into a PHP object. Using jsondecode(...., true) with the true parameter give us an array. 

![PHP_json_decode_php](https://user-images.githubusercontent.com/90200166/171107223-75ca697b-7a2c-49f2-bf4a-19cf5c65f038.png)


## Built With

* HTML
* CSS
* JS
* PHP
* Bootstrap (https://getbootstrap.com/)


## Authors

* **Roger Olive Delgado** - (https://github.com/RogerOliveDelgado)
* **Jose Cuevas** - (https://github.com/jose-cuevas)


## Acknowledgments

* To my teammate, my classmates and all the staff of Assembler Institute of Technology

