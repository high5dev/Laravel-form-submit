## Product Submission Form with Laravel, AJAX, and Bootstrap

This project is a simple Product Submission Form built using Laravel, Bootstrap, jQuery, and AJAX. Users can submit products with fields like Product Name, Quantity in Stock, and Price per Item. The data is dynamically displayed on the page using AJAX and animations, with a total value calculation and editing functionality.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Features
- Form Submission: Users can add products to a list via a simple form.
- AJAX: All form submissions and product updates are handled without page reloads.
- Dynamic Data Display: Products are displayed below the form in a table, sorted by submission time.
- Animations: Subtle fade-in and slide-in animations for a better user experience.
- Bootstrap UI: A clean and responsive interface built with Bootstrap.
## Technologies Used
- Laravel: Backend framework for handling the form submission and data retrieval.
- Bootstrap 5: For responsive UI and styling.
- jQuery: For AJAX requests and DOM manipulation.
- SQLite: Simple database to store product submissions.
- AJAX: For seamless form submission and real-time updates without page reloads.
- CSS Animations: To enhance the user experience with smooth animations.

## Project Structure
The project follows the standard Laravel MVC structure:
- Controllers: Handles the logic for form submission and retrieving product data (ProductController).
- Views: The form and product list are rendered using Blade templates (resources/views/products/index.blade.php).
- Routes: Defined in routes/web.php.
- Database: MySQL is used for storage. Migrations are provided for creating the necessary tables.

## License
This project is licensed under the MIT License. See the [LICENSE](https://opensource.org/licenses/MIT) file for details.

## Author
Developed by Cory Mack.