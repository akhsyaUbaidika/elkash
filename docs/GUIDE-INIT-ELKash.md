# ELKash ERP Documentation Initialization Guide

## Integrated Version (Merged with Stack & Infrastructure Update)

> Dokumen ini merupakan penggabungan penuh dari:
>
> - `ELKash ERP Documentation Initialization Guide`
> - `ELKash ERP - Stack & Infrastructure Update`
>
> Tanpa mengurangi isi sama sekali.

---

# Project Overview

ELKash adalah web-based ERP modular dengan integrasi POS untuk bisnis cafe/resto skala kecil hingga menengah.

Nama ELKash berasal dari:

- EL → ELghozi
- Kash → Cash

Awalnya sistem direncanakan sebagai POS, namun dikembangkan menjadi modular ERP system yang scalable.

---

# Main Objective

Membangun ERP modular modern berbasis:

- Nuxt 3
- TypeScript
- TailwindCSS
- Pinia
- Laravel API Backend

Dengan fokus:

- clean architecture
- business workflow
- modular system
- realistic enterprise flow

---

# ERP Scope

## Versioning Plan

### V1

Focus:

- POS
- Inventory
- Dashboard
- Reporting
- Authentication
- User Management

---

### V2

Focus:

- Purchasing
- Supplier
- Purchase Request (PR)
- Purchase Order (PO)
- Sales Order (SO)
- Approval Workflow

---

### V3

Focus:

- Accounting
- Journal
- Ledger
- Profit/Loss
- Financial Statement

---

# Modular Architecture

Setiap domain bisnis dipisah menjadi module independen.

Contoh:

```txt
modules/
├── auth/
├── dashboard/
├── pos/
├── inventory/
├── purchasing/
├── reporting/
├── employee/
└── accounting/
```

Setiap module memiliki:

- pages
- components
- composables
- services
- stores
- types
- API handlers

---

# Documentation Targets

AI diminta membantu membuat dokumen berikut secara bertahap:

1. BRD (Business Requirement Document)
2. PRD (Product Requirement Document)
3. SRS (Software Requirement Specification)
4. BPMN (Business Process Model and Notation)
5. ERD (Entity Relationship Diagram)
6. API Contract Draft
7. Database Schema Draft

---

# Business Domain

Sistem difokuskan untuk:

- cafe
- coffee shop
- small restaurant
- casual dining

Menu memiliki:

- beverages
- foods
- rice bowl
- snacks
- availability status
- pricing
- favorite products

---

# Main Business Flow

## POS Flow

```txt
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

# Required Modules

## Auth Module

### Features:

- login
- logout
- RBAC
- session management

### Roles:

- Super Admin
- Admin
- Cashier
- Manager

---

## POS Module

### Features:

- product grid
- cart
- checkout
- payment
- invoice
- transaction history

---

## Inventory Module

### Features:

- product management
- stock management
- stock movement
- category management
- supplier relation

---

## Dashboard Module

### Features:

- revenue summary
- sales chart
- low stock alert
- best seller product
- transaction statistics

---

## Reporting Module

### Features:

- daily sales
- monthly sales
- inventory report
- cashier report

### Export:

- PDF
- Excel

---

# Architecture Decision

ELKash menggunakan:

- separated frontend-backend architecture
- REST API communication
- modular ERP architecture

Frontend dan backend dipisahkan untuk:

- scalability
- deployment flexibility
- maintainability
- future mobile integration

---

# Final Technology Stack

## Frontend

| Technology | Purpose |
|---|---|
| Nuxt 3 | Frontend Framework |
| Vue 3 | UI Framework |
| TypeScript | Type Safety |
| Pinia | State Management |
| TailwindCSS | Styling |
| Shadcn Vue | UI Components |
| VueUse | Utility Composables |

---

## Backend

### Main Backend Stack

| Technology | Purpose |
|---|---|
| Laravel | REST API Backend |
| Laravel Sanctum | Authentication |
| PostgreSQL (Supabase) | Main Database |
| Redis (Optional) | Cache / Queue / Session |
| Laravel Queue | Background Jobs |

---

# Deployment Infrastructure

## Frontend Deployment

| Service | Purpose |
|---|---|
| Netlify | Frontend Hosting |

Frontend deployment harus:

- auto deploy from GitHub
- support environment variables
- support preview deployment

---

## Backend Deployment

Backend deployment diputuskan sejak awal agar arsitektur stabil.

### Recommended options:

- VPS Ubuntu + Nginx
- Laravel Forge
- Railway
- Render

AI diminta memilih satu deployment strategy utama dan konsisten pada seluruh dokumentasi.

### Recommended default:

- VPS Ubuntu + Nginx
- PM2/Supervisor
- SSL via Let's Encrypt

### Reason:

- realistic production architecture
- scalable
- suitable for ERP backend
- easier Redis integration

---

# Database Decision

## Database Provider

| Service | Usage |
|---|---|
| Supabase | Managed PostgreSQL |

Supabase digunakan hanya sebagai:

- PostgreSQL provider
- storage (optional)
- realtime feature (future optional)

Authentication tetap menggunakan:

- Laravel Sanctum

Karena:

- backend authority tetap di Laravel
- ERP business logic centralized
- lebih clean untuk enterprise architecture

---

# Authentication Architecture

## Authentication Flow

```txt
Nuxt Frontend
↓
Laravel Sanctum API
↓
PostgreSQL (Supabase)
```

### Rules:

- authentication handled by Laravel
- frontend never directly accesses auth database
- API protected using Sanctum
- session/cookie based auth preferred

---

# Redis Usage Policy

Redis bersifat optional untuk V1.

## Use Redis only if needed for:

- caching dashboard statistics
- queue system
- background jobs
- session optimization
- rate limiting

## Avoid:

- premature optimization
- unnecessary event complexity

---

# Backend Architecture Rules

Backend harus menggunakan:

- service layer
- repository pattern (optional)
- API resource standardization
- centralized validation
- modular folder structure

## Recommended structure:

```txt
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

# Frontend Architecture Rules

Frontend harus:

- modular
- scalable
- SSR friendly
- composable-based

## Recommended structure:

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

# API Design Rules

API harus:

- RESTful
- versioned
- modular
- documented

## Example:

```txt
/api/v1/auth
/api/v1/pos
/api/v1/inventory
/api/v1/reports
```

---

# Queue & Background Jobs

Future-compatible architecture harus mempertimbangkan:

- Background Jobs
- invoice generation
- report export
- activity logging
- notification system

## Use:

- Laravel Queue
- Redis driver

Only implement in V2+ if truly needed.

---

# Environment Strategy

## Development

- local frontend
- local backend
- cloud Supabase DB

---

## Staging

- preview deployment
- separate env

---

## Production

- Netlify frontend
- VPS backend
- Supabase PostgreSQL
- Redis optional

---

# ERP Engineering Philosophy

ELKash should prioritize:

- business flow integrity
- modularity
- maintainability
- realistic enterprise architecture

## Avoid:

- unnecessary microservices
- overengineering
- excessive abstraction
- feature-first development

Primary focus:

> Business process synchronization between modules.

---

# Technology Stack

## Frontend

- Nuxt 3
- Vue 3
- TypeScript
- Pinia
- TailwindCSS
- Shadcn Vue

---

## Backend

- Laravel API
- MySQL/PostgreSQL
- JWT/Sanctum Auth

---

# Documentation Generation Rules

Saat membuat dokumentasi:

## Focus on:

- realistic business flow
- scalable architecture
- modular approach
- clean data relation
- enterprise-like workflow

## Avoid:

- overengineering
- unnecessary AI features
- blockchain/web3 integration
- microservices complexity
- premature accounting implementation

---

# BRD Generation Instructions

BRD harus berisi:

- business background
- business problem
- business goals
- target users
- operational workflow
- expected business impact

---

# PRD Generation Instructions

PRD harus berisi:

- feature scope
- module breakdown
- UI requirements
- functional requirements
- non-functional requirements
- user flow
- release scope

---

# SRS Generation Instructions

SRS harus berisi:

- technical specification
- API behavior
- validation rules
- authentication flow
- database behavior
- system constraints
- module dependencies

---

# BPMN Generation Instructions

BPMN harus dibuat untuk:

- POS transaction flow
- inventory adjustment flow
- purchasing flow
- approval flow
- reporting flow

Gunakan:

- actor
- decision
- process
- approval
- database activity

---

# ERD Instructions

## Minimal entities:

- users
- roles
- permissions
- products
- categories
- transactions
- transaction_items
- suppliers
- stock_movements

## Relasi harus:

- normalized
- scalable
- suitable for ERP architecture

---

# UI/UX Direction

## Style:

- modern dashboard
- enterprise minimalism
- responsive
- dark/light mode

## Inspirations:

- Odoo
- ERPNext
- SAP Fiori
- Midday
- Linear

---

# Final Goal

Sistem harus:

- terlihat professional
- realistic untuk bisnis
- layak dijadikan portfolio utama
- scalable untuk future ERP expansion

## Fokus utama:

> Business process integration, not feature quantity.