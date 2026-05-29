````md
# Software Requirement Specification (SRS)
# ELKash ERP System

Version: 1.0  
Status: Initial Draft  
System Type: Web-Based Modular ERP + POS  
Target Industry: Cafe, Coffee Shop, Small Restaurant  

---

# 1. Introduction

## 1.1 Purpose

Dokumen ini mendefinisikan spesifikasi teknis dan kebutuhan perangkat lunak untuk ELKash ERP System, termasuk:

- functional requirements
- non-functional requirements
- API behavior
- authentication mechanism
- validation rules
- database behavior
- module dependency
- system constraints
- technical architecture

Dokumen ini digunakan sebagai acuan utama pengembangan frontend, backend, database, testing, dan deployment.

---

## 1.2 Product Scope

ELKash merupakan modular ERP berbasis web dengan integrasi POS untuk bisnis cafe/resto skala kecil hingga menengah.

V1 mencakup:

- Authentication
- POS
- Inventory
- Dashboard
- Reporting

---

## 1.3 Definitions & Acronyms

| Term | Definition |
|---|---|
| ERP | Enterprise Resource Planning |
| POS | Point of Sale |
| RBAC | Role Based Access Control |
| API | Application Programming Interface |
| JWT | JSON Web Token |
| Sanctum | Laravel Authentication System |
| SSR | Server Side Rendering |
| KPI | Key Performance Indicator |

---

# 2. Overall Description

## 2.1 System Architecture

ELKash menggunakan:

- Nuxt 3 frontend
- Laravel REST API backend
- PostgreSQL database
- Optional Redis integration

### Architecture Flow

```txt
Nuxt Frontend
↓
Laravel REST API
↓
PostgreSQL (Supabase)
````

Authentication dipusatkan di Laravel backend menggunakan Sanctum.

---

## 2.2 User Roles

### Super Admin

Hak akses penuh terhadap seluruh sistem.

### Admin

Mengelola:

* produk
* inventory
* laporan

### Cashier

Mengelola:

* transaksi POS
* pembayaran
* invoice

### Manager

Mengakses:

* dashboard
* analytics
* reporting

---

## 2.3 Module Overview

| Module    | Description                |
| --------- | -------------------------- |
| Auth      | Authentication & RBAC      |
| POS       | Transaction processing     |
| Inventory | Product & stock management |
| Dashboard | Business analytics         |
| Reporting | Operational reporting      |

---

# 3. Functional Requirements

# 3.1 Authentication Module

## Features

* login
* logout
* RBAC
* protected routes
* session management

## Functional Requirements

| ID      | Requirement                                       |
| ------- | ------------------------------------------------- |
| AUTH-01 | User must login before accessing protected routes |
| AUTH-02 | Session managed using Laravel Sanctum             |
| AUTH-03 | Unauthorized users redirected to login            |
| AUTH-04 | Access validated using RBAC                       |
| AUTH-05 | Logout invalidates active session                 |

## Validation Rules

| Field    | Rule                  |
| -------- | --------------------- |
| email    | required, valid email |
| password | required, min 8 chars |

## Authentication Flow

```txt
User Login
↓
Frontend sends credentials
↓
Laravel validates credentials
↓
Sanctum session created
↓
Frontend receives authenticated session
↓
User permissions loaded
```

---

# 3.2 POS Module

## Features

* product grid
* search
* category filter
* cart
* checkout
* payment
* invoice
* transaction history

## Functional Requirements

| ID     | Requirement                               |
| ------ | ----------------------------------------- |
| POS-01 | Cashier can browse products               |
| POS-02 | Product search supports keyword filtering |
| POS-03 | Cart updates in real-time                 |
| POS-04 | Checkout blocked if stock unavailable     |
| POS-05 | Successful transaction reduces inventory  |
| POS-06 | Invoice generated after payment           |
| POS-07 | Transaction history searchable            |

## Business Rules

* Empty cart cannot checkout
* Stock validation mandatory
* Completed transaction immutable
* Failed payment must not reduce stock
* Duplicate checkout prohibited

## Checkout Flow

```txt
Select Product
↓
Add to Cart
↓
Validate Stock
↓
Checkout
↓
Payment Validation
↓
Save Transaction
↓
Reduce Inventory
↓
Generate Invoice
```

## Validation Rules

| Validation      | Behavior             |
| --------------- | -------------------- |
| stock <= 0      | block checkout       |
| empty cart      | reject transaction   |
| invalid payment | rollback transaction |

---

# 3.3 Inventory Module

## Features

* product management
* category management
* stock adjustment
* stock movement logs
* low stock monitoring

## Functional Requirements

| ID     | Requirement                              |
| ------ | ---------------------------------------- |
| INV-01 | Admin can create product                 |
| INV-02 | Admin can update stock                   |
| INV-03 | System records stock movement            |
| INV-04 | Low stock alerts generated automatically |
| INV-05 | Product deletion uses soft delete        |

## Inventory Rules

* Historical transactions must remain preserved
* Stock changes require audit logs
* Soft delete preferred
* Stock authority centralized in inventory module

## Stock Adjustment Flow

```txt
Admin updates stock
↓
Validate quantity
↓
Save stock adjustment
↓
Create stock movement log
↓
Update inventory state
```

---

# 3.4 Dashboard Module

## Features

* revenue summary
* sales chart
* best seller products
* low stock alerts
* transaction statistics

## Functional Requirements

| ID      | Requirement                  |
| ------- | ---------------------------- |
| DASH-01 | Display revenue summary      |
| DASH-02 | Display sales chart          |
| DASH-03 | Display low stock alerts     |
| DASH-04 | Display best seller products |

---

# 3.5 Reporting Module

## Features

* daily report
* monthly report
* inventory report
* cashier report
* PDF export
* Excel export

## Functional Requirements

| ID     | Requirement                   |
| ------ | ----------------------------- |
| REP-01 | Generate daily sales report   |
| REP-02 | Generate monthly sales report |
| REP-03 | Generate inventory report     |
| REP-04 | Export PDF                    |
| REP-05 | Export Excel                  |

## Reporting Rules

* Reports generated from transactional records
* Reporting data immutable
* Reports reproducible from historical data

---

# 4. API Specification

## 4.1 API Architecture

API principles:

* RESTful
* versioned
* modular
* standardized response structure

### Endpoint Format

```txt
/api/v1/auth
/api/v1/pos
/api/v1/inventory
/api/v1/reporting
```

---

## 4.2 API Response Standard

### Success Response

```json
{
  "success": true,
  "message": "Transaction created",
  "data": {}
}
```

### Error Response

```json
{
  "success": false,
  "message": "Stock unavailable",
  "errors": {}
}
```

---

## 4.3 Example API Endpoints

| Method | Endpoint              | Description        |
| ------ | --------------------- | ------------------ |
| POST   | /api/v1/auth/login    | Login              |
| POST   | /api/v1/auth/logout   | Logout             |
| GET    | /api/v1/products      | Get products       |
| POST   | /api/v1/transactions  | Create transaction |
| GET    | /api/v1/reports/daily | Daily report       |

---

# 5. Database Requirements

## 5.1 Core Tables

### Authentication

* users
* roles
* permissions
* role_permissions

### Inventory

* products
* categories
* stock_movements

### POS

* transactions
* transaction_items
* payments

---

## 5.2 Database Rules

* Transactions immutable after completion
* Product deletion uses soft delete
* Inventory updates logged
* Historical data preserved
* Foreign key constraints enforced

---

## 5.3 Transaction Integrity Rules

Database transaction required for:

* checkout process
* inventory deduction
* payment persistence

Rollback mandatory on failure.

---

# 6. Non-Functional Requirements

# 6.1 Performance

| Metric                   | Target           |
| ------------------------ | ---------------- |
| Checkout completion      | < 10 sec         |
| Dashboard load           | < 3 sec          |
| Inventory update latency | < 3 sec          |
| API response             | < 500 ms average |

---

# 6.2 Security

* Sanctum authentication
* Protected API endpoints
* RBAC validation
* Backend-only database access
* Rate limiting
* Session validation

---

# 6.3 Scalability

System must support:

* future ERP modules
* mobile integration
* background jobs
* queue processing
* reporting optimization

---

# 6.4 Maintainability

System architecture must support:

* modular development
* reusable services
* reusable components
* centralized validation
* typed API responses

---

# 7. Frontend Architecture

## Frontend Stack

* Nuxt 3
* Vue 3
* TypeScript
* Pinia
* TailwindCSS
* Shadcn Vue

## Frontend Structure

```txt
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

---

## State Management Rules

### Persistent State

* auth session
* theme
* sidebar preferences

### Temporary State

* cart
* filters
* modal state

---

# 8. Backend Architecture

## Backend Stack

* Laravel API
* Sanctum
* PostgreSQL
* Redis (optional)

## Backend Rules

* thin controller
* service layer
* centralized validation
* transaction-safe operations
* API resource standardization

---

# 9. Audit Requirements

System wajib mencatat:

* login activity
* failed login
* stock adjustment
* transaction cancellation
* permission changes
* inventory modification

Audit logs:

* immutable
* timestamped
* actor-traceable

---

# 10. Module Dependency

| Module    | Depends On      |
| --------- | --------------- |
| POS       | Auth, Inventory |
| Dashboard | POS, Inventory  |
| Reporting | POS, Inventory  |
| Inventory | Auth            |

---

# 11. Deployment Requirements

## Frontend

* Netlify
* auto deploy via GitHub
* preview deployment

## Backend

* Ubuntu VPS
* Nginx
* SSL Let's Encrypt
* Supervisor/PM2

---

# 12. Constraints

## Technical Constraints

* V1 excludes accounting
* Redis optional
* No websocket realtime sync
* No offline-first support

## Operational Constraints

* Requires internet connection
* Centralized server architecture
* Mobile workflow limited

---

# 13. Acceptance Criteria

## POS Checkout

### Given

* product stock = 0

### When

* cashier attempts checkout

### Then

* transaction blocked
* stock unavailable message shown
* inventory unchanged

---

## Unauthorized Access

### Given

* user unauthenticated

### When

* accessing protected route

### Then

* redirected to login
* protected content hidden

---

# 14. Engineering Philosophy

ELKash prioritizes:

1. Data consistency
2. Transaction reliability
3. Maintainability
4. Security
5. Scalability

The system intentionally avoids:

* overengineering
* premature microservices
* unnecessary AI features
* excessive infrastructure complexity

Primary focus:
Business process consistency and operational reliability.

```
```
