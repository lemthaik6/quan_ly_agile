# RESTful API Documentation

## Overview

This document provides comprehensive documentation for the RESTful API of the LEMTHAI Store admin panel. The API follows REST standards and returns JSON responses.

---

## Base URL

```
http://localhost/api
```

## Response Format

All responses follow this standard structure:

```json
{
    "success": true,
    "message": "Description of the action",
    "data": { /* Response data */ },
    "pagination": { /* For list endpoints only */ }
}
```

### Pagination Structure

```json
{
    "total": 100,
    "per_page": 15,
    "current_page": 1,
    "last_page": 7,
    "from": 1,
    "to": 15
}
```

---

## Authentication

### Protected Endpoints

All `/api/admin/*` endpoints require authentication using Laravel Sanctum tokens.

**Headers:**
```
Authorization: Bearer YOUR_ACCESS_TOKEN
Accept: application/json
```

### Public Endpoints

- `GET /api/user/products` - List all products (no auth required)
- `GET /api/user/products/{id}` - Get product details (no auth required)
- `GET /api/user/categories` - List all categories (no auth required)
- `GET /api/user/categories/{id}` - Get category details (no auth required)

---

## API Endpoints

### PRODUCTS

#### 1. List Products (Public)

```
GET /api/user/products
```

**Query Parameters:**
- `search` (string) - Search by product name or SKU
- `category` (integer) - Filter by category ID
- `active` (boolean) - Filter by active status
- `featured` (boolean) - Filter by featured status
- `sort` (string) - Field to sort by (default: created_at)
- `order` (string) - Sort order: asc or desc (default: desc)
- `per_page` (integer) - Items per page (default: 15)

**Example Request:**
```bash
curl -X GET "http://localhost/api/user/products?search=laptop&category=1&per_page=10" \
  -H "Accept: application/json"
```

**Response (200 OK):**
```json
{
    "success": true,
    "message": "Products retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Dell Laptop",
            "description": "...",
            "price": 15000000,
            "cost_price": 12000000,
            "quantity_in_stock": 50,
            "sku": "DELL-001",
            "is_featured": true,
            "is_active": true,
            "slug": "dell-laptop",
            "category_id": 1,
            "category": {
                "id": 1,
                "name": "Computers",
                "slug": "computers"
            },
            "created_at": "2026-01-15T10:30:00Z",
            "updated_at": "2026-01-15T10:30:00Z"
        }
    ],
    "pagination": {
        "total": 100,
        "per_page": 10,
        "current_page": 1,
        "last_page": 10,
        "from": 1,
        "to": 10
    }
}
```

---

#### 2. Get Product Details (Public)

```
GET /api/user/products/{id}
```

**Example Request:**
```bash
curl -X GET "http://localhost/api/user/products/1" \
  -H "Accept: application/json"
```

**Response (200 OK):**
```json
{
    "success": true,
    "message": "Product retrieved successfully",
    "data": {
        "id": 1,
        "name": "Dell Laptop",
        "description": "High-performance laptop",
        "price": 15000000,
        "cost_price": 12000000,
        "quantity_in_stock": 50,
        "sku": "DELL-001",
        "is_featured": true,
        "is_active": true,
        "slug": "dell-laptop",
        "category_id": 1,
        "category": {
            "id": 1,
            "name": "Computers"
        },
        "created_at": "2026-01-15T10:30:00Z",
        "updated_at": "2026-01-15T10:30:00Z"
    }
}
```

---

#### 3. Create Product (Admin)

```
POST /api/admin/products
```

**Headers:**
```
Authorization: Bearer YOUR_ACCESS_TOKEN
Content-Type: application/json
Accept: application/json
```

**Request Body:**
```json
{
    "category_id": 1,
    "name": "iPhone 15 Pro",
    "description": "Latest Apple smartphone",
    "short_description": "Pro smartphone",
    "price": 30000000,
    "cost_price": 25000000,
    "discount_price": null,
    "quantity_in_stock": 100,
    "sku": "IPHONE-15-PRO",
    "is_featured": true,
    "is_active": true
}
```

**Example Request:**
```bash
curl -X POST "http://localhost/api/admin/products" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "category_id": 1,
    "name": "iPhone 15 Pro",
    "price": 30000000,
    "quantity_in_stock": 100
  }'
```

**Response (201 Created):**
```json
{
    "success": true,
    "message": "Product created successfully",
    "data": {
        "id": 2,
        "name": "iPhone 15 Pro",
        "description": "Latest Apple smartphone",
        "price": 30000000,
        "cost_price": 25000000,
        "quantity_in_stock": 100,
        "sku": "IPHONE-15-PRO",
        "is_featured": true,
        "is_active": true,
        "slug": "iphone-15-pro",
        "category_id": 1,
        "category": {
            "id": 1,
            "name": "Electronics"
        },
        "created_at": "2026-03-14T10:30:00Z",
        "updated_at": "2026-03-14T10:30:00Z"
    }
}
```

---

#### 4. Update Product (Admin)

```
PUT /api/admin/products/{id}
PATCH /api/admin/products/{id}
```

**Headers:**
```
Authorization: Bearer YOUR_ACCESS_TOKEN
Content-Type: application/json
Accept: application/json
```

**Request Body:**
```json
{
    "name": "iPhone 15 Pro Max",
    "price": 35000000,
    "quantity_in_stock": 80
}
```

**Example Request:**
```bash
curl -X PUT "http://localhost/api/admin/products/1" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "iPhone 15 Pro Max",
    "price": 35000000,
    "quantity_in_stock": 80
  }'
```

**Response (200 OK):**
```json
{
    "success": true,
    "message": "Product updated successfully",
    "data": { /* Updated product */ }
}
```

---

#### 5. Delete Product (Admin)

```
DELETE /api/admin/products/{id}
```

**Example Request:**
```bash
curl -X DELETE "http://localhost/api/admin/products/1" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

**Response (200 OK):**
```json
{
    "success": true,
    "message": "Product deleted successfully",
    "data": null
}
```

---

#### 6. Toggle Product Active Status (Admin)

```
POST /api/admin/products/{id}/toggle-active
```

**Example Request:**
```bash
curl -X POST "http://localhost/api/admin/products/1/toggle-active" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

**Response (200 OK):**
```json
{
    "success": true,
    "message": "Product status toggled successfully",
    "data": {
        "id": 1,
        "is_active": false,
        "updated_at": "2026-03-14T10:30:00Z"
    }
}
```

---

#### 7. Toggle Product Featured Status (Admin)

```
POST /api/admin/products/{id}/toggle-featured
```

**Example Request:**
```bash
curl -X POST "http://localhost/api/admin/products/1/toggle-featured" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

---

### CATEGORIES

#### 1. List Categories (Public)

```
GET /api/user/categories
```

**Query Parameters:**
- `search` (string) - Search by category name
- `active` (boolean) - Filter by active status
- `sort` (string) - Field to sort by (default: display_order)
- `order` (string) - Sort order: asc or desc (default: asc)
- `per_page` (integer) - Items per page (default: 20)

**Example Request:**
```bash
curl -X GET "http://localhost/api/user/categories?search=computer" \
  -H "Accept: application/json"
```

---

#### 2. Get Category Details (Public)

```
GET /api/user/categories/{id}
```

---

#### 3. Create Category (Admin)

```
POST /api/admin/categories
```

**Request Body:**
```json
{
    "name": "Gaming Laptops",
    "description": "High-performance gaming laptops",
    "is_active": true,
    "display_order": 1
}
```

---

#### 4. Update Category (Admin)

```
PUT /api/admin/categories/{id}
PATCH /api/admin/categories/{id}
```

---

#### 5. Delete Category (Admin)

```
DELETE /api/admin/categories/{id}
```

**Note:** Cannot delete categories with products

---

#### 6. Toggle Category Active Status (Admin)

```
POST /api/admin/categories/{id}/toggle-active
```

---

### ORDERS

#### 1. List Orders (Admin)

```
GET /api/admin/orders
```

**Query Parameters:**
- `search` (string) - Search by order number or customer name
- `status` (string) - Filter by order status (pending, processing, shipped, delivered, cancelled)
- `payment_status` (string) - Filter by payment status (pending, completed, failed, refunded)
- `sort` (string) - Field to sort by (default: created_at)
- `order` (string) - Sort order: asc or desc (default: desc)
- `per_page` (integer) - Items per page (default: 15)

**Example Request:**
```bash
curl -X GET "http://localhost/api/admin/orders?status=pending&per_page=20" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

**Response (200 OK):**
```json
{
    "success": true,
    "message": "Orders retrieved successfully",
    "data": [
        {
            "id": 1,
            "order_number": "ORD-001",
            "user_id": 5,
            "user": {
                "id": 5,
                "name": "John Doe",
                "email": "john@example.com",
                "phone": "0909123456"
            },
            "total_price": 50000000,
            "order_status": "pending",
            "payment_status": "pending",
            "payment_method": "credit_card",
            "shipping_address": "123 Main St, City",
            "shipping_city": "Ho Chi Minh",
            "shipping_zip": "700000",
            "shipping_cost": 50000,
            "items": [
                {
                    "id": 1,
                    "product_id": 1,
                    "quantity": 2,
                    "price": 15000000,
                    "product": {
                        "id": 1,
                        "name": "Dell Laptop",
                        "sku": "DELL-001"
                    }
                }
            ],
            "tracking": null,
            "created_at": "2026-03-14T10:30:00Z",
            "updated_at": "2026-03-14T10:30:00Z"
        }
    ],
    "pagination": { /* ... */ }
}
```

---

#### 2. Get Order Details (Admin)

```
GET /api/admin/orders/{id}
```

**Example Request:**
```bash
curl -X GET "http://localhost/api/admin/orders/1" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

---

#### 3. Update Order Status (Admin)

```
POST /api/admin/orders/{id}/update-status
```

**Request Body:**
```json
{
    "order_status": "processing"
}
```

**Allowed Statuses:**
- `pending` - Pending confirmation
- `processing` - Being processed
- `shipped` - Shipped to customer
- `delivered` - Delivered to customer
- `cancelled` - Order cancelled

**Example Request:**
```bash
curl -X POST "http://localhost/api/admin/orders/1/update-status" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"order_status": "processing"}'
```

---

#### 4. Update Payment Status (Admin)

```
POST /api/admin/orders/{id}/update-payment-status
```

**Request Body:**
```json
{
    "payment_status": "completed"
}
```

**Allowed Statuses:**
- `pending`
- `completed`
- `failed`
- `refunded`

---

#### 5. Cancel Order (Admin)

```
POST /api/admin/orders/{id}/cancel
```

**Example Request:**
```bash
curl -X POST "http://localhost/api/admin/orders/1/cancel" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

**Note:** Cannot cancel delivered orders

---

#### 6. Export Order (Admin)

```
GET /api/admin/orders/{id}/export
```

---

### REPORTS

#### 1. Get Dashboard Statistics (Admin)

```
GET /api/admin/dashboard
```

**Response:**
```json
{
    "success": true,
    "message": "Dashboard data retrieved successfully",
    "data": {
        "total_revenue": 500000000,
        "month_revenue": 150000000,
        "today_revenue": 5000000,
        "total_orders": 250,
        "total_customers": 80,
        "total_products": 150
    }
}
```

---

#### 2. Get Detailed Reports (Admin)

```
GET /api/admin/reports
```

**Query Parameters:**
- `start_date` (date) - Start date (Y-m-d format)
- `end_date` (date) - End date (Y-m-d format)

**Default:** Last 30 days

**Example Request:**
```bash
curl -X GET "http://localhost/api/admin/reports?start_date=2026-01-01&end_date=2026-03-14" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

**Response:**
```json
{
    "success": true,
    "message": "Reports data retrieved successfully",
    "data": {
        "revenue": 300000000,
        "revenue_orders": 75,
        "total_orders": 100,
        "canceled_orders": 5,
        "new_customers": 25,
        "top_products": [
            {
                "id": 1,
                "name": "Dell Laptop",
                "order_items_count": 50
            }
        ],
        "daily_revenue": [
            {
                "date": "2026-03-14",
                "orders": 10,
                "revenue": 100000000
            }
        ],
        "orders_by_status": [
            {
                "order_status": "delivered",
                "count": 75
            }
        ],
        "payment_methods": [
            {
                "payment_method": "credit_card",
                "count": 80
            }
        ],
        "start_date": "2026-01-01",
        "end_date": "2026-03-14"
    }
}
```

---

#### 3. Export Reports (Admin)

```
GET /api/admin/reports/export
```

---

## Error Responses

### Validation Error (422)

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "name": ["The name field is required."],
        "price": ["The price must be a number."]
    }
}
```

### Unauthorized (401)

```json
{
    "message": "Unauthenticated."
}
```

### Forbidden (403)

```json
{
    "message": "Unauthorized."
}
```

### Not Found (404)

```json
{
    "success": false,
    "message": "Resource not found."
}
```

### Conflict Error (409)

```json
{
    "success": false,
    "message": "Cannot delete category with products"
}
```

---

## Testing with Postman

### 1. Create Postman Collection

1. Open Postman
2. Click **Create New** → **Collection**
3. Name it `LEMTHAI API`
4. Click **Create**

### 2. Add Environment Variables

1. Click **Environments** → **Create New**
2. Add these variables:
   - `base_url`: `http://localhost/api`
   - `token`: (Get from login endpoint)
   - `product_id`: `1`
   - `category_id`: `1`
   - `order_id`: `1`

### 3. Add Requests

#### Get Products
- **Method:** GET
- **URL:** `{{base_url}}/user/products?per_page=10`
- **Headers:** Accept: application/json

#### Create Product (Admin)
- **Method:** POST
- **URL:** `{{base_url}}/admin/products`
- **Headers:** 
  - Authorization: Bearer {{token}}
  - Content-Type: application/json
- **Body:**
```json
{
    "category_id": 1,
    "name": "New Product",
    "price": 1000000,
    "quantity_in_stock": 10
}
```

#### Update Order Status
- **Method:** POST
- **URL:** `{{base_url}}/admin/orders/{{order_id}}/update-status`
- **Headers:** 
  - Authorization: Bearer {{token}}
  - Content-Type: application/json
- **Body:**
```json
{
    "order_status": "processing"
}
```

### 4. Test Endpoints

1. Select a request from the collection
2. Click **Send**
3. View the response

---

## Pagination Example

When requesting a list endpoint:

```bash
curl -X GET "http://localhost/api/admin/products?page=2&per_page=10" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

Response includes pagination info:
```json
{
    "pagination": {
        "total": 150,
        "per_page": 10,
        "current_page": 2,
        "last_page": 15,
        "from": 11,
        "to": 20
    }
}
```

---

## Rate Limiting

- No rate limiting implemented by default
- Recommended: Add Laravel rate limiting middleware as needed

---

## API Version

Current API Version: **1.0**

Base URL: `/api/v1` (future proofing)

---

## Support

For issues or questions, please refer to the Laravel and REST API documentation.
