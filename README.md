steps to run the app
======================
1- clone the repo 
2- run composer update 
3- create a database and update .env database cnfigurations
4- run php artisan migrate --seed (admin user will be created with email: admin@gmail.com and password: password, 2 customers will be created in customer table, users will be created in customer users table also users sessions will be created in user sessions table)
5- run php artisan serve
6- import postman collection to postman

Database Structure
===================
1- users table: Admin user who will create invoice to customers
2- customers table: contains customers (columns: name)
3- customer_users table: each customer has multiple users (columns: name, email, customer_id, registration_date)
4- user_sessions table: each user has multiple sessions (Activation or appointment) (columns: user_id, activation_date, appointment_date, invoiced)
5- invoices table: contains create invoices (columns: customer_id, starting_date, ending_date)
6- invoice_users table: each invoice has multiple user (columns: invoice_id, user_id)
7- invoice_user_sessions: invoice sessions (columns: user_session_id, invoice_user_id, price, session_type, invoice_id)

APIs endpoints
==============
1- route: api/login method:post parameters:email, password /usage: admin login and new token will be created to him
2- route: api/logout method:post Authorization bearer token: use the token that was created by login endpoint /usage: user will be logout
3- route: api/invoices method: post parameters: START, END, CUSTOMER_ID, Authorization bearer token: use the token that was created by login endpoint /usage: Create a new invoice for a customer and persist the invoice data.
4- route: api/invoices/{invoice_id} method: get parameters: Authorization bearer token: use the token that was created by login endpoint /usage: Show the details for one invoice.

