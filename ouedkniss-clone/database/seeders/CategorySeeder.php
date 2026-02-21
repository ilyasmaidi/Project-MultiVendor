<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Real Estate
            [
                'name' => 'عقارات',
                'slug' => 'real-estate',
                'type' => 'real_estate',
                'icon' => 'heroicon-o-home',
                'children' => [
                    ['name' => 'بيع', 'slug' => 'sell', 'type' => 'real_estate'],
                    ['name' => 'إيجار', 'slug' => 'rent', 'type' => 'real_estate'],
                    ['name' => 'تبادل', 'slug' => 'exchange', 'type' => 'real_estate'],
                ],
            ],
            // Cars
            [
                'name' => 'سيارات',
                'slug' => 'cars',
                'type' => 'car',
                'icon' => 'heroicon-o-truck',
                'children' => [
                    ['name' => 'سيارات للبيع', 'slug' => 'cars-for-sale', 'type' => 'car'],
                    ['name' => 'قطع غيار', 'slug' => 'spare-parts', 'type' => 'general'],
                    ['name' => 'إكسسوارات', 'slug' => 'accessories', 'type' => 'general'],
                ],
            ],
            // Electronics
            [
                'name' => 'إلكترونيات',
                'slug' => 'electronics',
                'type' => 'general',
                'icon' => 'heroicon-o-device-phone-mobile',
                'children' => [
                    ['name' => 'هواتف', 'slug' => 'phones', 'type' => 'general'],
                    ['name' => 'حواسيب', 'slug' => 'computers', 'type' => 'general'],
                    ['name' => 'تلفزيونات', 'slug' => 'tvs', 'type' => 'general'],
                ],
            ],
            // Furniture
            [
                'name' => 'أثاث',
                'slug' => 'furniture',
                'type' => 'general',
                'icon' => 'heroicon-o-cube',
                'children' => [
                    ['name' => 'غرف نوم', 'slug' => 'bedrooms', 'type' => 'general'],
                    ['name' => 'غرف جلوس', 'slug' => 'living-rooms', 'type' => 'general'],
                    ['name' => 'مطبخ', 'slug' => 'kitchen', 'type' => 'general'],
                ],
            ],
            // Fashion
            [
                'name' => 'أزياء',
                'slug' => 'fashion',
                'type' => 'general',
                'icon' => 'heroicon-o-shopping-bag',
                'children' => [
                    ['name' => 'رجالي', 'slug' => 'men', 'type' => 'general'],
                    ['name' => 'نسائي', 'slug' => 'women', 'type' => 'general'],
                    ['name' => 'أطفال', 'slug' => 'kids', 'type' => 'general'],
                ],
            ],
            // Services
            [
                'name' => 'خدمات',
                'slug' => 'services',
                'type' => 'general',
                'icon' => 'heroicon-o-wrench-screwdriver',
                'children' => [
                    ['name' => 'صيانة', 'slug' => 'maintenance', 'type' => 'general'],
                    ['name' => 'نقل', 'slug' => 'transport', 'type' => 'general'],
                    ['name' => 'تعليم', 'slug' => 'education', 'type' => 'general'],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $children = $categoryData['children'] ?? [];
            unset($categoryData['children']);

            $parent = Category::create($categoryData);

            foreach ($children as $childData) {
                $childData['parent_id'] = $parent->id;
                Category::create($childData);
            }
        }

        $this->command->info('Categories created successfully!');
    }
}
