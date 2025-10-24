🏋️‍♀️ FitZone Fitness Center Website
📖 Overview

The FitZone Fitness Center web application is a dynamic, user-friendly PHP-based website developed to enhance the digital experience of a newly opened fitness center in Kurunegala.
It allows customers to explore gym services, register for memberships, request personal training, and communicate directly with staff and administrators.
This project demonstrates full-stack web development principles, including frontend design, backend database integration, and role-based access control.

🧩 Features
👥 User Roles

Customer:

Register, log in, and manage their profile.

View available classes, trainers, and membership plans.

Submit queries and request personal training sessions.

Staff:

Log in securely to manage classes.

Respond to customer queries.

View customer details and personal training requests.

Admin:

Full system control including user, staff, class, and membership management.

Manage all records: add, update, delete, and view.

Handle customer queries and oversee staff activities.

💻 Technologies Used
Category	Tools & Technologies
Frontend	HTML, CSS, JavaScript
Backend	PHP
Database	MySQL
Design Tools	Figma / Mockup Diagrams
Testing Tools	Selenium (Functional), JMeter (Performance)
🗂️ Project Structure
/FitZone-Fitness-Center
│
├── index.php
├── about.php
├── services.php
├── pricing.php
├── trainers.php
├── membership.php
├── contact.php
│
├── admin/
│   ├── admin_login.php
│   ├── manage_user.php
│   ├── manage_staff.php
│   ├── manage_classes.php
│   ├── manage_membership.php
│   ├── manage_query.php
│
├── staff/
│   ├── staff_login.php
│   ├── staff_dashboard.php
│   ├── query_view.php
│
├── customer/
│   ├── register.php
│   ├── customer_profile.php
│   ├── submit_query.php
│   ├── personal_training_form.php
│
└── database/
    ├── gym.sql

🗺️ Site Map

Home

About Us

Services

Membership

Trainers

Blog

Contact Us

Customer Login / Register

Staff Login

Admin Login

🧠 Database Design

Entities:

Customer

Staff

Admin

Membership

Classes

Register

Personal_Training_Form

Query

Relationships:

One-to-many (Customer ↔ Membership)

Many-to-many (Customer ↔ Trainer)

One-to-many (Customer ↔ Query)

One-to-many (Admin ↔ Staff)

🧪 Testing Summary

The system was tested across multiple functional areas to ensure reliability and performance.

Test Type	Purpose
Functional	Verify all modules (login, add/delete/update records)
Usability	Ensure intuitive navigation and responsive design
Security	Validate restricted access for roles
Performance	Evaluate response under concurrent users

✅ All test cases passed successfully, confirming system stability and usability.
