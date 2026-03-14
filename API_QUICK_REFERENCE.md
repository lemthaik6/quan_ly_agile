# API Quick Reference Card

## 🚀 Base URL
```
http://localhost:8000/api
```

## 🔑 Authentication
```bash
Authorization: Bearer YOUR_TOKEN_HERE
Content-Type: application/json
Accept: application/json
```

---

## 📦 PRODUCTS API

### List (Public)
```bash
GET /user/products?search=&category=&active=&featured=&sort=created_at&order=desc&per_page=15
```

### Get Detail (Public)
```bash
GET /user/products/{id}
```

### List (Admin)
```bash
GET /admin/products
```

### Create
```bash
POST /admin/products
{
  "category_id": 1,
  "name": "Product Name",
  "price": 1000000,
  "quantity_in_stock": 10
}
```

### Update
```bash
PUT /admin/products/{id}
{
  "name": "Updated Name",
  "price": 1100000
}
```

### Delete
```bash
DELETE /admin/products/{id}
```

### Toggle Active
```bash
POST /admin/products/{id}/toggle-active
```

### Toggle Featured
```bash
POST /admin/products/{id}/toggle-featured
```

---

## 📁 CATEGORIES API

### List (Public)
```bash
GET /user/categories?search=&active=&sort=display_order&order=asc&per_page=20
```

### Get Detail (Public)
```bash
GET /user/categories/{id}
```

### List (Admin)
```bash
GET /admin/categories
```

### Create
```bash
POST /admin/categories
{
  "name": "Category Name",
  "description": "Description",
  "is_active": true,
  "display_order": 1
}
```

### Update
```bash
PUT /admin/categories/{id}
{
  "name": "Updated Name"
}
```

### Delete
```bash
DELETE /admin/categories/{id}
```

### Toggle Active
```bash
POST /admin/categories/{id}/toggle-active
```

---

## 📋 ORDERS API

### List
```bash
GET /admin/orders?search=&status=&payment_status=&sort=created_at&order=desc&per_page=15
```

Status values: `pending`, `processing`, `shipped`, `delivered`, `cancelled`

Payment values: `pending`, `completed`, `failed`, `refunded`

### Get Detail
```bash
GET /admin/orders/{id}
```

### Update Status
```bash
POST /admin/orders/{id}/update-status
{
  "order_status": "processing"
}
```

### Update Payment Status
```bash
POST /admin/orders/{id}/update-payment-status
{
  "payment_status": "completed"
}
```

### Cancel
```bash
POST /admin/orders/{id}/cancel
```

### Export
```bash
GET /admin/orders/{id}/export
```

---

## 📊 REPORTS API

### Dashboard
```bash
GET /admin/dashboard
```

Response:
```json
{
  "total_revenue": 0,
  "month_revenue": 0,
  "today_revenue": 0,
  "total_orders": 0,
  "total_customers": 0,
  "total_products": 0
}
```

### Reports
```bash
GET /admin/reports?start_date=2026-01-01&end_date=2026-03-14
```

### Export Reports
```bash
GET /admin/reports/export?start_date=2026-01-01&end_date=2026-03-14
```

---

## ✅ HTTP Methods

| Method | CRUD | Used For |
|--------|------|----------|
| GET | Read | Retrieving data |
| POST | Create | Creating new resources |
| PUT | Update | Replacing full resource |
| PATCH | Update | Partial update (not used here) |
| DELETE | Delete | Removing resources |

---

## 📊 Response Structure

### Success (200, 201)
```json
{
  "success": true,
  "message": "Description",
  "data": { /* resource */ },
  "pagination": { /* optional */ }
}
```

### Error (4xx, 5xx)
```json
{
  "success": false,
  "message": "Error description",
  "errors": { /* optional validation errors */ }
}
```

---

## 🧪 Quick cURL Examples

### Get Products
```bash
curl "http://localhost:8000/api/user/products" \
  -H "Accept: application/json"
```

### Create Product
```bash
curl -X POST "http://localhost:8000/api/admin/products" \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"category_id":1,"name":"Test","price":1000000,"quantity_in_stock":10}'
```

### Get Orders
```bash
curl "http://localhost:8000/api/admin/orders?status=pending" \
  -H "Authorization: Bearer TOKEN" \
  -H "Accept: application/json"
```

### Update Order Status
```bash
curl -X POST "http://localhost:8000/api/admin/orders/1/update-status" \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"order_status":"processing"}'
```

---

## 📱 JavaScript Fetch Examples

### Get Products
```javascript
fetch('http://localhost:8000/api/user/products')
  .then(r => r.json())
  .then(d => console.log(d.data));
```

### Create Product
```javascript
fetch('http://localhost:8000/api/admin/products', {
  method: 'POST',
  headers: {
    'Authorization': 'Bearer TOKEN',
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    category_id: 1,
    name: 'Product',
    price: 1000000,
    quantity_in_stock: 10
  })
})
.then(r => r.json())
.then(d => console.log(d.data));
```

---

## 🔐 Query Parameters

### Common Filters
- `search` - Search by name
- `sort` - Field to sort by
- `order` - `asc` or `desc`
- `per_page` - Items per page
- `page` - Page number

### Product Filters
- `category` - Category ID
- `active` - boolean
- `featured` - boolean

### Order Filters
- `status` - Order status
- `payment_status` - Payment status

### Report Filters
- `start_date` - YYYY-MM-DD
- `end_date` - YYYY-MM-DD

---

## 🎯 Common Validation Rules

| Field | Rules |
|-------|-------|
| name | required, max:255, unique |
| category_id | required, exists in categories |
| price | required, numeric, min:0 |
| quantity_in_stock | required, integer, min:0 |
| sku | unique, max:100 |
| order_status | in: pending, processing, shipped, delivered, cancelled |
| payment_status | in: pending, completed, failed, refunded |

---

## 📍 Status Codes

| Code | Meaning |
|------|---------|
| 200 | OK |
| 201 | Created |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 409 | Conflict |
| 422 | Validation Error |
| 500 | Server Error |

---

## 🧠 Pagination

Request:
```bash
GET /api/products?page=2&per_page=20
```

Response includes:
```json
{
  "pagination": {
    "total": 150,
    "per_page": 20,
    "current_page": 2,
    "last_page": 8,
    "from": 21,
    "to": 40
  }
}
```

---

## 🆘 Troubleshooting

| Issue | Solution |
|-------|----------|
| 401 Unauthorized | Add `Authorization: Bearer TOKEN` header |
| 403 Forbidden | User must be admin |
| 404 Not Found | Resource ID doesn't exist |
| 422 Validation | Check error message for invalid fields |
| CORS Error | Configure CORS in config/cors.php |

---

## 🚀 Ready to Go!

Print this card or bookmark for quick reference while developing.

For detailed info, see: `API_DOCUMENTATION.md`
For testing examples, see: `API_TESTING_GUIDE.md`
