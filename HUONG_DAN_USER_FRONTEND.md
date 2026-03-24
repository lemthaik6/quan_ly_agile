# HƯỚNG DẪN TRIỂN KHAI HỆ THỐNG USER-SIDE - LEMTHAI STORE

## 📋 TÓMT ẮT CÔNG VIỆC ĐÃ THỰC HIỆN

### 1. **Database Schema - Tạo Mới**
Đã tạo 4 migration mới:
- `2024_03_24_000010_create_product_colors_table.php` - Bảng màu sắc sản phẩm
- `2024_03_24_000011_create_product_sizes_table.php` - Bảng kích cỡ sản phẩm
- `2024_03_24_000012_create_reviews_table.php` - Bảng đánh giá/review sản phẩm
- `2024_03_24_000013_add_color_size_to_order_items_table.php` - Thêm cột màu sắc và kích cỡ vào order items

### 2. **Models - Tạo Mới & Cập Nhật**
**Mới tạo:**
- `app/Models/ProductColor.php` - Model màu sắc
- `app/Models/ProductSize.php` - Model kích cỡ
- `app/Models/Review.php` - Model review/đánh giá

**Cập nhật:**
- `app/Models/Product.php` - Thêm quan hệ với colors, sizes, reviews
- `app/Models/User.php` - Thêm quan hệ với orders, reviews

### 3. **Controllers - Tạo Mới**
- `app/Http/Controllers/ProductController.php` - Hiển thị danh sách và chi tiết sản phẩm (với lọc tìm kiếm)
- `app/Http/Controllers/CartController.php` - Quản lý giỏ hàng (session-based)
- `app/Http/Controllers/OrderController.php` - Xử lý checkout, tạo đơn hàng, theo dõi
- `app/Http/Controllers/ReviewController.php` - Xử lý review sản phẩm

### 4. **Form Requests - Validation**
- `app/Http/Requests/AddToCartRequest.php`
- `app/Http/Requests/CheckoutRequest.php`
- `app/Http/Requests/StoreReviewRequest.php`

### 5. **Routes - Cập Nhật**
`routes/web.php` - Thêm tất cả route user-side:
- `/shop` - Danh sách sản phẩm
- `/products/{slug}` - Chi tiết sản phẩm
- `/cart/*` - Giỏ hàng
- `/checkout` - Trang thanh toán
- `/orders/*` - Quản lý đơn hàng
- `/reviews/*` - Review sản phẩm
- `/` - Redirect sang shop

### 6. **Blade Views - Tạo Mới**
**Layout:**
- `resources/views/layouts/shop.blade.php` - Layout chính (futuristic style)

**Trang User:**
- `resources/views/shop/products.blade.php` - Danh sách sản phẩm với bộ lọc
- `resources/views/shop/product-detail.blade.php` - Chi tiết sản phẩm
- `resources/views/shop/cart.blade.php` - Giỏ hàng
- `resources/views/shop/checkout.blade.php` - Trang thanh toán
- `resources/views/shop/order-confirmation.blade.php` - Xác nhận đơn hàng
- `resources/views/shop/my-orders.blade.php` - Danh sách đơn hàng
- `resources/views/shop/order-detail.blade.php` - Chi tiết đơn hàng + tracking
- `resources/views/shop/review.blade.php` - Form đánh giá sản phẩm

### 7. **Seeders - Cập Nhật**
- `database/seeders/ProductSeeder.php` - Mới tạo với dữ liệu mẫu
- `database/seeders/DatabaseSeeder.php` - Cập nhật để gọi ProductSeeder

---

## 🚀 HƯỚNG DẪN SETUP & CHẠY

### **Bước 1: Chuẩn Bị Môi Trường**
```bash
cd f:\Ki_5\quan_ly_agile\website

# Cài dependencies (nếu chưa có)
composer install
npm install

# Copy file config
cp .env.example .env

# Generate app key
php artisan key:generate
```

### **Bước 2: Cấu Hình Database**
Mở file `.env` và cập nhật:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lemthai_store
DB_USERNAME=root
DB_PASSWORD=
```

### **Bước 3: Chạy Migrations**
```bash
# Chạy tất cả migration
php artisan migrate --seed

# Hoặc chạy riêng từng bước
php artisan migrate  # Chạy migration
php artisan db:seed  # Chạy seeder
```

### **Bước 4: Khởi Động Server**
```bash
# Cách 1: Sử dụng Artisan
php artisan serve

# Cách 2: Mở trên localhost
http://localhost:8000

# Mặc định port là 8000, nếu bậc chiếm có thể dùng:
php artisan serve --port=8001
```

---

## 🧑‍💼 TÀI KHOẢN TEST

**Admin:**
- Email: `admin@lemthai.com`
- Password: `admin123`
- Role: `quan_tri`

**Customer:**
- Email: `customer@example.com`
- Password: `password123`
- Role: `khach_hang`

---

## ✨ TÍNH NĂNG ĐÃ THỰC HIỆN

### **1. Xem Danh Sách Sản Phẩm**
- ✅ Hiển thị tất cả sản phẩm (is_active = true)
- ✅ Phân trang 12 sản phẩm/trang
- ✅ Hiển thị thông tin: hình ảnh, giá, giá giảm, rating, số lượt review

### **2. Tìm Kiếm Sản Phẩm**
- ✅ Tìm kiếm theo tên/mô tả
- ✅ Lọc theo danh mục
- ✅ Lọc theo khoảng giá (Min - Max)
- ✅ Sắp xếp: Mới nhất, Phổ biến, Giá tăng, Giá giảm

### **3. Xem Chi Tiết Sản Phẩm**
- ✅ Hiển thị hình ảnh, tên, mô tả đầy đủ
- ✅ Hiển thị giá gốc và giá giảm
- ✅ Hiển thị tình trạng hàng (Còn hàng / Sắp hết / Hết hàng)
- ✅ Chọn màu sắc (nếu có)
- ✅ Chọn kích cỡ (nếu có)
- ✅ Chọn số lượng
- ✅ Nút "Thêm Vào Giỏ Hàng"
- ✅ Hiển thị sản phẩm liên quan
- ✅ Hiển thị review từ khách hàng khác
- ✅ Rating sao (chỉ hiển thị review từ mua verified)

### **4. Quản Lý Giỏ Hàng (Session)**
- ✅ Thêm sản phẩm vào giỏ (chưa đăng nhập)
- ✅ Cập nhật số lượng
- ✅ Xóa sản phẩm khỏi giỏ
- ✅ Xóa toàn bộ giỏ
- ✅ Hiển thị tóm tắt: Tạm tính, Phí vận chuyển, Tổng cộng
- ✅ Lưu trữ thông tin: Product ID, Name, Slug, Image, Price, Qty, Color, Size

### **5. Checkout & Đặt Hàng**
- ✅ Form thông tin giao hàng với validation đầy đủ
- ✅ Tự điền thông tin nếu đã đăng nhập (name, email, phone, address, city, district)
- ✅ Chọn phương thức thanh toán (COD, Chuyển khoản)
- ✅ Ghi chú đơn hàng (tùy chọn)
- ✅ Tóm tắt đơn hàng bên cạnh
- ✅ Tính toán: Subtotal + Shipping Fee - Discount
- ✅ Validation: Email, Phone (10-11 chữ số), Địa chỉ

### **6. Tạo Đơn Hàng**
- ✅ Tạo record Order với đầy đủ thông tin:
  - `order_code` - Mã đơn (ORD-RANDOM-TIMESTAMP)
  - `user_id`, Subtotal, Shipping Fee, Discount, Final Amount
  - `order_status` = 'pending'
  - `payment_status` = 'unpaid' (COD) hoặc 'pending' (Bank)
  - `payment_method`, Shipping Address, City, District, Notes
- ✅ Tạo OrderItems với thông tin sản phẩm, số lượng, giá, màu, kích cỡ
- ✅ Tạo OrderTracking record đầu tiên (status = 'pending')
- ✅ Cập nhật `sold_count` của Product
- ✅ Xóa giỏ hàng sau khi đặt thành công

### **7. Xác Nhận Đơn Hàng**
- ✅ Trang xác nhận với mã đơn hàng
- ✅ Hiển thị thông tin giao hàng, chi tiết đơn, tổng tiền
- ✅ Link xem chi tiết đơn hàng

### **8. Quản Lý Đơn Hàng (User)**
- ✅ Danh sách đơn hàng của user (đăng nhập)
- ✅ Hiển thị: Mã đơn, Ngày đặt, Số sản phẩm, Tổng tiền, Trạng thái thanh toán, Trạng thái đơn
- ✅ Phân trang 10 đơn/trang
- ✅ Nút xem chi tiết

### **9. Theo Dõi Đơn Hàng (Tracking)**
- ✅ Trang chi tiết đơn hàng với timeline trạng thái
- ✅ Hiển thị 5 trạng thái chính: Tạo → Xác nhận → Chuẩn bị → Giao → Hoàn thành
- ✅ Nhật ký cập nhật từ bảng order_trackings
- ✅ Hiển thị danh sách sản phẩm, từng sản phẩm có nút "Đánh Giá"
- ✅ Hiển thị thông tin giao hàng
- ✅ Tóm tắt thanh toán

### **10. Đánh Giá Sản Phẩm**
- ✅ Chỉ cho review nếu user đã mua sản phẩm (verified purchase)
- ✅ Một user = một review/sản phẩm (có thể update)
- ✅ Chọn số sao (1-5)
- ✅ Viết bình luận (tùy chọn, max 1000 ký tự)
- ✅ Hiển thị review từ users khác (verified only)
- ✅ Hiển thị rating trung bình & số lượt review trên trang chi tiết sản phẩm

### **11. Giao Diện (UI/UX)**
- ✅ Style futuristic với màu neon: Xanh (#00f5ff), Xanh đậm (#0066ff), Tím (#8b5cf6), Hồng (#ff006e)
- ✅ Gradient background tối
- ✅ Glass morphism effects (backdrop-filter: blur)
- ✅ Hover glow effects
- ✅ Responsive design (Mobile, Tablet, Desktop)
- ✅ Navigation bar cố định với logo, links, giỏ hàng badge
- ✅ Alert messages (success, error, warning)
- ✅ Animations fade-in, glow, bounce

---

## 📁 CẤU TRÚC FILE TẠO MỚI

```
website/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ProductController.php (MỚI)
│   │   │   ├── CartController.php (MỚI)
│   │   │   ├── OrderController.php (MỚI)
│   │   │   └── ReviewController.php (MỚI)
│   │   └── Requests/
│   │       ├── AddToCartRequest.php (MỚI)
│   │       ├── CheckoutRequest.php (MỚI)
│   │       └── StoreReviewRequest.php (MỚI)
│   └── Models/
│       ├── ProductColor.php (MỚI)
│       ├── ProductSize.php (MỚI)
│       └── Review.php (MỚI)
├── database/
│   ├── migrations/
│   │   ├── 2024_03_24_000010_create_product_colors_table.php
│   │   ├── 2024_03_24_000011_create_product_sizes_table.php
│   │   ├── 2024_03_24_000012_create_reviews_table.php
│   │   └── 2024_03_24_000013_add_color_size_to_order_items_table.php
│   └── seeders/
│       └── ProductSeeder.php (MỚI)
└── resources/
    └── views/
        ├── layouts/
        │   └── shop.blade.php (MỚI - Layout chính)
        └── shop/ (MỚI - Folder)
            ├── products.blade.php
            ├── product-detail.blade.php
            ├── cart.blade.php
            ├── checkout.blade.php
            ├── order-confirmation.blade.php
            ├── my-orders.blade.php
            ├── order-detail.blade.php
            └── review.blade.php
```

---

## 🔄 FLOW CHÍNH

### **1. User Không Đăng Nhập**
```
Shop (Danh sách) → Xem Chi Tiết → Thêm Vào Giỏ → Xem Giỏ → 
Thanh Toán (yêu cầu nhập thông tin) → Đặt Hàng → Xác Nhận
```

### **2. User Đã Đăng Nhập**
```
Shop → Xem Chi Tiết → Thêm Vào Giỏ → Xem Giỏ → 
Thanh Toán (auto fill thông tin) → Đặt Hàng → Xác Nhận → 
Xem Đơn Hàng (Danh Sách) → Chi Tiết + Tracking → Đánh Giá Sản Phẩm
```

---

## 🛒 CART SESSION STRUCTURE

```php
session()->get('cart') => [
    'product_{id}_color_{color}_size_{size}' => [
        'product_id' => 1,
        'product_name' => 'Smart T-Shirt Pro',
        'product_slug' => 'smart-tshirt-pro',
        'product_image' => 'path/to/image.jpg',
        'price' => 999000,
        'quantity' => 2,
        'color' => 'Đen',
        'size' => 'M',
    ],
    ...
]
```

---

## 🧪 TEST MANUAL

### **1. Trang Chủ**
- [ ] Truy cập `/` → Redirect sang `/shop`
- [ ] Kiểm tra layout, navbar, footer
- [ ] Click "Khám Phá Ngay" → Vào trang shop

### **2. Danh Sách Sản Phẩm**
- [ ] Truy cập `/shop`
- [ ] Xem 12 sản phẩm/trang
- [ ] Tìm kiếm: Nhập "Smart" → Filter đúng
- [ ] Lọc danh mục: Chọn "Công Nghệ Thời Trang" → Hiển thị đúng
- [ ] Lọc giá: Min 500000, Max 1500000 → Hiển thị đúng
- [ ] Sắp xếp: Thử từng option
- [ ] Click sản phẩm → Vào chi tiết

### **3. Chi Tiết Sản Phẩm**
- [ ] Xem thông tin đầy đủ
- [ ] Chọn màu sắc (nếu có)
- [ ] Chọn kích cỡ (nếu có)
- [ ] Tăng/giảm số lượng
- [ ] Click "Thêm Vào Giỏ" → Mất từ 2-3 giây (hoặc tức thì)
- [ ] Xem review sản phẩm

### **4. Giỏ Hàng**
- [ ] Tráng cập số lượng
- [ ] Xóa sản phẩm
- [ ] Xóa toàn bộ giỏ
- [ ] Tóm tắt: Tạm tính + Phí vận chuyển = Tổng

### **5. Checkout**
- [ ] Nhập thông tin (nếu chưa đăng nhập)
- [ ] Nếu đã đăng nhập → Auto fill
- [ ] Chọn phương thức thanh toán
- [ ] Ghi chú
- [ ] Click "Hoàn Tất Đơn Hàng"

### **6. Xác Nhận**
- [ ] Hiển thị mã đơn
- [ ] Thông tin giao hàng đúng
- [ ] Chi tiết sản phẩm đúng
- [ ] Tổng tiền đúng

### **7. Quản Lý Đơn Hàng**
- [ ] Đăng nhập
- [ ] Vào "Đơn Hàng" → Xem danh sách
- [ ] Click một đơn → Xem chi tiết + timeline tracking
- [ ] Nếu đơn hoàn thành → Click "Đánh Giá" trên sản phẩm

### **8. Đánh Giá Sản Phẩm**
- [ ] Chọn số sao
- [ ] Viết bình luận
- [ ] Gửi → Review xuất hiện trang chi tiết

---

## 🔐 SECURITY & BEST PRACTICES

✅ **Đã Thực Hiện:**
1. Authentication check (middleware `auth` trên routes cần)
2. Authorization: User chỉ xem/chỉnh sửa đơn của mình
3. Validation input: Form Request validation
4. CSRF protection: `@csrf` trên form
5. SQL injection prevention: Eloquent ORM
6. Data sanitization: `e()`, `Str::limit()`
7. Eager loading: `with()` để tránh N+1
8. Soft deletes: Trên User, Product, OrderTracking, Review

---

## 📝 GHI CHÚ QUAN TRỌNG

1. **Giỏ Hàng**: Dùng session, không persistence trên database. Sau khi checkout giỏ sẽ bị clear.

2. **Review**: Chỉ review sau khi mua (verified_purchase = true). Một user chỉ có thể review một sản phẩm một lần (nhưng có thể update).

3. **Order Status**: Hiện tại order_status mặc định là 'pending'. Admin sẽ update via admin panel.

4. **ColorSize**: Có thể không chọn màu/kích cỡ nếu sản phẩm không có variant.

5. **Responsive**: Tối ưu cho mobile 320px+, tablet 768px+, desktop 1200px+

6. **UTF-8**: Tất cả file đã set encoding cho tiếng Việt

---

## 🐛 TROUBLESHOOTING

### **Lỗi: Class 'ProductColor' not found**
→ Chạy: `composer dump-autoload`

### **Lỗi: Migration not found**
→ Chạy: `php artisan migrate:refresh --seed`

### **Lỗi: CSRF token mismatch**
→ Đảm bảo form có `@csrf`

### **Lỗi: 419 Page Expired (Session)**
→ Xóa cookies, cache: `php artisan cache:clear` và `php artisan config:clear`

### **Giỏ không lưu**
→ Kiểm tra `.env`: `SESSION_DRIVER=file` (hoặc database)

### **Ảnh sản phẩm không hiển thị**
→ Chạy: `php artisan storage:link` (tạo symlink public/storage)

---

## 📞 SUPPORT

- Database: MySQL 5.7+
- PHP: 8.1+
- Laravel: 11+
- Node: 18+ (nếu build frontend assets)

**Tất cả tính năng bắt buộc đã hoàn thiện và sẵn sàng test!** ✅

