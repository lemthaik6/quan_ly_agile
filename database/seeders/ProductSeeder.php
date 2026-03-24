<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\User;
use App\Models\Review;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categoryTechFashion = Category::create([
            'name' => 'Công Nghệ Thời Trang',
            'slug' => 'tech-fashion',
            'description' => 'Quần áo công nghệ cao cấp',
            'is_active' => true,
        ]);

        $categoryAccessories = Category::create([
            'name' => 'Phụ Kiện',
            'slug' => 'accessories',
            'description' => 'Phụ kiện thời trang cao cấp',
            'is_active' => true,
        ]);

        // Create products
        $products = [
            [
                'name' => 'Smart T-Shirt Pro',
                'slug' => 'smart-tshirt-pro',
                'description' => 'Áo thun thông minh với công nghệ khân giấc, theo dõi sức khỏe, vật liệu cao cấp từ Nhật',
                'short_description' => 'Áo thun thông minh cao cấp với công nghệ khân giấc',
                'price' => 1500000,
                'discount_price' => 999000,
                'cost_price' => 500000,
                'quantity_in_stock' => 50,
                'sold_count' => 120,
                'sku' => 'SMART-TS-PRO-001',
                'is_featured' => true,
                'is_active' => true,
                'category_id' => $categoryTechFashion->id,
                'colors' => [
                    ['name' => 'Đen', 'hex' => '#000000', 'stock' => 20],
                    ['name' => 'Trắng', 'hex' => '#FFFFFF', 'stock' => 15],
                    ['name' => 'Xanh Dương', 'hex' => '#0066FF', 'stock' => 15],
                ],
                'sizes' => [
                    ['name' => 'S', 'stock' => 15],
                    ['name' => 'M', 'stock' => 20],
                    ['name' => 'L', 'stock' => 15],
                ]
            ],
            [
                'name' => 'Neon Wireless Earbuds Ultra',
                'slug' => 'neon-wireless-earbuds-ultra',
                'description' => 'Tai nghe không dây với âm thanh vượt trội, pin 24h, chống nước IPX7',
                'short_description' => 'Tai nghe không dây chống nước IPX7, pin 24h',
                'price' => 2500000,
                'discount_price' => 1799000,
                'cost_price' => 800000,
                'quantity_in_stock' => 30,
                'sold_count' => 85,
                'sku' => 'NEON-WEB-ULTRA-001',
                'is_featured' => true,
                'is_active' => true,
                'category_id' => $categoryAccessories->id,
                'colors' => [
                    ['name' => 'Đen', 'hex' => '#000000', 'stock' => 10],
                    ['name' => 'Hồng Neon', 'hex' => '#FF006E', 'stock' => 10],
                    ['name' => 'Xanh Neon', 'hex' => '#00F5FF', 'stock' => 10],
                ],
                'sizes' => []
            ],
            [
                'name' => 'Digital Fashion Jacket',
                'slug' => 'digital-fashion-jacket',
                'description' => 'Áo khoác thời trang với thiết kế futuristic, chất liệu premium, phù hợp với mọi lứa tuổi',
                'short_description' => 'Áo khoác futuristic chất liệu premium',
                'price' => 3500000,
                'discount_price' => 2499000,
                'cost_price' => 1200000,
                'quantity_in_stock' => 25,
                'sold_count' => 45,
                'sku' => 'DIGITAL-JACKET-001',
                'is_featured' => false,
                'is_active' => true,
                'category_id' => $categoryTechFashion->id,
                'colors' => [
                    ['name' => 'Đen', 'hex' => '#000000', 'stock' => 10],
                    ['name' => 'Xám', 'hex' => '#888888', 'stock' => 8],
                    ['name' => 'Tím', 'hex' => '#8B5CF6', 'stock' => 7],
                ],
                'sizes' => [
                    ['name' => 'S', 'stock' => 8],
                    ['name' => 'M', 'stock' => 10],
                    ['name' => 'L', 'stock' => 7],
                ]
            ],
            [
                'name' => 'Holographic Phone Protection',
                'slug' => 'holographic-phone-protection',
                'description' => 'Ốp lưng điện thoại hiệu ứng hologram, bảo vệ toàn diện, thiết kế độc dáo',
                'short_description' => 'Ốp lưng hologram bảo vệ toàn diện',
                'price' => 450000,
                'discount_price' => 299000,
                'cost_price' => 120000,
                'quantity_in_stock' => 100,
                'sold_count' => 200,
                'sku' => 'HOLO-PHONE-001',
                'is_featured' => true,
                'is_active' => true,
                'category_id' => $categoryAccessories->id,
                'colors' => [
                    ['name' => 'Rainbow', 'hex' => '#FF00FF', 'stock' => 35],
                    ['name' => 'Xanh', 'hex' => '#00F5FF', 'stock' => 30],
                    ['name' => 'Hồng', 'hex' => '#FF006E', 'stock' => 35],
                ],
                'sizes' => []
            ],
        ];

        foreach ($products as $productData) {
            $colors = $productData['colors'];
            $sizes = $productData['sizes'];
            unset($productData['colors'], $productData['sizes']);

            $product = Product::create($productData);

            // Add colors
            foreach ($colors as $color) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'color_name' => $color['name'],
                    'color_hex' => $color['hex'],
                    'stock_quantity' => $color['stock'],
                ]);
            }

            // Add sizes
            foreach ($sizes as $size) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size_name' => $size['name'],
                    'stock_quantity' => $size['stock'],
                ]);
            }
        }

        // Create sample reviews for the first product
        if ($user = User::first()) {
            $product = Product::first();

            Review::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'rating' => 5,
                'comment' => 'Sản phẩm tuyệt vời! Chất lượng cực tốt, giao hàng nhanh. Tôi rất hài lòng.',
                'is_verified_purchase' => true,
            ]);

            Review::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'rating' => 4,
                'comment' => 'Rất ưng ý, nhưng giá hơi cao so với thị trường.',
                'is_verified_purchase' => true,
            ]);
        }
    }
}
