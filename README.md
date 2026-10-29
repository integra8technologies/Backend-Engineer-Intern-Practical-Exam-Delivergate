<div align="center">

# 🍨 Ice Cream Shop POS Backend API
### Backend Engineer Intern • Practical Exam Submission

[![Laravel Status](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![MySQL Database](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![Sanctum Auth](https://img.shields.io/badge/Sanctum-Token_Auth-00FFFF?style=for-the-badge&logo=php&logoColor=black)](https://laravel.com/docs/sanctum)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

*A secure RESTful API backend built for point-of-sale operations, inventory tracking, customer loyalty records, and strict Role-Based Access Control (RBAC).*

</div>

---

## 🚀 Project Overview

This project serves as a comprehensive backend solution for an Ice Cream Shop Point of Sale (POS) system. It manages core entities (**Users**, **Items**, and **Customers**) with secure token authentication via Laravel Sanctum and explicit permission guardrails tailored for different staff positions.

---

## 🛡️ Role-Based Access Control (RBAC) Matrix

| Role | Email | Password | Permissions & Capabilities |
| :--- | :--- | :--- | :--- |
| **Owner** | `owner@icecream.com` | `owner123` | **Full Control:** Create, Read, Update, and Delete on both Inventory and Customers. |
| **Manager** | `manager@icecream.com` | `manager123` | **Operations Lead:** Create, Read, and Update records (**No Delete permissions**). |
| **Cashier** | `cashier@icecream.com` | `cashier123` | **Front-end Staff:** Full Customer CRUD; View & Edit existing Inventory items only. |

---

## 🛠️ Tech Stack & Architecture

* **Framework:** Laravel 11 (PHP)
* **Database:** MySQL (Structured Entity Tables)
* **Authentication:** Laravel Sanctum (Bearer Token Authentication)
* **Data Seeding:** Custom Database Seeder (`IceCreamShopSeeder`)

---

## 📦 Database Schema Design

The database consists of three primary business entity tables along with Laravel framework system tables:
1. **`users`**: Manages staff logins, emails, hashed passwords, and access roles (`owner`, `manager`, `cashier`).
2. **`items`**: Stores the ice cream product catalog (flavors, categories, pricing, stock levels).
3. **`customers`**: Stores client contact records (names, phone numbers) and reward loyalty points.

---

## ⚙️ Step-by-Step Setup Guide for Reviewers

Follow these instructions to set up, run, and test the project locally from scratch:

### Prerequisites
* **PHP** (Version 8.2 or higher)
* **Composer** (PHP Package Manager)
* **MySQL** (Local server via XAMPP, Laragon, MySQL Workbench, etc.)
* **Postman** (Recommended for testing API endpoints)

### Step 1: Clone the Repository
```bash
git clone [https://github.com/your-username/your-repo-name.git](https://github.com/your-username/your-repo-name.git)
cd your-repo-name