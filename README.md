Certainly! Here is a README file for the Book-Rental-Service project based on the provided screenshots and specifications.

---

# Book-Rental-Service

## Overview

Book-Rental-Service is a web application built using Laravel and other associated technologies. It allows users to search for books, view details, and request to borrow books. The application distinguishes between reader and librarian roles with specific functionalities available to each.

## Features

### General Features

1. **Navigation Bar**: Common layout across the application, contains links to various sections.
2. **Main Page**: Displays:
    - Number of users
    - Number of genres
    - Number of books
    - Number of active book rentals (accepted status)
    - List of genres with links to genre-specific pages
    - Book search functionality

### Reader Functions

3. **List by Genre**: Shows books in a selected genre.
4. **Search**: Allows searching for books by title or author.
5. **Book Detail Page**: Displays detailed information about a specific book.
6. **Registration**: Users can create a new account. Registered users default to reader role.
7. **Login**: Users can log in to access more features. Pre-seeded accounts:
    - Reader: `reader@brs.com` / `password`
    - Librarian: `librarian@brs.com` / `password`
8. **Borrow a Book**: Authenticated readers can request to borrow books.
9. **My Rentals**: Shows lists of all rental requests and statuses.
10. **Rental Details**: Detailed view of a rental including processing dates and status updates.

### Librarian Functions

11. **Add New Book**: Librarians can add new books to the library.
12. **Edit a Book**: Modify details of existing books.
13. **Delete a Book**: Remove a book from the library.
14. **Genre List**: View all genres in the system.
15. **Add New Genre**: Librarians can add new genres.
16. **Edit a Genre**: Modify existing genres.
17. **Delete a Genre**: Remove a genre from the system.
18. **Rental List**: View all rental requests and statuses.
19. **Rental Details (Librarian)**: Manage rental requests, update statuses, and set deadlines.

### Common Functions

20. **Profile Page**: Displays user's profile information.

### Other Features

21. **Soft Delete**: Use soft deletes for genres and books.

## Setup and Installation

### Prerequisites

-   PHP 7.3 or higher
-   Composer
-   Node.js and npm
-   MySQL or another compatible database

### Steps

1. **Clone the repository**:

    ```bash
    git clone <repository-url>
    cd book-rental-service
    ```

2. **Install PHP dependencies**:

    ```bash
    composer install
    ```

3. **Install JavaScript dependencies**:

    ```bash
    npm install
    ```

4. **Build the frontend assets**:

    ```bash
    npm run prod
    ```

5. **Setup environment variables**:

    - Copy `.env.example` to `.env` and configure the database and other settings.

6. **Run migrations and seed the database**:

    ```bash
    php artisan migrate --seed
    ```

7. **Serve the application**:
    ```bash
    php artisan serve
    ```

## Usage

-   Visit `http://localhost:8000` in your browser to access the application.
-   Use the pre-seeded credentials to log in as a reader or librarian.
-   Navigate through the application using the provided navigation bar.
