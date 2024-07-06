# API Development with PHP and MySQL
# By. Xavier Alers
# July 5th, 2024

This project demonstrates the development of a RESTful API using PHP and MySQL.

The API supports user authentication and CRUD operations for posts, showcasing secure coding practices and database management.

## Table of Contents
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Setup Instructions](#setup-instructions)
- [API Endpoints](#api-endpoints)
- [Security Measures](#security-measures)
- [Project Structure](#project-structure)
- [Future Enhancements](#future-enhancements)

## Features
- User Registration, Login, and Logout
- Create, Read, Update, and Delete (CRUD) operations for posts
- Secure coding practices including prevention of SQL Injection, XSS (Cross-Site Scripting), and CSRF (Cross-Site Request Forgery) attacks.

## Technologies Used
- PHP
- MySQL
- JSON
- Postman (API Testing)
- XAMPP (Local Development)

## Setup Instructions
### Prerequisites
- XAMPP (or any othe PHP and MySQL development environment)
- Postman (for testing the API)

### Steps
1. **Clone the repository**:
    ```bash
    git clone https://github.com/CrunchyTaconess/api_project.git
    ```

2. **Move the project to the XAMPP `htdocs` directory**:
    ```bash
    mv api_project /path/to/xampp/htdocs/
    Example: "C:\xampp\htdocs\PHP_Interview_Projects\API_Project
    ```

3. **Start Apache and MySQL in XAMPP**.

4. **Create the datebase and tables**:
    - Open phpMyAdmin and create a new database named `api_project`.
    - Run the following SQL scripts to create the necessary tables
    ```sql
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL
    );

    CREATE TABLE posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        body TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    );
    ```
5. **Configure the database connection**:
    -Open `includes/db.php` and update the database connection details if necessary:
    ```php
    <?php
    $host = 'localhost';
    $db = 'api_project';
    $user = 'root';
    $pass = '';

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
    try{
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo json_encode(['error' => ''Connection failed: ' . $e->getMessage()]);
    }
    ?>
    ```

## API Endpoints
### User Authentication
- **Register User**: `POST /api/users/register.php`
    - Request Body:
    ```json
    {
        "username": "testuser",
        "password": "testpass",
        "email": "test@example.com"
    }
    ```

- **Login User**: `POST /api/users/login.php`
    - Request Body:
    ```json
    {
        "username": "testuser",
        "password": "testpass"
    }
    ```

- **Logout User**: `POST /api/users/logout.php`


### Posts CRUD Operations
- **Create Post**: `POST /api/posts/register.php`
    - Request Body:
    ```json
    {
        "title": "Test Post",
        "body": "This is a test post."
    }
    ```

- **Read Posts**: `GET /api/posts/read.php`

- **Update Post**: `PUT /api/posts/update.php`
    - Request Body:
    ```json
    {
        "id": 1,
        "title": "Test Post",
        "body": "This is a test post."
    }
    ```

- **Delete Post**: `DELETE /api/posts/delete.php`
    - Request Body:
    ```json
    {
        "id": 1
    }
    ```

## Security Measures
- **SQL Injection**: All SQL queries use prepared statements.
- **Cross-Site Scripting (XSS)**: Output is sanitized using `htmlspecialchars`.
- **Cross-Site Request Forgery (CSRF)**: CSRF tokens are implemented for forms if applicable.
- **Session Management**: Secure session handling is implemented to protect session data.

## Project Structure
api_project/
|--includes/
|  --db.php
|--api/
|  --users/
|    --register.php
|    --login.php
|    --logout.php
|  --posts/
|    --create.php
|    --read.php
|    --update.php
|    --delete.php
|__index.php

## Future Enhancements
- Implement token-based authentication (e.g., JWT)
- Add pagination to the `read.php` endpoint for bettwer performance with large datsets.
- Implement user roles and permissions for more granular access control.
- Add additional validation and error handling for all endpoints.


---

This project showcases my ability to develop a RESTful API using PHP and MySQL, with a focus on security and best practices. Feel free to reach out with any questions or feedback.
