This Laravel-based pharmacy inventory management system features:

Role-Based Access Control: Separate admin and staff roles with access controls to manage sales, purchases, and inventory.
Sales and Purchase Management: Complete functionality to track and manage sales and purchase transactions.
Charts for Analysis: Visual representation of sales data and categories using charts for better analysis and decision-making.
Advanced Search and Filtering: Comprehensive search and filtering capabilities for medicines, facilitating easier inventory management.
Categories Management: Organize medicines into categories for improved tracking and reporting.
Additional Features: Includes image upload functionality,using middlewares and much more


the process to run it

1. Clone the Repository
First, clone the repository to your local machine:


Copy code
git clone https://github.com/Nuruhussein/pharmacy-inventory.git
cd pharmacy-inventory
2. Install Dependencies
Install the required PHP and JavaScript dependencies using Composer and npm:



composer install
npm install
3. Set Up Environment Variables
Create a .env file in the root directory by copying the example environment file:



cp .env.example .env
Update the .env file with your database and other environment configurations:

env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pharmacy
DB_USERNAME=root
DB_PASSWORD=
4. Generate Application Key
Generate the application key for Laravel:

bash
Copy code
php artisan key:generate
5. Run Migrations
Run the database migrations to set up the required tables:


php artisan migrate
6. Seed the Database (Optional)
If there are any seeders included to populate the database with sample data, run:



php artisan db:seed
7. Compile Assets
Compile the front-end assets using Laravel Mix:


npm run dev

8. Serve the Application
Start the Laravel development server:

php artisan serve

The application will be accessible at http://localhost:8000.
