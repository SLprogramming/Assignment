# ShopNest - E-Commerce Assignment Project

ShopNest is a modern, responsive e-commerce web application built with Laravel. This project was developed as a comprehensive assignment to demonstrate full-stack development skills, including product management, category organization, shopping cart functionality, and an administrative dashboard.

## 🚀 Features

- **Product Catalog**: Browse a wide variety of products across multiple categories.
- **Dynamic Categories**: Products are organized into categories like Electronics, Fashion, Home & Garden, etc.
- **Discount System**: Support for percentage-based discounts on specific products.
- **Shopping Cart**: Fully functional cart system for adding and managing items.
- **Wishlist**: Users can save their favorite products for later.
- **Order Management**: Complete checkout process with order history.
- **Admin Dashboard**: Powerful administrative interface to manage products, categories, and view customer orders.
- **Responsive Design**: Premium UI built with Tailwind CSS, optimized for both desktop and mobile.

## 🛠️ Installation & Setup

Follow these steps to get the project running locally:

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd Assignment
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Configuration**
   - Copy the example environment file:
     ```bash
     cp .env.example .env
     ```
   - Open `.env` and configure your database settings (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

4. **Generate App Key**
   ```bash
   php artisan key:generate
   ```

5. **Storage Link**
   ```bash
   php artisan storage:link
   ```

---

## 🧪 Testing & Demo (Seeder Session)

To help you test the application quickly, I have provided comprehensive seeders that populate the database with realistic dummy data.

### 1. Setup the Database
Run the following command to wipe the database, run all migrations, and populate it with sample data (Categories, Products, and Users):

```bash
php artisan migrate:fresh --seed
```

### 2. Demo Accounts
You can use the following credentials to test the different roles in the system:

#### **Administrator Account**
- **Email**: `admin@gmail.com`
- **Password**: `12345678`
- **Role**: Access to the `/admin` dashboard.

#### **Regular User Account**
- **Email**: `user@gmail.com`
- **Password**: `user1234`
- **Role**: Standard customer access.

### 3. Sample Data Overview
- **Categories**: 6 major categories created.
- **Products**: 34 dummy products added (23 non-discounted, 11 with discounts).
- **Associations**: All products are correctly linked to their respective categories via a pivot table.

---

## 💻 Tech Stack

- **Backend**: Laravel 10.x / PHP 8.x
- **Frontend**: Blade Templates, Tailwind CSS, JavaScript
- **Database**: MySQL / SQLite
- **Authentication**: Laravel Breeze / Built-in Auth

## 📝 License

This project is for educational purposes as part of a programming assignment.
