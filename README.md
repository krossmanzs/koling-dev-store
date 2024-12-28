# Koling Dev Store

Admin Account:
Username: admin
Password: Password123!

## Overview

![Logo Koling Dev](/public/img/logo.png)

Koling Dev Store is a simple e-commerce web application where users can browse, search, and order products. Administrators can manage products and transactions through an admin panel.

## Features

- **User Management**: Register and login functionality for members and administrators.
- **Product Management**: Admin can add, edit, and delete products.
- **Transaction Management**: Admin can view and update transaction statuses.
- **Order Functionality**: Members can order products with a specified quantity.
- **Search & Pagination**: Search functionality and paginated product and transaction listings.

## Installation

### Prerequisites

- PHP >= 7.4
- MySQL
- Web server (e.g., Apache, Nginx)

### Setup Steps

1. **Clone the Repository**:

   ```bash
   git clone <repository-url>
   cd koling-dev-store
   ```

2. **Database Setup**:

   - Create a database named `koling_dev_store`.
   - Import the SQL file `db.sql` into the database:
     ```bash
     mysql -u <username> -p koling_dev_store < db.sql
     ```

3. **Configure Environment**:

   - Copy the `.env.example` file to `.env`:
     ```bash
     cp config/.env.example config/.env
     ```
   - Update the `.env` file with your database credentials.

4. **Configure Web Server**:

   - Set the document root to the `public/` folder.
   - Ensure `.htaccess` is enabled if using Apache.

5. **Start the Application**:

   - Serve the application using a web server or PHP's built-in server:
     ```bash
     php -S localhost:8000 -t public
     ```

6. **Access the Application**:
   - Open `http://localhost:8000` in your browser.

## Usage

### User Roles

- **Member**: Can browse and order products.
- **Admin**: Can manage products and transactions.

### Admin Panel

- Accessible at `http://<base_url>/admin`.
- Requires admin login.

### Key Routes

#### Public Routes

| URL                  | Description                    |
| -------------------- | ------------------------------ |
| `/`                  | Home page with product listing |
| `/auth/login`        | Login page                     |
| `/auth/register`     | Registration page              |
| `/order/create/{id}` | Create an order for a product  |

#### Admin Routes

| URL                             | Description               |
| ------------------------------- | ------------------------- |
| `/admin`                        | Admin dashboard           |
| `/admin/products`               | Manage products           |
| `/admin/products/create`        | Add a new product         |
| `/admin/products/edit/{id}`     | Edit a product            |
| `/admin/products/delete/{id}`   | Delete a product          |
| `/admin/transactions`           | Manage transactions       |
| `/admin/transactions/edit/{id}` | Update transaction status |

## Folder Structure

```plaintext
project/
├── app/
│   ├── controllers/        # Controllers for handling logic
│   ├── models/             # Database interaction models
│   ├── routes/             # Application routes
│   ├── views/              # Frontend views
├── config/                 # Configuration files
├── public/                 # Publicly accessible files
│   ├── css/                # Stylesheets
│   ├── img/                # Images
│   ├── index.php           # Application entry point
├── system/                 # Core system classes (e.g., Database)
├── db.sql                  # Database schema
├── README.md               # Project documentation
```

## Technologies Used

- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML, CSS, JS

## Contribution

Contributions are welcome! Please fork the repository, create a feature branch, and submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Contact

For any questions or issues, please contact the repository maintainer.
