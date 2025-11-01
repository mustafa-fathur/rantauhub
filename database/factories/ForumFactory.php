<?php

namespace Database\Factories;

use App\Models\Forum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Forum>
 */
class ForumFactory extends Factory
{
    protected $model = Forum::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $topics = [
            'Bisnis & Kuliner',
            'Ekspor Produk Lokal',
            'Digital Marketing',
            'Mentorship',
            'Investasi',
            'Teknologi dan Digitalisasi',
            'Packaging & Branding',
            'Strategi Pemasaran',
            'Pembiayaan UMKM',
        ];

        $descriptions = [
            'Diskusi seputar bisnis kuliner dan makanan khas Sumatera Barat',
            'Tips dan trik ekspor produk lokal ke pasar internasional',
            'Strategi digital marketing untuk meningkatkan penjualan',
            'Berbagi pengalaman mentoring dan pelatihan bisnis',
            'Informasi tentang investasi dan pendanaan UMKM',
            'Pemanfaatan teknologi untuk digitalisasi bisnis',
            'Tips packaging dan branding yang menarik',
            'Berbagai strategi pemasaran yang efektif',
            'Pembiayaan dan pendanaan untuk mengembangkan UMKM',
        ];

        $index = fake()->numberBetween(0, count($topics) - 1);

        return [
            'title' => $topics[$index],
            'description' => $descriptions[$index],
        ];
    }
}
