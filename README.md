# Technical Assessment
Application for listing accomodations with suburb and area filter for Sydney Australia.

## Implementation Requirements
* Build a single page application that uses data provided from the [ATDW Atlas API](https://developer.atdw.com.au/ATDWO-api.html) to list accommodation options in Sydney only. <br/>
Using the service you develop the frontend application shall enable the user to filter results by areas and suburbs as defined by the ATDW API.

✅ built a laravel endpoint to collect data from ATDW Atlas API to display products, list suburbs and areas

* Filter by Area within Sydney

✅ Application dropdown to show Areas within Sydney and filter product results

* Filter by Suburb/City within Sydney

✅ Application dropdown to show Suburbs/City within Sydney and filter product results

* The service must be written in PHP7.

✅ Project is using latest PHP7 version with Laravel Sail(Dockerized)

* The PHP code must use composer to manage any dependencies.

✅ Project is using composer combined together in Laravel Sail

* Although it is overkill [Guzzle](https://docs.guzzlephp.org/en/stable/) must be used.

✅ Using laravel http client which uses guzzle from the background and axios for vuejs to call backed endpoint

* Data fetched from ATDW must be in the JSON format.

✅ Using the out=json parameter from the endpoint,the results was encoded in utf-16le which was converted to utf-8

* Responses from the service created must be handled in JSON

✅ All laravel API endpoint response is in JSON format

* The frontend must be developed using Vue JS (you can use vue-cli or webpack).

✅ Using Vue.js 3.x and tailwind css to run frontend application

* The frontend must be developed using Vue JS (you can use vue-cli or webpack).

✅ Using Vue.js 3.x and tailwind css to run frontend application

## Bonus Requirement
* Develop docker-compose file to run application.

✅ running 2 separate docker-compose.yml for frontend and backend

* TailwindJS.

✅ using Tailwind CSS


### Pre-requisites / Assumptions
* [Node.js](https://nodejs.org/en/download/) has been installed on the machine
* [Composer](https://getcomposer.org/download/) has been installed on the machine
* To Do list [TODO](#tech-debt)
* Runs on [Localhost:8081](http://localhost:8081) for vue.js frontend
* Runs on [Localhost:8001](http://localhost:8001) for laravel backend
* Runs on Chromium browser e.g Google Chrome

### Usage
#### Backend 
* open terminal 
* go to project root folder
* go to backend folder ``` cd backend ```
* make sure port 8001 is available
* run composer install ``` composer install ```
* run laravel sail up ``` ./vendor/bin/sail up -d```


#### Frontend 
* open terminal
* go to project root folder
* go to frontend folder  ``` cd frontend ```
* run docker compose and build  ``` docker-compose up -d --build ```
* go to browser and open  ``` http://localhost:8081/ ```

#### Framework / Folder structure
```
.
├── accomodation-list-test
    ├── frontend # root folder for vuejs application
        ├──node_modules #npm packages
        ├──public # static files for frontend app
        └──src
            ├──assets # constains images and css files
            ├──components #vue components needed in the application
            ├──router #router files for vue link
            ├──store #data storage for vue
            └──views # template files for app pages
    └── backend # root folder for laravel application
        ├──app # main laravel folder containing all function to run backend where controller models is stored
        ├──config # configuration folders for laravel
        ├──database # folder for migration factories and seeders
        ├──public # folder for static files
        ├──resources # containes views css and js files
        ├──routes # containes views css and js files
        ├──storage # files for routing using web or api endpoints
        ├──tests # contains unit and feature test scripts
        └──vendor # composer packages
```
### Tech debt
* Unit test using PHP unit
* additional filters to sort by other product data or item category
* ability to search by keyword
* beautify design of application
* user login and registration
* ability to authenticate based on user token
* ability to rate different products
* ability to filter by Area within Suburb/city selected
* one docker compose to run both frontend and backend
