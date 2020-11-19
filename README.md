# Setting up the basic LARAVEL admin 

# Step 1 Clone the project
Clone the project where you want to setup it using the following command

git clone https://github.com/webethics/filter-laravel-admin.git

# Step 2 Vendor fodler
open the command prompt or your server shell and execute the following comands

$composer update

# Step 3 .env file
change the sample.env file to .env file and update your databse details

# Step 4 Database Details

Once the database is create run the following commands to get the default data

# Step 5 Database Default Data
php artisan migrate  
php artisan db:seed --class=DatabaseSeeder

# Step 6 Login with credentials

Use the following details to get logged into the accounts:

# Admin

Username : admin@admin.com  
Password: Teamwebethics3!

# User

Username : user@user.com  
Password: Teamwebethics3!

