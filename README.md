# PTARKMAL Library Management System - GitHub Pages Version

## Project Description
PTARKMAL Library Management System is a static web application prototype created for the IMS566 Advanced Web Design Development and Content Management individual assignment. This version is compatible with GitHub Pages because it uses only HTML, CSS, JavaScript, Bootstrap 5, and Chart.js.

## Important Note
This is the GitHub Pages-compatible version. It does not use PHP or MySQL because GitHub Pages cannot run server-side code or databases. Login and data are simulated using JavaScript and localStorage.

## Demo Login
- Admin: `admin` / `1234`
- User: `student` / `1234`

## Features Included
- Responsive Bootstrap 5 interface
- Colourful UI background and card design
- Simulated authentication with error feedback
- Two user roles: Admin and User/Student
- Dashboard summary page
- Book catalog data view
- User management data view for admin
- Borrowing records data view
- Profile page for user/student
- Chart.js visualisations:
  - Book Status Doughnut Chart
  - Monthly Borrowing Bar Chart
  - Books by Category Polar Area Chart
- Footer and metadata/content organisation

## Book List
1. How to Take Care of Your Car — Harith Danish
2. How to Cook Like a Pro — Chef Ariq Musa
3. Footballer 101 — Amirun Imran
4. Kelantan Tourism — Iman Akmal Raziq Bin Zakri
5. Professional LARPer — Sir Alif Shazwann
6. How to Be the Best — Tan Sri Akmal Irfan
7. Dr Cinta — Dr Danish Harith
8. How to Survive Bullying — Adam Chungs Haikal

## How to Publish on GitHub Pages
1. Create a new GitHub repository.
2. Upload all files from this folder to the repository root.
3. Go to repository **Settings**.
4. Open **Pages**.
5. Under **Build and deployment**, choose:
   - Source: Deploy from a branch
   - Branch: main
   - Folder: /root
6. Save and wait for GitHub Pages to generate the live link.

## Folder Structure
```text
PTARKMAL_GitHub_Pages/
├── index.html
├── login.html
├── dashboard.html
├── books.html
├── users.html
├── borrowings.html
├── reports.html
├── profile.html
├── assets/
│   ├── css/style.css
│   └── js/data.js, app.js
└── docs/UAT.md
```

## Technology Used
- HTML5
- CSS3
- JavaScript
- Bootstrap 5
- Chart.js
- GitHub Pages
