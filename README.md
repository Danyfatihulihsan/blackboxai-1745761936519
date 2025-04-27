# Aquanest - Depot Air Isi Ulang Online Platform

This is a PHP and MySQL based online platform for Aquanest, a water depot business. It allows users to register, login, view products, place orders, and choose payment methods. Admin can manage orders and products.

## Features

- User registration and login
- Product listing and ordering
- Payment methods: Debit, Cash, Transfer Bank
- Admin dashboard for order management and payment confirmation
- About and Contact pages
- Contact form for user messages

## Project Structure

- /assets: CSS, JS, images
- /includes: Common PHP includes (header, footer, navbar, db config)
- /user: User-facing pages (login, register, products, ordering, about, contact)
- /admin: Admin pages (dashboard, payment confirmation, product management)
- /config: Database configuration

## Setup

1. Create a MySQL database named `aquanest`.
2. Import the database schema (create tables: users, products, orders, messages).
3. Update database credentials in `config/config.php`.
4. Place the project in your web server root.
5. Access the site via browser.

## Notes

- Basic session management implemented.
- No advanced security or admin authentication yet.
- Styling is basic; can be enhanced with CSS frameworks.
