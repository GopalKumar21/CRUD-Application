# PHP CRUD Application for Student Records

## Overview
This is a PHP-based CRUD (Create, Read, Update, Delete) application designed to manage student records. It allows users to add, view, edit, and delete student information, including student name, ID, phone number, email, and campus. The application features a responsive interface with a clean, modern design and interactive table functionality.

## Features
- **Create**: Add new student records via a form.
- **Read**: Display all student records in a sortable, searchable table using DataTables.
- **Update**: Edit existing student records by pre-filling the form with selected data.
- **Delete**: Remove student records with a confirmation action.
- Responsive design with Bootstrap and custom neon-orange styling.
- Alerts for successful create, update, and delete operations.
- Navigation bar with links to Home and About pages.

## Technologies Used
- PHP (7.x or 8.x recommended)
- MySQL (for database storage)
- HTML, CSS, JavaScript
- Bootstrap 4.4.1 (for responsive layout and styling)
- DataTables 2.3.0 (for interactive table)
- jQuery 3.4.1 and Popper.js 1.16.0 (for Bootstrap and JavaScript functionality)
- Google Fonts (Roboto for typography)

## Prerequisites
Before running the application, ensure you have the following installed:
- PHP 7.4 or higher
- MySQL server
- A web server (e.g., Apache, Nginx)
- A web browser (e.g., Chrome, Firefox)

## Project Structure
```plaintext
├── index.php           # Main application file handling CRUD operations
├── style.css           # Custom CSS for styling
├── database.sql        # Database schema for the `records` table
├── About.html          # About page
└── README.md           # This file
```

## Database Schema
The application uses a MySQL database named `students` with a `records` table. The schema can be created with the following SQL (save as `database.sql`):
```sql
CREATE TABLE records (
    `Student Id` VARCHAR(50) PRIMARY KEY,
    `Student Name` VARCHAR(100) NOT NULL,
    `Phone Number` VARCHAR(15) NOT NULL,
    `Email` VARCHAR(100) NOT NULL,
    `Campus` VARCHAR(50) NOT NULL
);
```

## Security Note
The current implementation uses direct user input in SQL queries, which is vulnerable to SQL injection. For production use, consider using prepared statements with MySQLi or PDO to enhance security.


## Contributing
Contributions are welcome! To contribute:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes and commit (`git commit -m "Add feature"`).
4. Push to the branch (`git push origin feature-branch`).
5. Open a pull request.

Please ensure your code follows PHP coding standards (e.g., PSR-12) and test thoroughly.

## Contact
For questions or feedback, feel free to reach out:
- GitHub: https://github.com/GopalKumar21.

- Gmail: gopalkumar172111@gmail.com.

  
