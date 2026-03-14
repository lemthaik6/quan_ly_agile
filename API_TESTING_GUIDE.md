# API Testing Guide

## Quick Start

### 1. Setup Sanctum Authentication (if not already done)

```bash
php artisan install
```

Configure Sanctum in your `.env`:
```
SANCTUM_STATEFUL_DOMAINS=localhost,localhost:3000,127.0.0.1:8000
SESSION_DOMAIN=localhost
```

### 2. Create API Token

```bash
php artisan tinker
```

Then in Tinker:
```php
$user = App\Models\User::find(1); // Use admin user
$user->createToken('api-token')->plainTextToken;
```

Copy the token for API requests.

---

## Testing with cURL

### 1. List Products (Public)

```bash
curl -X GET "http://localhost:8000/api/user/products" \
  -H "Accept: application/json"
```

### 2. List Products with Search

```bash
curl -X GET "http://localhost:8000/api/user/products?search=laptop&per_page=10" \
  -H "Accept: application/json"
```

### 3. Get Single Product

```bash
curl -X GET "http://localhost:8000/api/user/products/1" \
  -H "Accept: application/json"
```

### 4. Create Product (Admin)

```bash
curl -X POST "http://localhost:8000/api/admin/products" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "category_id": 1,
    "name": "New Laptop Model",
    "description": "Powerful laptop for gaming",
    "price": 20000000,
    "cost_price": 17000000,
    "quantity_in_stock": 50,
    "sku": "LAPTOP-NEW-001",
    "is_featured": true,
    "is_active": true
  }'
```

### 5. Update Product

```bash
curl -X PUT "http://localhost:8000/api/admin/products/1" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Updated Laptop Model",
    "price": 21000000,
    "quantity_in_stock": 45
  }'
```

### 6. Delete Product

```bash
curl -X DELETE "http://localhost:8000/api/admin/products/1" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

### 7. Toggle Product Active Status

```bash
curl -X POST "http://localhost:8000/api/admin/products/1/toggle-active" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

### 8. List Categories

```bash
curl -X GET "http://localhost:8000/api/user/categories" \
  -H "Accept: application/json"
```

### 9. Create Category

```bash
curl -X POST "http://localhost:8000/api/admin/categories" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Gaming Peripherals",
    "description": "Mice, keyboards, headsets",
    "is_active": true,
    "display_order": 5
  }'
```

### 10. List Orders

```bash
curl -X GET "http://localhost:8000/api/admin/orders" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

### 11. List Orders (Filtered)

```bash
curl -X GET "http://localhost:8000/api/admin/orders?status=pending&per_page=20" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

### 12. Get Single Order

```bash
curl -X GET "http://localhost:8000/api/admin/orders/1" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

### 13. Update Order Status

```bash
curl -X POST "http://localhost:8000/api/admin/orders/1/update-status" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "order_status": "processing"
  }'
```

### 14. Update Payment Status

```bash
curl -X POST "http://localhost:8000/api/admin/orders/1/update-payment-status" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "payment_status": "completed"
  }'
```

### 15. Cancel Order

```bash
curl -X POST "http://localhost:8000/api/admin/orders/1/cancel" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

### 16. Get Dashboard Statistics

```bash
curl -X GET "http://localhost:8000/api/admin/dashboard" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

### 17. Get Reports (Date Range)

```bash
curl -X GET "http://localhost:8000/api/admin/reports?start_date=2026-01-01&end_date=2026-03-14" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

---

## Testing with Postman

### 1. Import Collection

1. Click **File** → **New**
2. Create a new collection
3. Add requests manually or import JSON

### 2. Environment Setup

Create environment with these variables:
```json
{
  "base_url": "http://localhost:8000/api",
  "token": "YOUR_TOKEN_HERE",
  "product_id": "1",
  "category_id": "1",
  "order_id": "1"
}
```

### 3. Sample Requests in Postman

#### Get Products (Public)
```
GET {{base_url}}/user/products
```

#### Create Product (Admin)
```
POST {{base_url}}/admin/products
Headers:
  Authorization: Bearer {{token}}
  Content-Type: application/json

Body (raw JSON):
{
  "category_id": 1,
  "name": "Test Product",
  "price": 1000000,
  "quantity_in_stock": 10
}
```

#### Update Order Status
```
POST {{base_url}}/admin/orders/{{order_id}}/update-status
Headers:
  Authorization: Bearer {{token}}
  Content-Type: application/json

Body (raw JSON):
{
  "order_status": "processing"
}
```

---

## Testing with JavaScript (Fetch API)

### 1. Get Products

```javascript
fetch('http://localhost:8000/api/user/products', {
  method: 'GET',
  headers: {
    'Accept': 'application/json'
  }
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

### 2. Create Product (Admin)

```javascript
const token = 'YOUR_TOKEN_HERE';

fetch('http://localhost:8000/api/admin/products', {
  method: 'POST',
  headers: {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  },
  body: JSON.stringify({
    category_id: 1,
    name: 'Test Laptop',
    description: 'A test laptop',
    price: 20000000,
    quantity_in_stock: 50,
    sku: 'TEST-LAPTOP-001',
    is_featured: true,
    is_active: true
  })
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

### 3. Update Product

```javascript
const token = 'YOUR_TOKEN_HERE';
const productId = 1;

fetch(`http://localhost:8000/api/admin/products/${productId}`, {
  method: 'PUT',
  headers: {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  },
  body: JSON.stringify({
    name: 'Updated Product Name',
    price: 25000000,
    quantity_in_stock: 40
  })
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

### 4. Delete Product

```javascript
const token = 'YOUR_TOKEN_HERE';
const productId = 1;

fetch(`http://localhost:8000/api/admin/products/${productId}`, {
  method: 'DELETE',
  headers: {
    'Authorization': `Bearer ${token}`,
    'Accept': 'application/json'
  }
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

### 5. List Orders with Filters

```javascript
const token = 'YOUR_TOKEN_HERE';

const filters = {
  status: 'pending',
  per_page: 20,
  page: 1
};

const queryString = new URLSearchParams(filters).toString();

fetch(`http://localhost:8000/api/admin/orders?${queryString}`, {
  method: 'GET',
  headers: {
    'Authorization': `Bearer ${token}`,
    'Accept': 'application/json'
  }
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

### 6. Update Order Status

```javascript
const token = 'YOUR_TOKEN_HERE';
const orderId = 1;

fetch(`http://localhost:8000/api/admin/orders/${orderId}/update-status`, {
  method: 'POST',
  headers: {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  },
  body: JSON.stringify({
    order_status: 'processing'
  })
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

---

## Testing with Axios (Vue/React)

### 1. Setup Axios Instance

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
});

// Add token to requests
const token = localStorage.getItem('token');
api.defaults.headers.common['Authorization'] = `Bearer ${token}`;

export default api;
```

### 2. Example Usage

```javascript
import api from './api';

// Get products
api.get('/user/products?per_page=20')
  .then(response => console.log(response.data))
  .catch(error => console.error(error));

// Create product
api.post('/admin/products', {
  category_id: 1,
  name: 'New Product',
  price: 1000000,
  quantity_in_stock: 50
})
.then(response => console.log(response.data))
.catch(error => console.error(error.response.data));

// Update order status
api.post(`/admin/orders/${orderId}/update-status`, {
  order_status: 'processing'
})
.then(response => console.log(response.data))
.catch(error => console.error(error.response.data));
```

---

## Common Response Status Codes

| Status | Meaning |
|--------|---------|
| 200 | OK - Request succeeded |
| 201 | Created - Resource created successfully |
| 400 | Bad Request - Invalid input |
| 401 | Unauthorized - Token missing or invalid |
| 403 | Forbidden - Not allowed (not admin) |
| 404 | Not Found - Resource doesn't exist |
| 409 | Conflict - Cannot perform action |
| 422 | Unprocessable Entity - Validation failed |
| 500 | Server Error |

---

## Troubleshooting

### Issue: 401 Unauthorized
**Solution:** Make sure token is included in Authorization header
```bash
-H "Authorization: Bearer YOUR_TOKEN"
```

### Issue: 403 Forbidden
**Solution:** User is not an admin. Need IsAdmin middleware permission.

### Issue: 404 Not Found
**Solution:** Check resource ID exists in database

### Issue: 422 Validation Error
**Solution:** Check required fields and data types. Review error message for details.

### Issue: CORS Error
**Solution:** Add CORS headers in `config/cors.php`:
```php
'allowed_origins' => ['http://localhost:3000'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
```

---

## Performance Tips

1. **Use Pagination:** Always use `per_page` parameter for large datasets
2. **Filter Data:** Use query parameters to filter on server-side
3. **Lazy Loading:** Use `with()` in controllers for relationships
4. **Caching:** Implement Redis caching for reports

---

## Security Notes

1. **Never expose tokens** in logs or version control
2. **Use HTTPS** in production
3. **Validate all input** - already done via Request classes
4. **Use rate limiting** for preventing abuse
5. **Implement CORS** properly for cross-origin requests

---

## API Versioning Strategy

Current: `/api/v1` (ready for future versions)

To support multiple versions:
```php
Route::prefix('v1')->group(function () {
    // v1 routes
});

Route::prefix('v2')->group(function () {
    // v2 routes (future)
});
```

---

## Next Steps

1. ✅ API routes configured
2. ✅ Controllers returning JSON
3. ✅ Request validation implemented
4. ⏳ Add Sanctum authentication endpoint
5. ⏳ Implement rate limiting
6. ⏳ Add OpenAPI/Swagger documentation
7. ⏳ Deploy to production

Good luck with your API! 🚀
