<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. تعطيل التحقق من القيود (Foreign Key Checks) لمسح الجدول بأمان
        Schema::disableForeignKeyConstraints();
        Category::truncate(); // مسح كل البيانات القديمة تماماً
        Schema::enableForeignKeyConstraints();

        $categories = [
            [
                'name' => 'رجالي',
                'slug' => 'men',
                'type' => 'general',
                'icon' => 'heroicon-o-user',
                'children' => [
                    ['name' => 'تيشرتات قطنية', 'slug' => 'men-t-shirts', 'type' => 'general'],
                    ['name' => 'قمصان بولو', 'slug' => 'men-polo', 'type' => 'general'],
                    ['name' => 'هوديز وسويت شيرت', 'slug' => 'men-hoodies', 'type' => 'general'],
                ],
            ],
            [
                'name' => 'نسائي',
                'slug' => 'women',
                'type' => 'general',
                'icon' => 'heroicon-o-user-circle',
                'children' => [
                    ['name' => 'تيشرتات (T-Shirts)', 'slug' => 'women-t-shirts', 'type' => 'general'],
                    ['name' => 'توب وبلوزات', 'slug' => 'women-tops', 'type' => 'general'],
                    ['name' => 'هوديز نسائي', 'slug' => 'women-hoodies', 'type' => 'general'],
                ],
            ],
            [
                'name' => 'أطفال',
                'slug' => 'kids',
                'type' => 'general',
                'icon' => 'heroicon-o-face-smile',
                'children' => [
                    ['name' => 'بناتي', 'slug' => 'girls', 'type' => 'general'],
                    ['name' => 'ولادي', 'slug' => 'boys', 'type' => 'general'],
                ],
            ],
            [
                'name' => 'مجموعات خاصة',
                'slug' => 'collections',
                'type' => 'general',
                'icon' => 'heroicon-o-sparkles',
                'children' => [
                    ['name' => 'تصاميم جزائرية (Dz Power)', 'slug' => 'dz-designs', 'type' => 'general'],
                    ['name' => 'تيشرتات مخصصة (Custom)', 'slug' => 'custom-tshirts', 'type' => 'general'],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            // فصل الأبناء عن البيانات الأساسية للأب
            $children = $categoryData['children'] ?? [];
            unset($categoryData['children']);

            // إنشاء القسم الرئيسي (Parent)
            $parent = Category::create($categoryData);

            // إنشاء الأقسام الفرعية (Children) وربطها بالـ parent_id
            foreach ($children as $childData) {
                $childData['parent_id'] = $parent->id;
                Category::create($childData);
            }
        }

        $this->command->info('✅ TRICO Categories: Seeding completed successfully!');
    }
}