# SIMPLE BD PGW PHP

A reusable PHP library for integrating Bangladeshi Mobile Banking payment gateways (bKash and Nagad) with robust token management and an elegant MVC architecture.

![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-brightgreen)
![License](https://img.shields.io/badge/License-MIT-blue)
![Contributions](https://img.shields.io/badge/Contributions-Welcome-orange)

## Table of Contents

-   [Features](#-features)
-   [Project Structure](#-project-structure)
-   [Requirements](#-requirements)
-   [Installation](#-installation)
-   [Usage](#-usage)
-   [API Reference](#-api-reference)
-   [Configuration Details](#-configuration-details)
-   [Testing](#-testing)
-   [Contributing](#-contributing)
-   [License](#-license)
-   [Acknowledgments](#-acknowledgments)
-   [Developer](#-developer)
-   [Support](#-support)

## ✨ Features

-   **bKash Integration** with complete token management system
-   **Nagad Integration** with secure payment processing
-   **MVC Architecture** for clean, maintainable code
-   **Environment-based Configuration** for security
-   **Object-Oriented Programming** for reusability
-   **Simple Setup Process** with clear documentation
-   **Sandbox Support** for testing both gateways

## 🏗️ Project Structure

```
BD-PGW-PHP/
├── Controllers/
│   └── Index.php
├── Core/
│   ├── BaseController.php
│   ├── config.php
│   ├── functions.php
│   ├── helper.php
│   ├── Model.php
│   └── Router.php
├── Models/
│   ├── Bkash.php
│   ├── Helper.php
│   ├── Index.php
│   └── Nagad.php
├── public/
│   └── assets/
│       └── images/
│           └── favicon.png
├── vendor/
├── Views/
│   ├── bkash/
│   │   └── index.php
│   ├── home/
│   │   └── index.php
│   └── nagad/
│       └── index.php
├── .env
├── .env.example
├── .gitignore
├── .htaccess
├── composer.json
├── composer.lock
├── index.php
├── README.md
└── Routes.php
```

## 📋 Requirements

-   PHP 7.4 or higher
-   MySQL 5.7 or higher
-   Composer (for dependency management)
-   OpenSSL PHP Extension
-   PDO PHP Extension

## 🚀 Installation

### 1. Clone or Download the Project

Download the project files and extract them to your web server directory, or clone using Git:

```bash
git clone https://github.com/Mehedi01616720009/bd-pgw-php.git
cd bd-pgw-php
```

### 2. Environment Configuration

Copy the `.env.example` file to `.env` and update with your credentials:

```bash
cp .env.example .env
```

Edit the `.env` file with your specific configuration:

```ini
# Database Configuration
DB_HOST=localhost
DB_USER=your_username
DB_PASS=your_password
DB_NAME=your_database

# Application Settings
APP_ENV=local
APP_NAME=
APP_SUB_URL=
APP_URL=http://localhost:8000
PUBLIC_URL=http://localhost:8000

# bKash Configuration
BKASH_SANDBOX=true
BKASH_VERSION=
BKASH_APP_KEY=
BKASH_APP_SECRET=
BKASH_USERNAME=
BKASH_PASSWORD=
BKASH_CALLBACK_URL=http://localhost:8000/bkash
BKASH_BASE_URL=

# Nagad Configuration
NAGAD_SANDBOX=true
NAGAD_ACCOUNT=
NAGAD_MERCHANTID=
NAGAD_MERCHANT_PG_PUBLIC_KEY=
NAGAD_MERCHANT_PRIVATE_KEY=
NAGAD_CALLBACK_URL=http://localhost:8000/nagad
NAGAD_BASE_URL=

# Company Information
COMPANY_NAME=Your Company Name
COMPANY_LOGO=/path/to/logo.png
```

### 3. Install Dependencies

```bash
composer install
```

### 4. Database Setup

Import the SQL file (if provided) or run the application to create necessary tables.

### 5. Start Development Server

```bash
php -S localhost:8000 -t public
```

Visit `http://localhost:8000` in your browser.

## 🧩 Usage

### Basic Implementation

Include the library in your project:

```php
require_once 'path/to/simple-bd-pgw-php/autoload.php';
```

### Initialize Payment Gateway

```php
use SimpleBDPGW\BkashPayment;
use SimpleBDPGW\NagadPayment;

// Initialize bKash
$bkash = new BkashPayment();
$paymentData = $bkash->createPayment(1000, 'ORD12345');

// Initialize Nagad
$nagad = new NagadPayment();
$paymentData = $nagad->createPayment(1000, 'ORD12345');
```

### Handling Callbacks

The library automatically handles callbacks at the configured endpoints:

-   bKash Callback: `/bkash`
-   Nagad Callback: `/nagad`

## 🔧 API Reference

### bKash Methods

-   `createPayment($amount, $invoiceID, $payerReference)` - Create a new payment
-   `executePayment($paymentID)` - Execute a payment
-   `queryPayment($paymentID)` - Query payment status
-   `searchTransaction($trxID)` - Search for a transaction
-   `refreshToken()` - Refresh authentication token

### Nagad Methods

-   `createPayment($amount, $invoiceID)` - Create a new payment
-   `verifyPayment($paymentReferenceId)` - Verify payment status
-   `checkoutComplete()` - Complete checkout process

## 🛠️ Configuration Details

### Database Setup

The application requires MySQL with the following tables:

-   `payments` - Stores payment transactions
-   `tokens` - Stores gateway authentication tokens (automatically managed)

### Gateway Credentials

Obtain credentials from respective merchant panels:

-   [bKash Merchant Panel](https://developer.bka.sh/)
-   [Nagad Merchant Portal](https://channel.mynagad.com:20010/)

### SSL Configuration

For production use, SSL certification is required by both payment gateways.

## 🧪 Testing

### Sandbox Mode

Set the following in your `.env` file for testing:

```ini
BKASH_SANDBOX=true
NAGAD_SANDBOX=true
```

Use test credentials provided by the payment gateways.

### Test Cards

Use test account credentials provided by bKash and Nagad for sandbox testing.

## 🤝 Contributing

We welcome contributions to improve this library. Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

-   bKash Limited for their payment API
-   Nagad Limited for their payment API
-   PHP community for excellent documentation and resources

## 👨‍💻 Developer

**Mehedi Hasan**

-   Email: [mehedi01616720009@gmail.com](mailto:mehedi01616720009@gmail.com)
-   GitHub: [Mehedi01616720009](https://github.com/Mehedi01616720009)

If this project helps you, please consider giving it a star ⭐ on GitHub.

## 🆓 Support

For support, email mehedi01616720009@gmail.com or create an issue in the GitHub repository.

---

**Disclaimer**: This library is not officially affiliated with bKash or Nagad. Always test thoroughly in sandbox mode before going live.
