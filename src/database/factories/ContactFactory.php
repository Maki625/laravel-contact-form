<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
        'first_name' => '太郎',
        'last_name' => '山田',
        'gender' => '1',
        'email' => 'test@example.com',
        'tel' => '08012345678',
        'address' => '東京都渋谷区千駄ヶ谷1-2-3',
        'building' => '千駄ヶ谷マンション101',
        'inquiry_type' => '2',
        'inquiry_content' => '届いた商品が注文した商品ではありませんでした。商品の交換をお願いします。',
        ];
    }
}
