Smart User Authentication System

A full-stack web application that provides secure user authentication using OTP verification and email notifications.

---

Tech Stack

Backend

* PHP (Laravel)
* PostgreSQL
* Service–Repository Architecture
* Event & Listener Pattern

Frontend

* React (Vite)
* Axios
* Tailwind CSS

Email Service

* Mailtrap (for development testing)

---

Features

* User Registration with OTP Verification
* Secure Login System
* Forgot Password with OTP
* Email Notifications (Event-driven)
* Protected Dashboard
* Clean Architecture (Service + Repository Pattern)

---

Project Structure

```plaintext
otp/
├── smart-auth/             # Laravel Backend
├── smart-auth-frontend/    # React Frontend
└── .gitignore
```

---

Authentication Flow

1. User registers with name, email, password
2. System generates OTP and sends email
3. User verifies OTP
4. Account becomes active
5. User can log in
6. Forgot password uses OTP reset flow

---

Backend Setup (Laravel)

```bash
cd smart-auth
composer install
cp .env.example .env
php artisan key:generate
```

Configure Database

Update `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=smart_auth
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

Run migrations:

```bash
php artisan migrate
```

---

Mailtrap Configuration

Update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@smartauth.com"
MAIL_FROM_NAME="SmartAuth"
```

---

Run Backend

```bash
php artisan serve
```

---

Frontend Setup (React)

```bash
cd smart-auth-frontend
npm install
npm run dev
```


🔗 API Base URL

```plaintext
http://127.0.0.1:8000/api
```



API Endpoints

| Method | Endpoint                  | Description    |
| ------ | ------------------------- | -------------- |
| POST   | /api/auth/register        | Register user  |
| POST   | /api/auth/verify-otp      | Verify OTP     |
| POST   | /api/auth/login           | Login          |
| POST   | /api/auth/forgot-password | Send reset OTP |
| POST   | /api/auth/reset-password  | Reset password |

---

Security Features

* Password hashing (bcrypt)
* OTP expiration (5 minutes)
* Email verification required
* Clean architecture separation

---

Learning Highlights

* Full-stack authentication system
* OTP-based verification logic
* Event-driven email handling
* Laravel clean architecture
* API integration with React


📌 Future Improvements

* Resend OTP functionality
* Rate limiting
* JWT authentication
* Account lock after failed attempts
* Deployment setup


Author

Akhil S Nair


Support

If you find this project useful, consider giving it a ⭐ on GitHub.
