# Supervisor Role Assignment Guide

## Prerequisites
- Run migrations and seeders:
  - `php artisan migrate`
  - `php artisan db:seed --class=RolePermissionSeeder`

## Assigning Supervisor Role (User Maintenance UI)
1. Log in as an admin user.
2. Go to `Admin > User Maintenance`.
3. Click `Add User` (or open an existing user and click `Edit`).
4. Set `System Role` / `Role` to `Supervisor`.
5. Save.

The system will:
- update the user's legacy `users.role` column to `supervisor`
- sync the `role_user` pivot table with the `supervisor` role

## Expected Supervisor Access
- Allowed: Dashboard, Product Maintenance, Supplier Maintenance, Inventory, Sales, Reports
  - Excluded from Product Maintenance: Units of Measure, Variations
  - Excluded from Supplier Maintenance: Payment Terms
- Denied: User Maintenance, System

Unauthorized access attempts to denied routes return HTTP `403`.
