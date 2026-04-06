<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo admin user
        User::create([
            'name' => 'Admin OutfitChill',
            'email' => 'admin@outfitchill.com',
            'password' => Hash::make('admin123'),
            'phone' => '0123456789',
            'role' => 'quan_tri',
            'is_active' => 1,
        ]);

        // Tạo customer user
        User::create([
            'name' => 'Nguyễn Văn A',
            'email' => 'customer@example.com',
            'password' => Hash::make('password123'),
            'phone' => '0987654321',
            'address' => '123 Đường ABC',
            'city' => 'Hồ Chí Minh',
            'district' => 'Quận 1',
            'role' => 'khach_hang',
            'is_active' => 1,
        ]);

        // Tạo categories
        $categories = [
            ['name' => 'Điện tử - Công nghệ', 'slug' => 'dien-tu-cong-nghe', 'description' => 'Các thiết bị điện tử và công nghệ', 'is_active' => 1, 'display_order' => 1],
            ['name' => 'Quần áo - Thời trang', 'slug' => 'quan-ao-thoi-trang', 'description' => 'Quần áo và các sản phẩm thời trang', 'is_active' => 1, 'display_order' => 2],
            ['name' => 'Sách và tài liệu', 'slug' => 'sach-tai-lieu', 'description' => 'Sách và tài liệu giáo dục', 'is_active' => 1, 'display_order' => 3],
            ['name' => 'Nhà cửa và vườn', 'slug' => 'nha-cua-vuon', 'description' => 'Sản phẩm nhà cửa và vườn', 'is_active' => 1, 'display_order' => 4],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Tạo products
        $products = [
            [
                'category_id' => 1,
                'name' => 'Tai nghe không dây',
                'slug' => 'tai-nghe-khong-day',
                'description' => 'Tai nghe cao cấp với chức năng khử tiếng ồn',
                'short_description' => 'Tai nghe không dây chất lượng cao',
                'price' => 1500000,
                'cost_price' => 800000,
                'discount_price' => 1200000,
                'quantity_in_stock' => 50,
                'sku' => 'WHP001',
                'is_featured' => 1,
                'is_active' => 1,
            ],
            [
                'category_id' => 1,
                'name' => 'Cáp sạc USB-C',
                'slug' => 'cap-sac-usb-c',
                'description' => 'Cáp sạc USB-C bền và nhanh',
                'short_description' => 'Cáp sạc nhanh USB-C',
                'price' => 150000,
                'cost_price' => 50000,
                'discount_price' => 120000,
                'quantity_in_stock' => 200,
                'sku' => 'USB001',
                'is_featured' => 0,
                'is_active' => 1,
            ],
            [
                'category_id' => 2,
                'name' => 'Áo thun cotton',
                'slug' => 'ao-thun-cotton',
                'description' => 'Áo thun từ cotton 100% hữu cơ với thiết kế thoải mái',
                'short_description' => 'Áo thun cotton thoải mái',
                'price' => 250000,
                'cost_price' => 100000,
                'discount_price' => 200000,
                'quantity_in_stock' => 100,
                'sku' => 'TSH001',
                'is_featured' => 1,
                'is_active' => 1,
            ],
            [
                'category_id' => 3,
                'name' => 'Sách lập trình',
                'slug' => 'sach-lap-trinh',
                'description' => 'Hướng dẫn lập trình toàn diện cho người mới bắt đầu',
                'short_description' => 'Sách học lập trình cơ bản',
                'price' => 450000,
                'cost_price' => 250000,
                'discount_price' => 400000,
                'quantity_in_stock' => 30,
                'sku' => 'BOOK001',
                'is_featured' => 0,
                'is_active' => 1,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Run ProductSeeder for sample data with colors, sizes, and reviews
        $this->call(ProductSeeder::class);
    }
}
