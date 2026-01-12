# Food App - Online Food Ordering System

A modern, full-featured online food ordering application built with Laravel 11. This application allows users to browse food items, add them to cart, place orders, and manage their favorites. It includes a comprehensive admin dashboard for managing food items, orders, and user interactions.

## 🚀 Features

### User Features
- **User Authentication**
  - Email/Password registration and login
  - Google OAuth integration for quick sign-in
  - User profile management

- **Food Browsing**
  - Browse food items by categories
  - Search functionality
  - Detailed food item pages with descriptions
  - Responsive gallery view with filtering

- **Shopping Cart**
  - Add items to cart
  - Update quantities
  - Remove items
  - Real-time price calculation

- **Favorites**
  - Add/remove food items to favorites
  - View favorite items in a dedicated page

- **Order Management**
  - Place orders
  - View order history
  - Track order status
  - Download order details as CSV
  - Order comments and feedback

- **Payment Processing**
  - Integrated payment system
  - Payment success tracking

### Admin Features
- **Dashboard**
  - Overview of foods, users, and orders
  - Activity log tracking
  - Pending orders count
  - User management

- **Food Management**
  - Create, read, update, and delete food items
  - Category management
  - Image uploads
  - Activity logging for changes

- **Order Management**
  - View all orders
  - Update order status
  - Order details view
  - Email notifications on status updates

- **Comments & Feedback**
  - View customer comments
  - Reply to comments
  - Mark comments as read/unread

- **Analytics**
  - Super admin analytics dashboard
  - Activity log with filtering

## 🛠️ Technology Stack

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Bootstrap 5, JavaScript
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Breeze, Laravel Socialite
- **Additional Packages**:
  - Spatie Activity Log - For tracking admin activities
  - Laravel Cashier - Payment processing
  - Simple QR Code - QR code generation
  - Laravel Reverb - Real-time features

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/PostgreSQL database
- Web server (Apache/Nginx)

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd food-app
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your `.env` file**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

   # Google OAuth (optional)
   GOOGLE_CLIENT_ID=your_google_client_id
   GOOGLE_CLIENT_SECRET=your_google_client_secret
   GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Create storage link**
   ```bash
   php artisan storage:link
   ```

8. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## 📁 Project Structure

```
food-app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── CartController.php
│   │       ├── CommentController.php
│   │       ├── FoodController.php
│   │       ├── HomeController.php (Admin)
│   │       ├── OrderController.php
│   │       ├── ProfileController.php
│   │       ├── SocialiteController.php
│   │       └── SuperAdminController.php
│   └── Models/
│       ├── Food.php
│       ├── Order.php
│       ├── Cart.php
│       ├── Favorite.php
│       └── User.php
├── resources/
│   └── views/
│       ├── admin/          # Admin dashboard views
│       ├── cart/           # Cart views
│       ├── food/           # Food item views
│       ├── layouts/        # Layout components
│       └── welcome.blade.php
├── routes/
│   └── web.php            # Application routes
├── database/
│   └── migrations/        # Database migrations
└── public/
    ├── css/              # Custom stylesheets
    └── storage/          # Uploaded files
```

## 🔐 User Roles

- **Regular User**: Can browse, add to cart, place orders, manage favorites
- **Admin**: Can manage food items, orders, view activity logs, respond to comments
- **Super Admin**: Additional analytics and system-wide access

## 🎨 Key Pages

- `/` - Landing page with loading animation
- `/main` - Main homepage with food categories
- `/welcome` - Food gallery with category filtering
- `/food/{id}` - Individual food item details
- `/cart/view` - Shopping cart
- `/favorites` - User's favorite items
- `/orders` - Order history
- `/profile` - User profile management
- `/admin/dashboard` - Admin dashboard
- `/about-us` - About page
- `/contact-us` - Contact page

## 🚦 Usage

### For Users
1. Register/Login or use Google OAuth
2. Browse food items by category
3. Add items to cart or favorites
4. Proceed to checkout
5. Complete payment
6. Track your orders

### For Admins
1. Login with admin credentials
2. Access admin dashboard
3. Manage food items (CRUD operations)
4. View and update order statuses
5. Respond to customer comments
6. Monitor activity logs

## 📝 API Endpoints

- `GET /food-items` - Get all food items (JSON)
- `GET /food-item-details` - Get food item details (JSON)
- `POST /cart/add` - Add item to cart
- `POST /cart/update-quantity/{id}` - Update cart quantity
- `DELETE /remove-from-cart/{id}` - Remove from cart
- `POST /favorite` - Toggle favorite status
- `POST /process-order` - Process order
- `GET /orders/{id}/download-csv` - Download order CSV

## 🔒 Security Features

- CSRF protection
- Authentication middleware
- Role-based access control
- Input validation
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade templating)

## 🧪 Testing

```bash
php artisan test
```

## 📦 Deployment

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Run `php artisan config:cache`
4. Run `php artisan route:cache`
5. Run `php artisan view:cache`
6. Ensure storage is linked: `php artisan storage:link`
7. Set proper file permissions for `storage/` and `bootstrap/cache/`

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

Developed as a comprehensive food ordering system with modern web technologies.

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap
- Font Awesome
- GSAP for animations
- SweetAlert2 for notifications

---

**Note**: Make sure to configure your database, storage, and environment variables before running the application.
