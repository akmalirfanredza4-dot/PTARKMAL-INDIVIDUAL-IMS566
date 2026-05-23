# User Acceptance Test (UAT) - PTARKMAL GitHub Pages Version

| Test ID | Test Scenario | Steps | Expected Result | Status |
|---|---|---|---|---|
| UAT-01 | Admin login success | Open login page, enter admin / 1234, click Login | Admin is redirected to dashboard | Pass |
| UAT-02 | User login success | Open login page, enter student / 1234, click Login | User is redirected to dashboard | Pass |
| UAT-03 | Invalid login | Enter wrong username or password | Error message appears | Pass |
| UAT-04 | Responsive navigation | Open site on mobile width | Navigation collapses into mobile menu | Pass |
| UAT-05 | Dashboard charts | Login and open dashboard | Book Status and Monthly Borrowing charts display | Pass |
| UAT-06 | Book catalog | Open Books page | Eight custom books display with title, author, category, status, and description | Pass |
| UAT-07 | Admin-only users page | Login as admin and open Users page | User table displays | Pass |
| UAT-08 | User restricted from admin report | Login as student and try reports page | User is redirected to dashboard | Pass |
| UAT-09 | Borrowing records | Open Borrowings page after login | Borrowing table displays | Pass |
| UAT-10 | Logout | Click Logout | Session is removed and user returns to home page | Pass |
