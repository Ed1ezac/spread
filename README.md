## Spread Bulk SMS Service
 The Spread bulk SMS system is a system that dispatches multiple text messages to mobile numbers in a single automated task. It features a spreadsheet reader to take bulk mobile numbers input, a comprehensive form for users to compose the SMS, and a rollout status page where user can see the rollout in real-time and stop it if they want to. It intergrates seamlesly with the Local network A.P.I to achieve its function.

## Project Status
<p align="center">
<img src="https://img.shields.io/badge/development-Maintenance & Updates-blue" alt="development status"/>
</p>

## Technology Used
This system was made using the Laravel framework, a php framework for web system development and these technologies.


|Technology       |Description   |
|:---------------:|:------------:|
| <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="120"></a> | Laravel Framework v8.x |
| <a href="https://www.php.net" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="40" height="40"/> </a> | PhP v7.3.0 |
| <a href="https://nodejs.org" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/nodejs/nodejs-original-wordmark.svg" alt="nodejs" width="80"/> </a>| Nodejs v14.16|
| <a href="https://tailwindcss.com/" target="_blank" rel="noreferrer"> <img src="https://www.vectorlogo.zone/logos/tailwindcss/tailwindcss-icon.svg" alt="tailwind" width="40" height="40"/> </a> | Tailwind CSS v2.0.3 |
| <a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40"/> </a> | MySQL Database |
| <a href="https://vuejs.org/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/vuejs/vuejs-original-wordmark.svg" alt="vuejs" width="40" height="40"/> </a> | Vuejs v3.0.11 |

## Requirements
If you intend to make additions to this project you need to meet the following (Minimum requirements):
- Php V7.3.0 
- Composer V2.0.11
- Node V14.16.0

## Architecture & Directories
This project's architecture follows the Laravel framework architecture and directory structure that can be [found here](https://laravel.com/docs/8.x/structure)

## Local Configuration
- Download and unzip the project
- If you have Visual Studio Code IDE you can use its built-in command processor by clicking `Terminal`->`New Terminal` on the top ribbon menu
- Otherwise fire up your console app *(e.g command prompt on windows)* and navigate to the project folder 
- Install the necessary packages by running `npm i` command
- Compile the javascript & css by running `npm run dev`
- Serve the application by using the artisan command `php artisan serve`
- Navigate to http://localhost:8000 to view it
- In order to create accounts and log in you will need a database. I uses xampp for that and configured it in the .env file in the project dir

## Testing
In order to test the app you can use Laravel built in testing:
- Create your test file from the commandline e.g. `php artisan make:test MyTest` 
- To run the tests you can use the `php artisan test` command
- An `ExampleTest.php` file exists in the `\tests\` directory of the app to help you get started

Visit the [Laravel documentation on testing](https://laravel.com/docs/8.x/testing) to learn more

## Possible Improvements
- User needs to be able to pause & resume a rollout once begun, they can only stop it at the moment 
- The app is intended to add support for Bulk email rollouts as well
- The app needs to define an API for other apps to be able to use its logic 
- Aditional Admin Metrics like data visualization, customer journey mapping

## Support & Contribution
Contributions are welcome. Please contact me to give me a heads-up and to agree on code standard and conventions. I  value readable and consice code practices.

## Evolution
This system is past the prototyping & development stage and has been deployed to a production environment on digital ocean. It requires only updates and maintenance on its various components. Otherwise other components to add include:

- Blog 


## License
This project is under the [GNU General Public License v3.0](https://choosealicense.com/licenses/gpl-3.0/)
