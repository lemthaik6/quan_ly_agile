<?php
require __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Category;
use App\Models\Product;

echo "=== Database Seeding Verification ===\n";
echo "Users: " . User::count() . "\n";
echo "Categories: " . Category::count() . "\n";
echo "Products: " . Product::count() . "\n";

if (User::count() > 0) {
    echo "\n✅ Users created:\n";
    User::all()->each(function($user) {
        echo "  - " . $user->name . " (" . $user->email . ") - Role: " . $user->role . "\n";
    });
}

if (Category::count() > 0) {
    echo "\n✅ Categories created:\n";
    Category::all()->each(function($cat) {
        echo "  - " . $cat->name . "\n";
    });
}

if (Product::count() > 0) {
    echo "\n✅ Products created:\n";
    Product::all()->each(function($prod) {
        echo "  - " . $prod->name . " (Stock: " . $prod->quantity_in_stock . ")\n";
    });
}
echo "\n";
