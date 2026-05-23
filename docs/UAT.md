# User Acceptance Test (UAT) - PTARKMAL Library Management System

| Test ID | Module | Test Scenario | Test Steps | Expected Result | Status |
|---|---|---|---|---|---|
| UAT01 | Authentication | Admin login | Enter admin username and password, click Login | Admin is redirected to admin dashboard | Pass |
| UAT02 | Authentication | Invalid login | Enter wrong username/password | Error message is displayed | Pass |
| UAT03 | Registration | New user registration | Fill name, email, and password | Account is created and user can login | Pass |
| UAT04 | Navigation | Responsive menu | Open system on desktop and mobile screen | Menu remains usable and consistent | Pass |
| UAT05 | Dashboard | Admin dashboard visual summary | Login as admin and open dashboard | Summary cards, pie chart, and bar chart appear | Pass |
| UAT06 | Data View | Admin book inventory | Open Books page | Books appear in a structured table | Pass |
| UAT07 | Data View | User catalog | Login as user and open catalog | Books appear in responsive cards | Pass |
| UAT08 | Borrowing | Borrow available book | User clicks Borrow for available book | Record is created and quantity decreases | Pass |
| UAT09 | Borrowing | Return borrowed book | Admin clicks Mark Returned | Status changes to returned and quantity increases | Pass |
| UAT10 | Reports | View meaningful charts | Admin opens Reports | Category and top borrowed charts appear | Pass |
| UAT11 | Responsiveness | Mobile display | Resize browser or test phone view | Layout adapts without broken navigation | Pass |
| UAT12 | Content Management | Footer and metadata | Inspect page structure | Footer, titles, metadata, and organised sections exist | Pass |
