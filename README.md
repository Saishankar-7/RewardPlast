# RewardPlast

RewardPlast is a PHP-based web application for tracking user points and redeeming rewards. It supports user registration, login, profile management, a points leaderboard, request requests, admin approval workflows, and email-based password reset.

## ✅ Features

- User registration and login
- View and update user profile
- Points leaderboards and ranking updates
- Reward request creation, approval/rejection flow
- Admin dashboards for payments, user status changes, promotions
- Password reset via email (PHPMailer integration)
- SQL storage (MySQL) for user, rewards, requests, and history

## 📁 Project structure

- `code/`
  - `login.php`, `Registration.php`, `userprofile.php`, etc.
  - `leaderboard.php`, `request1.css`, `reward.css`, and more UI pages
  - `adminpayments.php`, `promote.php`, `demote.php`, `remove.php`, etc.
- `code/forgetpassword/`
  - `config.php`, `requestReset.php`, `resetPassword.php`
  - `PHPMailer/` (mailer library and composer manifest)
- `code/project.sql` - schema + sample table creation

## 🔧 Requirements

- PHP 7.x or newer (compatible with PHPMailer integration)
- MySQL/MariaDB database
- Web server (Apache / Nginx)

## 🛠️ Setup

1. Clone repository to web root
2. Create database and run `code/project.sql`
3. Update DB config in `code/connection.php` and `code/forgetpassword/config.php`
4. Install PHPMailer dependencies (composer in `code/forgetpassword/PHPMailer`)

## 🧪 Security

- Fixed dependency security issue: upgraded `phpunit/phpunit` to `~8.5.52` to address CVE-2026-24765
- Ensure your own environment installs Composer and runs `composer validate` for `forgetpassword/PHPMailer/composer.json`

## 🗒️ Notes

- This is an introductory/educational reward tracking system (no production hardening).
- You may extend with CSRF protection, sanitized prepared statements, and modern PHP frameworks.

