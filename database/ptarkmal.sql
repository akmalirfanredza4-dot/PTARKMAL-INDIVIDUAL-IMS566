CREATE DATABASE IF NOT EXISTS ptarkmal_library CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ptarkmal_library;

DROP TABLE IF EXISTS borrowings;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') NOT NULL DEFAULT 'user',
    status ENUM('active','inactive') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    author VARCHAR(120) NOT NULL,
    category VARCHAR(80) NOT NULL,
    isbn VARCHAR(40),
    quantity INT NOT NULL DEFAULT 0,
    shelf_location VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE borrowings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    borrow_date DATE NOT NULL,
    due_date DATE NOT NULL,
    return_date DATE NULL,
    status ENUM('borrowed','returned') NOT NULL DEFAULT 'borrowed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

INSERT INTO users (name, email, password, role, status) VALUES
('PTARKMAL Administrator', 'admin', '$2y$12$1H0DXdNcE6ZXZXmziayLZutx9AvaPyO6ybP.5YYu/odBFyvDbxDFG', 'admin', 'active'),
('PTARKMAL Student', 'student', '$2y$12$1H0DXdNcE6ZXZXmziayLZutx9AvaPyO6ybP.5YYu/odBFyvDbxDFG', 'user', 'active');

INSERT INTO books (title, author, category, isbn, quantity, shelf_location) VALUES
('How to Take Care of Your Car', 'Harith Danish', 'Automotive', '978-PTA-CAR', 4, 'A1'),
('How to Cook Like a Pro', 'Chef Ariq Musa', 'Cooking', '978-PTA-COOK', 5, 'B1'),
('Footballer 101', 'Amirun Imran', 'Sports', '978-PTA-FOOT', 3, 'C1'),
('Kelantan Tourism', 'Iman Akmal Raziq Bin Zakri', 'Tourism', '978-PTA-KEL', 4, 'D1'),
('Professional LARPer', 'Sir Alif Shazwann', 'Performing Arts', '978-PTA-LARP', 2, 'E1'),
('How to Be the Best', 'Tan Sri Akmal Irfan', 'Self-Development', '978-PTA-BEST', 6, 'F1'),
('Dr Cinta', 'Dr Danish Harith', 'Romance & Advice', '978-PTA-CINTA', 3, 'G1'),
('How to Survive Bullying', 'Adam Chungs Haikal', 'Self-Help', '978-PTA-BULLY', 5, 'H1');

INSERT INTO borrowings (user_id, book_id, borrow_date, due_date, return_date, status) VALUES
(2, 1, DATE_SUB(CURDATE(), INTERVAL 35 DAY), DATE_SUB(CURDATE(), INTERVAL 21 DAY), DATE_SUB(CURDATE(), INTERVAL 20 DAY), 'returned'),
(2, 3, DATE_SUB(CURDATE(), INTERVAL 20 DAY), DATE_SUB(CURDATE(), INTERVAL 6 DAY), DATE_SUB(CURDATE(), INTERVAL 5 DAY), 'returned'),
(2, 5, DATE_SUB(CURDATE(), INTERVAL 10 DAY), DATE_ADD(CURDATE(), INTERVAL 4 DAY), NULL, 'borrowed'),
(2, 7, DATE_SUB(CURDATE(), INTERVAL 2 DAY), DATE_ADD(CURDATE(), INTERVAL 12 DAY), NULL, 'borrowed');
