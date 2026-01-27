# ⚽ ScoutMe Backend

<div align="center">

**A Comprehensive Football Analytics Backend Application**

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

</div>

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [Installation](#-installation)
- [Configuration](#️-configuration)
- [API Documentation](#-api-documentation)
- [Database Schema](#-database-schema)
- [Development](#-development)
- [Testing](#-testing)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🎯 Overview

**ScoutMe Backend** is a powerful football analytics API built with Laravel, designed to provide comprehensive data and insights for football scouts, analysts, and enthusiasts. The platform offers detailed player statistics, match analytics, competition tracking, and subscription management capabilities.

### What Makes ScoutMe Special?

- 📊 **Detailed Player Analytics** - Access comprehensive player statistics, performance metrics, and historical data
- ⚽ **Match Statistics** - Real-time match data with detailed team and player performance analysis
- 🏆 **Competition Tracking** - Monitor multiple competitions, seasons, and tournaments
- 🔍 **Advanced Search** - Powerful search functionality with filters for players, teams, and matches
- 👥 **Scout Management** - Dedicated tools for football scouts to track and manage players
- 💳 **Subscription System** - Flexible subscription plans using Laravel Cashier
- 🔐 **Secure Authentication** - Token-based authentication with Laravel Sanctum
- 📱 **RESTful API** - Clean, versioned API architecture

---

## ✨ Key Features

### Player Management
- Comprehensive player profiles with personal and performance data
- Junior player tracking and development monitoring
- Player position management with primary and secondary positions
- Advanced filtering by position, nationality, team, and name
- Full-text search capabilities using Laravel Scout

### Match Analytics
- Detailed match statistics and team performance metrics
- Player-specific match statistics (attackers, goalkeepers, field players)
- Match lineup and formation tracking
- Historical match data and seasonal comparisons

### Competition & Team Management
- Multi-competition support with season tracking
- Club and national team management
- League standings and competition structures
- Country and nationality tracking

### Scout Features
- Scout profiles with customizable notes
- Player watchlists and tracking
- Subscription-based access control
- Dashboard with personalized insights

### Subscription System
- Multiple subscription tiers
- Payment processing with Laravel Cashier
- Subscription status tracking
- Access level management

---

## 🛠 Tech Stack

### Core Framework
- **[Laravel 12.x](https://laravel.com)** - Modern PHP framework with elegant syntax
- **PHP 8.2+** - Latest PHP features and performance improvements

### Key Packages
- **[Laravel Sanctum](https://laravel.com/docs/sanctum)** - API token authentication
- **[Laravel Scout](https://laravel.com/docs/scout)** - Full-text search
- **[Laravel Cashier](https://laravel.com/docs/cashier)** - Subscription billing
- **[Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)** - Role and permission management
- **[Spatie Query Builder](https://spatie.be/docs/laravel-query-builder)** - Elegant API filtering and sorting

### Development Tools
- **[Laravel Telescope](https://laravel.com/docs/telescope)** - Debug assistant
- **[Laravel Pint](https://laravel.com/docs/pint)** - Code style fixer
- **[Laravel Sail](https://laravel.com/docs/sail)** - Docker development environment
- **[PHPUnit](https://phpunit.de)** - Testing framework

### Database
- **MySQL** - Primary database
- **Redis** - Caching and queue management (optional)

---

## 📦 Installation

### Prerequisites

Before you begin, ensure you have the following installed:
- PHP >= 8.2
- Composer
- MySQL >= 5.7 or MariaDB >= 10.3
- Node.js & NPM (for asset compilation)

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/MohanedM7md/ScoutMe-BE.git
   cd ScoutMe-BE
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   
   Edit your `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=scoutme
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

The API will be available at `http://localhost:8000`

### Using Laravel Sail (Docker)

For a containerized development environment:

```bash
# Install dependencies
composer install

# Start Sail
./vendor/bin/sail up -d

# Run migrations
./vendor/bin/sail artisan migrate

# Access the application at http://localhost
```

---

## ⚙️ Configuration

### Environment Variables

Key environment variables to configure:

```env
# Application
APP_NAME=ScoutMe
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_DATABASE=scoutme
DB_USERNAME=root
DB_PASSWORD=

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025

# Payment (Laravel Cashier)
STRIPE_KEY=your_stripe_key
STRIPE_SECRET=your_stripe_secret
```

### Permissions Setup

Run the following to set up proper permissions:

```bash
chmod -R 775 storage bootstrap/cache
```

---

## 🚀 API Documentation

### Base URL
```
http://localhost:8000/api/v1
```

### Authentication

The API uses Laravel Sanctum for authentication. Include the bearer token in the Authorization header:

```http
Authorization: Bearer your-token-here
```

### API Endpoints Overview

#### Authentication
```http
POST   /api/v1/auth/register      # Register new user
POST   /api/v1/auth/login         # Login
POST   /api/v1/auth/logout        # Logout
GET    /api/v1/auth/user          # Get authenticated user
```

#### Players
```http
GET    /api/v1/players             # List all players
GET    /api/v1/players/{id}        # Get player details
GET    /api/v1/players/search      # Search players
GET    /api/v1/players/stats/{id}  # Get player seasonal stats
```

#### Matches
```http
GET    /api/v1/matches             # List all matches
GET    /api/v1/matches/{id}        # Get match details
GET    /api/v1/matches/{id}/stats  # Get match statistics
GET    /api/v1/matches/{id}/players # Get match players by team
GET    /api/v1/matches/{id}/player-stats # Get player stats by ID
```

#### Competitions
```http
GET    /api/v1/competitions        # List competitions
GET    /api/v1/competitions/{id}   # Get competition details
```

#### Teams
```http
GET    /api/v1/teams               # List teams
GET    /api/v1/teams/{id}          # Get team details
```

#### Subscriptions
```http
GET    /api/v1/subscriptions       # List subscription plans
POST   /api/v1/subscriptions/subscribe # Subscribe to a plan
```

#### Scout
```http
GET    /api/v1/scout/profile       # Get scout profile
PUT    /api/v1/scout/profile       # Update scout profile
```

#### Search
```http
GET    /api/v1/search              # Global search endpoint
```

#### Dashboard
```http
GET    /api/v1/dashboard           # Get dashboard data
```

#### Admin (Protected)
```http
GET    /api/v1/admin/*             # Admin endpoints (role-based access)
```

### Query Parameters

Most list endpoints support the following query parameters:

- `filter[column]` - Filter by column value
- `sort` - Sort by column (prefix with `-` for descending)
- `include` - Include relationships
- `page[number]` - Page number for pagination
- `page[size]` - Items per page

**Example:**
```http
GET /api/v1/players?filter[position]=Forward&sort=-name&include=team,nationality&page[number]=1&page[size]=20
```

---

## 🗄 Database Schema

### Core Tables

#### Players
- Personal information (name, nationality, birth date, height, weight)
- Position and team associations
- Player images

#### Matches
- Match details (date, time, competition)
- Team matchups
- Final scores and match status

#### Match Statistics
- Team-level statistics
- Player-level statistics
- Position-specific statistics (attackers, goalkeepers)

#### Clubs & Teams
- Club information
- Team rosters
- Competition participation

#### Competitions
- Competition details
- Seasons
- Competition structure

#### Subscriptions
- Subscription plans
- User subscriptions
- Payment tracking

#### Scouts
- Scout profiles
- Notes and observations
- User associations

---

## 💻 Development

### Running the Development Server

```bash
# Standard development server
php artisan serve

# Or use the combined development command
composer dev
```

The `composer dev` command runs:
- Laravel development server
- Queue listener
- Vite development server

### Code Style

Format code using Laravel Pint:

```bash
./vendor/bin/pint
```

### Database Management

```bash
# Create a new migration
php artisan make:migration create_table_name

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh migration (drops all tables)
php artisan migrate:fresh

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

### Artisan Commands

```bash
# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# List all routes
php artisan route:list

# Run the queue worker
php artisan queue:work

# Monitor logs in real-time
php artisan pail
```

---

## 🧪 Testing

The project uses PHPUnit for testing.

### Running Tests

```bash
# Run all tests
php artisan test

# Or use composer script
composer test

# Run specific test file
php artisan test tests/Feature/PlayerTest.php

# Run with coverage
php artisan test --coverage
```

### Writing Tests

Tests are located in the `tests/` directory:
- `tests/Feature/` - Feature tests (API endpoints, integration)
- `tests/Unit/` - Unit tests (models, services, helpers)

---

## 🤝 Contributing

We welcome contributions! Please follow these guidelines:

1. **Fork the repository**
2. **Create a feature branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```
3. **Make your changes**
4. **Run tests**
   ```bash
   composer test
   ```
5. **Format your code**
   ```bash
   ./vendor/bin/pint
   ```
6. **Commit your changes**
   ```bash
   git commit -m 'Add some amazing feature'
   ```
7. **Push to the branch**
   ```bash
   git push origin feature/amazing-feature
   ```
8. **Open a Pull Request**

### Coding Standards

- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add tests for new features
- Update documentation as needed

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👥 Authors

- **Mohaned M7md** - [GitHub](https://github.com/MohanedM7md)

---

## 🙏 Acknowledgments

- Laravel Framework and community
- Spatie for their excellent Laravel packages
- All contributors and supporters

---

## 📞 Support

For support, please:
- Open an issue on GitHub
- Contact the development team
- Check the documentation

---

<div align="center">

Made with ❤️ for Football Analytics

**[⬆ Back to Top](#-scoutme-backend)**

</div>
