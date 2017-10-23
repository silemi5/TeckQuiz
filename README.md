# TeckQuiz
An Online Quiz Management System built on Laravel.  
[Repository](https://github.com/silemi5/TeckQuiz)  
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
    Or if you want to use seeded data in addition of creating tables for testing:
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
- Go to the [web app](http://teckquiz.app) and logon to the Administrator account using `Administrator` as username and `password` as password!

## Starting from scratch
Assuming you have not seeded the database.
1. Before anything, make sure you have created a subject AND a teacher in the administrator account. (This can be found on the *Settings* panel)

2. Login to the teacher's account.

3. Create a new class on the *My Classes* panel.

4. You have successfully created a class! You may now create a new quiz event on the `Quiz Events` panel. Do note that you have to enable the quiz after creation.

5. In order for a student to join your newly created class, give them the `Class Code`, a five alphanumeric characters,  which you can see on the `My Classes` panel.

6. The student can now register if they didn't have an account yet or join the class via `Join class` on the `Settings` panel.

## Testing the web app with seeded database
1. Login to the teacher's account using `Teacher` as username and `password` as password.

2. Go to the `Quiz Events` panel then click on a quiz entry. This will direct you to the `Manage Quiz` page.

3. Enable the quiz by clicking `Enable Quiz`.

4. Logout then login as a student using `Student` as username and `password` as password.

5. Click `Start` on the quiz you have earlier enabled.


## License
This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/silemi5/TeckQuiz/blob/stable/LICENSE) file for details.