# ELKash ERP

Modern Modular ERP & POS System for Cafes and Restaurants

![Status](https://img.shields.io/badge/status-development-orange)
![Frontend](https://img.shields.io/badge/frontend-Nuxt%203-green)
![Backend](https://img.shields.io/badge/backend-Laravel-red)
![Database](https://img.shields.io/badge/database-PostgreSQL-blue)
![License](https://img.shields.io/badge/license-MIT-lightgrey)

---

## Overview

ELKash ERP is a modular Enterprise Resource Planning (ERP) platform with integrated Point of Sale (POS) functionality designed for small and medium-sized food and beverage businesses.

The system is built with a modern separated frontend-backend architecture to support scalability, maintainability, and future business expansion.

Target businesses:

* Cafe
* Coffee Shop
* Restaurant
* Casual Dining

---

## Key Features

### POS Management

* Product Catalog
* Cart Management
* Checkout Process
* Payment Processing
* Invoice Generation
* Transaction History

### Inventory Management

* Product Management
* Category Management
* Stock Monitoring
* Stock Movement Tracking
* Supplier Management

### Dashboard

* Revenue Summary
* Sales Analytics
* Best Selling Products
* Low Stock Alerts
* Operational Statistics

### Reporting

* Daily Sales Reports
* Monthly Sales Reports
* Inventory Reports
* Cashier Performance Reports
* Export to PDF & Excel

### Authentication & Authorization

* Secure Login
* Session Management
* Role-Based Access Control (RBAC)

Supported Roles:

* Super Admin
* Admin
* Manager
* Cashier

---

## ERP Roadmap

### Version 1

Core Operations

* Authentication
* Dashboard
* POS
* Inventory
* Reporting
* User Management

### Version 2

Procurement Workflow

* Supplier Management
* Purchase Request (PR)
* Purchase Order (PO)
* Sales Order (SO)
* Approval Workflow

### Version 3

Financial Management

* Journal
* Ledger
* Profit & Loss
* Financial Statement
* Accounting Integration

---

## Technology Stack

### Frontend

* Nuxt 3
* Vue 3
* TypeScript
* Pinia
* TailwindCSS
* Shadcn Vue
* VueUse

### Backend

* Laravel
* Laravel Sanctum
* REST API
* Laravel Queue

### Database

* PostgreSQL (Supabase)

### Infrastructure

* Netlify (Frontend)
* VPS Ubuntu + Nginx (Backend)
* Redis (Optional)

---

## Project Architecture

### Frontend

```text
src/
├── modules/
├── components/
├── composables/
├── stores/
├── services/
├── middleware/
├── layouts/
└── pages/
```

### Backend

```text
app/
├── Modules/
├── Services/
├── Http/
├── Models/
├── Policies/
├── Jobs/
├── Events/
└── Actions/
```

---

## Business Flow

```text
Customer Order
        ↓
Cashier Input Transaction
        ↓
Cart Validation
        ↓
Checkout
        ↓
Payment
        ↓
Save Transaction
        ↓
Reduce Inventory
        ↓
Generate Receipt
        ↓
Update Reporting
```

---

## Development Status

### Completed

* Project Initialization
* Laravel Backend Setup
* Nuxt Frontend Setup
* Sanctum Authentication Foundation
* Database Schema Draft
* API Contract Draft
* BPMN Draft
* ERD Draft
* Inventory Service Foundation
* Stock Audit Trail Structure

### In Progress

* Authentication Module
* Inventory Module
* POS Module
* Dashboard Module

### Planned

* Purchasing Module
* Reporting Module
* Accounting Module

---

## Documentation

Project documentation includes:

* BRD
* PRD
* SRS
* BPMN
* ERD
* API Contract
* Database Schema

---

## Design Inspiration

* Odoo
* ERPNext
* SAP Fiori
* Midday
* Linear

---

## Development Principles

ELKash follows several engineering principles:

* Modular Architecture
* Clean Code
* Business Flow First
* Maintainability
* Scalability
* Enterprise-Oriented Design

Avoided intentionally:

* Premature Optimization
* Unnecessary Microservices
* Excessive Abstraction
* Feature-First Development

---

## Project Goal

Build a realistic and scalable ERP platform that can be used as:

* Portfolio Project
* Learning Project
* Real Business ERP Foundation

Primary focus:

> Business Process Integration, not Feature Quantity.

---

## Author

ELKash ERP Development Project

2026
