# TeckQuiz
An Online Quiz Management System built on Laravel.  
[Demo](http://damp-tundra-88811.herokuapp.com)

## Features
- Manage quiz with ease. No more checking of papers. No more writing too. Just click, click, type, type, enter. You only worry if the electricity is stable. (*heh heh*)

- Randomized order of question makes cheating (*teamwork*, they say) a bit hassle.
- Get results after conclusion of quiz. Save time from checking manually the answers. (But you could do that, if you want.)
- Works on anything by utilizing the power of the Web!
    - Mobile site is still buggy. (But why would you allow them to use their phone in a quiz?)

## Limitations
- You can not yet reuse an questionnaire used in an another class.
- Hardheaded users may create many accounts that makes the teacher work a hassle.
- Either find a hosting server or host it locally.
- To be correct in identification, the answer must be **the same** as the answer stored in questions.

## Prerequisites
### Clustered way
- Any AMP server (WAMP, XAMPP) with PHP version updated to **7.1** at least.
- [Composer](https://getcomposer.org/)

### Laravel Homestead way
- [Laravel Homestead](https://laravel.com/docs/5.4/homestead)

## Installation
Assuming that you have already updated PHP7.1 and installed Composer already.
1. Go to the folder where you will serve the web app, preferrably `htdocs` or `www` folder 
of your development enviroment.

2. Clone the repository.
    ```bash
    git clone https://github.com/silemi5/TeckQuiz.git
    ```

3. Change directory to the TeckQuiz folder
    ```bash
    cd TechQuiz
    ```

4. Copy **.env.example** file to **.env** and edit the database credentials there.

5. Install the dependencies of the app:
    ```bash
    composer install
    ````

6. Migrate the database:
    ```bash
    php artisan migrate
    ```
    Or if you want to use seeded data for testing:
    ```bash
    php artisan migrate --seed
    ```
7. Generate the application key
    ```bash
    php artisan key:generate
    ``` 
#### If you are not using Laravel Homestead:
- Serve the project to start the app on http://localhost:8000
    ```bash
    php artisan serve
    ```

#### If you are using Laravel Homestead
- Add the web app to your `sites` on the **Homestead.yaml** file!  
  Assuming you put the project on the Code folder inside the Homestead:
    ```
    sites:
        - map: teckquiz.app
        to: /home/vagrant/Code/TeckQuiz/public
    ```
    
- Add **teckquiz.app** to your **hosts** file. Make sure the IP in the **Homestead.yaml** matches here!  
  Assuming that the IP in the **Homestead.yaml** is `192.168.10.10`:
    ```
    192.168.10.10  teckquiz.app
    ```
- Go to the [web app](http://teckquiz.app) and logon to the Administrator account using `Administrator` as username and `password` as password.

## Upcoming features
- Many class sections with the same subject? Reuse those questionnaires for others.
- Improve UI because it looks plain.
- Image support!
- Graphs of progress!
- Disable joining of classes option. No more smurf accounts.