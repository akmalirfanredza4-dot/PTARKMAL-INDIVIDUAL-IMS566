# PTARKMAL Library Management System

PTARKMAL is a responsive Library Management System developed with PHP, MySQL, Bootstrap 5, and Chart.js. It includes role-based access for Admin and User/Student, book inventory management, borrowing records, dashboard summaries, and visual reports.

## Main Features

- Login and registration with password hashing
- Two roles: Admin and User/Student
- Responsive Bootstrap 5 navigation and layout
- Admin dashboard with summary cards
- Book CRUD management for admin
- User catalog with search and borrow function
- Borrowing history and return management
- Visual elements using Chart.js:
  - Borrowing Status Pie Chart
  - Monthly Borrowing Bar Chart
  - Books by Category Doughnut Chart
  - Top Borrowed Books Bar Chart
- Footer, metadata, structured content sections, and organised files

## Demo Login

Admin:
- Username: `admin`
- Password: `1234`

User:
- Username: `student`
- Password: `1234`

## Installation on XAMPP

1. Copy the `PTARKMAL` folder into `xampp/htdocs/`.
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin.
4. Import `database/ptarkmal.sql`.
5. Open the system in your browser:
   - `http://localhost/PTARKMAL/`

## Database Configuration

Edit `config/database.php` if your database credentials are different.

Default configuration:

```php
$host = 'localhost';
$dbname = 'ptarkmal_library';
$username = 'root';
$password = '';
```

## Suggested Online Publishing

This PHP/MySQL version cannot be published directly using GitHub Pages because GitHub Pages only supports static files. Use PHP hosting such as cPanel hosting, InfinityFree, AwardSpace, 000webhost-style PHP hosting, or your lecturer-approved hosting platform.

Submit:

- Live PHP hosting URL
- GitHub repository URL containing the source code

## User Acceptance Test (UAT)

| Test ID | Module | Test Scenario | Test Steps | Expected Result | Status |
|---|---|---|---|---|---|
| UAT01 | Authentication | Admin login | Enter admin username and password, click Login | Admin is redirected to admin dashboard | Pass |
| UAT02 | Authentication | Invalid login | Enter wrong username/password | Error message is displayed | Pass |
| UAT03 | Registration | New user registration | Fill name, email, and password | Account is created and user can login | Pass |
| UAT04 | Navigation | Responsive menu | Open system on desktop and mobile screen | Menu remains usable and consistent | Pass |
| UAT05 | Admin Dashboard | View summary and charts | Login as admin and open dashboard | Summary cards and charts appear | Pass |
| UAT06 | Book Management | Add book | Admin fills book form and submits | New book appears in inventory table | Pass |
| UAT07 | Book Management | Edit book | Admin edits a book record | Updated data appears in table | Pass |
| UAT08 | Book Management | Delete book | Admin deletes a book | Book is removed from inventory | Pass |
| UAT09 | Borrowing | User borrows book | Login as user, open catalog, click Borrow | Borrowing record is created and quantity decreases | Pass |
| UAT10 | Borrowing | Admin marks return | Admin opens borrowings and clicks Mark Returned | Status changes to returned and quantity increases | Pass |
| UAT11 | Data View Pages | View datasets | Open Books, Users, Borrowings, Catalog, My Borrowings | Data is displayed clearly in table/card format | Pass |
| UAT12 | Reports | View visual reports | Admin opens Reports page | Category and top borrowed book charts appear | Pass |

## Technologies Used

- PHP 8+
- MySQL / MariaDB
- Bootstrap 5
- Chart.js
- Font Awesome
- HTML5, CSS3, JavaScript

## Folder Structure

```text
PTARKMAL/
├── admin/
├── assets/
│   ├── css/
│   └── js/
├── config/
├── database/
├── includes/
├── user/
├── index.php
├── login.php
├── register.php
├── logout.php
└── README.md
```
