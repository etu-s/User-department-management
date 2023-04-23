1. Run in terminal
    $ git clone https://github.com/etu-s/User-department-management.git
2. Copy .env.example to .env file and set database information
3. Run 
    $ composer install
    $ npm install
    $ npm install vue-loader@next vue@next vue-router@next --force
    $ npm install @vitejs/plugin-vue --force --save-dev
    $ npm install sweetalert2
    $ cp .env.example .env
    $ php artisan key:generate
    $ php artisan migrate
    $ npm run dev
    $ php artisan serve

Test case and test result for a User and Department CRUD in Laravel:

Test Case:

1. Test creating a department with valid data
2. Test creating a department with invalid data
3. Test updating a department with valid data
4. Test updating a department with invalid data
5. Test deleting a department
6. Test creating a user with valid data
7. Test creating a user with invalid data or duplicate email
8. Test updating a user with valid data
9. Test updating a user with invalid data
10. Test deleting a user


Test Result:

1. Test creating a department with valid data - PASSED
2. Test creating a department with invalid data - PASSED
3. Test updating a department with valid data - PASSED
4. Test updating a department with invalid data - PASSED
5. Test deleting a department - PASSED
6. Test creating a user with valid data - PASSED
7. Test creating a user with invalid data or duplicate email- FAILED
8. Test updating a user with valid data - PASSED
9. Test updating a user with invalid data - PASSED
10. Test deleting a user - PASSED

9 out of 10 tests passed 1 test failed