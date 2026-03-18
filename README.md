# GymRat

A gym class management web application built with Laravel 12. Members can browse and book classes, instructors can schedule and manage their classes, and all parties are notified via email and in-app notifications when a booking is made.

---

## Tech Stack

- **Backend** — Laravel 12, PHP 8.2+
- **Frontend** — Blade, Tailwind CSS, Vite
- **Database** — MySQL
- **Auth** — Laravel Breeze
- **Testing** — Pest
- **Dev Tools** — Laravel Telescope, Laravel Pail

---

## Roles

There are three user roles. Each role is redirected to its own dashboard on login.

| Role | What they can do |
|---|---|
| `member` | Browse classes, book classes, cancel bookings, view upcoming booked classes |
| `instructor` | Schedule classes, view their upcoming classes, cancel their own classes |
| `admin` | Access to everything |

Role access is enforced by the `CheckUserRole` middleware and two Gates defined in `AppServiceProvider`:
- `schedule-class` — instructors only
- `book-class` — members only

---

## Features

### Authentication
Handled by Laravel Breeze. Users can register, log in, reset their password, and manage their profile. On login, `DashboardController` reads the user's role and redirects them to the correct dashboard.

### Class Scheduling (Instructor)
Instructors can schedule a new class by selecting a class type, date, and time. The `date_time` field must be unique and in the future. Instructors can also cancel their own scheduled classes — canceling detaches all member bookings from that class.

### Class Booking (Member)
Members can browse all upcoming classes and book any they haven't already booked. Booking a past class is blocked. Members can cancel a booking from their upcoming classes page.

### Email Notifications
Two emails are sent every time a member books a class:

- **Member** receives a booking confirmation email (`emails.class-booked`)
- **Instructor** receives a new booking notification email (`emails.instructor-booking-notification`)

---

## Database

### Tables

| Table | Description |
|---|---|
| `users` | All users with a `role` column (`member`, `instructor`, `admin`) |
| `class_types` | Predefined class types with name, description, and duration |
| `scheduled_classes` | Classes scheduled by instructors with a `date_time` and `instructor_id` |
| `bookings` | Pivot table linking `users` and `scheduled_classes` |
| `notifications` | Laravel database notifications for members and instructors |

---

## Seeders

Seeders were implemented to populate the database with realistic starting data for development and manual testing. Running `php artisan db:seed` executes three seeders in order:

- `UserSeeder` — creates 1 named member, 1 named instructor, and 1 named admin account, plus 10 additional random members and 10 additional random instructors generated via factories
- `ClassTypeSeeder` — creates 5 fixed class types: Strength Training (60 min), Cardio (45 min), Yoga (60 min), Dance Fitness (60 min), and Boxing (30 min)
- `ScheduledClassSeeder` — generates 10 upcoming scheduled classes using the `ScheduledClassFactory`, each randomly assigned to one of the seeded instructors and class types

The following named accounts are available after seeding:

| Role | Email | Password |
|---|---|---|
| Member | `ken@example.com` | `password` |
| Instructor | `instructor@example.com` | `password` |
| Admin | `admin@example.com` | `password` |

---