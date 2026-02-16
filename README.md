## Billiard Billing System - PHP & MySQL

---

### Key Features

#### Customer Side

* User registration & login
* Real-time table availability
* Booking system for tables
* Profile management

#### Admin Dashboard

* Manage payment statuses
* Booking and transaction overview
* Add/edit/delete billiard tables
* Admin login authentication

---

### Technologies Used

* **Backend**: PHP (Native)
* **Database**: MySQL
* **Frontend**: HTML5, CSS3, JavaScript
* **Libraries**: Bootstrap

---

### How to Run the Project

1. Clone or download this repository:

   ```bash
   git clone https://github.com/yourusername/eightspacebilliard.git
   ```
2. Move the project folder to your `htdocs` directory (if using XAMPP).
3. Create a new database in phpMyAdmin, e.g., `lapangin.id`.
4. Import the SQL file (not included in repo).
5. Configure the database connection in `koneksi.php`.
6. Open your browser and run:

   ```
   http://localhost/eightspacebilliard/
   ```

---

### Demo Accounts

#### Admin

* Username: `admin`
* Password: `12345`

#### Customer

* Username: `iyus`
* Password: `12345`

---

### Project Structure

| File                        | Description                             |
| --------------------------- | --------------------------------------- |
| `index.php`                 | Landing page with table status display  |
| `login_pengguna.php`        | Customer login page                     |
| `register.php`              | Registration page for new customers     |
| `booking.php`               | Booking form for table reservations     |
| `admin_dashboard.php`       | Admin panel for managing everything     |
| `change_payment_status.php` | Update booking payment status           |
| `tambah_lapang.php`         | Add new table to the system             |
| `koneksi.php`               | Database connection configuration       |
| `process_*.php`             | Backend process scripts (booking, etc.) |

---

### Security Features

* Passwords hashed using `password_hash()`
* Role-based access (admin vs user)
* Session-based authentication protection

---

### Future Enhancements

* Online payment integration (e.g., Midtrans, Stripe)
* Email notifications for bookings
* Admin reports and analytics
* Mobile app integration for users

---
