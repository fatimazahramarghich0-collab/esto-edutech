
#  ESTO EduTech

![Laravel](https://img.shields.io/badge/Laravel-Framework-red?style=for-the-badge\&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-Backend-blue?style=for-the-badge\&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge\&logo=mysql)
![Status](https://img.shields.io/badge/Status-Completed-green?style=for-the-badge)

---

##  Overview

**ESTO EduTech** is a full-stack web application developed for the **Higher School of Technology of Oujda (ESTO)**.

It aims to **centralize and simplify academic and administrative management** by providing a secure and role-based platform for all users of the institution.

The system supports multiple user roles:

* 👨‍🎓 Students
* 👩‍🏫 Teachers
* 🧑‍💼 Department Heads
* 🧑‍🏫 Program Coordinators
* 🛠️ Administrators

---

##  Objectives

* Digitize academic and administrative workflows
* Improve communication between stakeholders
* Centralize academic data in a secure system
* Provide role-based access control
* Enhance productivity and data accessibility

---

##  Key Features

###  Public Interface

* Institutional information presentation
* Academic programs and services overview
* News and updates
* Contact form

---

###  Authentication & Security

* Secure login system
* Role-based access control (RBAC)
* Password encryption
* Input validation & protection

---

###  Administrator Panel

* Student management (CRUD)
* Bulk import (CSV / XLSX / TXT)
* Department & program management
* Modules & subjects management
* Teacher management
* Contact messages handling
* Profile management

---

###  Teacher Dashboard

* Course, TD & TP management
* Upload learning resources
* Exam & grading management
* Attendance tracking
* Workload consultation

---

###  Program Coordinator

* Assignment of teachers to subjects
* Teaching load management
* Program-level coordination

---

###  Student Portal

* Access to courses and materials
* Download academic resources
* View grades and attendance
* Exam schedules
* Personal profile management

---

##  Tech Stack

### Backend

* PHP
* Laravel Framework

### Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap

### Database

* MySQL
* Eloquent ORM

### Tools & Environment

* Visual Studio Code
* Laragon
* Git & GitHub
* PowerAMC
* Astah UML

---

##  Architecture

The project follows the **MVC (Model–View–Controller)** architecture provided by Laravel:

* **Models** → Data structure & database interaction
* **Views** → Blade templates (UI layer)
* **Controllers** → Business logic
* **Routes** → Application endpoints

---

##  Installation

```bash
# Clone the repository
git clone https://github.com/fatimazahramarghich0-collab/esto-edutech.git

cd esto-edutech

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure database in .env then run:
php artisan migrate

# Run development server
php artisan serve
```

---

##  Security Features

* Authentication system
* Role-based authorization
* Secure password hashing
* Form validation & sanitization
* Protection of sensitive data

---

##  Project Team

* **Fatima Zahra Marghich**
* Aya Ouzarf
* Wissal Benali
* Abderrahim El Ouriachi
* Ayoub Berhili

---

##  Project Information

This project was developed in **2024** as part of a **Final Year Internship (PFE)** at ESTO.

It was published on GitHub in **2026** for portfolio demonstration and technical showcase.

---

## Future Improvements

* Mobile application (Android / iOS)
* Real-time notifications
* Advanced analytics dashboard
* Electronic document management system
* Multi-language support (FR / AR / EN)

---

##  License

Academic project developed for educational purposes at the **Higher School of Technology of Oujda (ESTO)**.


