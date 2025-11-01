<?php

namespace Database\Factories;

use App\Models\Forum;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Tips Packaging Rendang untuk Ekspor ke Luar Negeri',
            'Bagaimana Meningkatkan Penjualan Online dengan Digital Marketing?',
            'Strategi Branding yang Efektif untuk UMKM Lokal',
            'Pengalaman Mentoring: Dari Start-up ke Bisnis Sukses',
            'Cara Mendapatkan Pendanaan untuk Mengembangkan UMKM',
            'Pemanfaatan Social Media untuk Pemasaran Produk Lokal',
            'Tips Memilih Bahan Baku Berkualitas untuk Produksi',
            'Strategi Ekspansi Bisnis dengan Modal Terbatas',
            'Peran Teknologi dalam Digitalisasi UMKM',
            'Cara Membangun Jaringan Bisnis yang Kuat',
            'Tips Packaging yang Ramah Lingkungan',
            'Strategi Harga untuk Bersaing di Pasar Internasional',
            'Bagaimana Menghadapi Persaingan Bisnis yang Ketat?',
            'Tips Membuat Konten Marketing yang Menarik',
            'Pengalaman Membangun Brand dari Nol',
        ];

        $bodies = [
            'Saya ingin berbagi pengalaman tentang packaging rendang untuk ekspor. Pastikan menggunakan kemasan yang kedap udara dan tahan lama. Jangan lupa sertakan label yang jelas dalam bahasa Inggris dan sertifikat halal.',
            'Digital marketing adalah kunci kesuksesan bisnis online saat ini. Gunakan Instagram dan Facebook untuk menampilkan produk dengan foto yang menarik. Jangan lupa untuk konsisten posting dan berinteraksi dengan customer.',
            'Branding yang kuat akan membantu produk Anda lebih mudah diingat. Gunakan warna, logo, dan packaging yang konsisten. Buat cerita yang menarik di balik produk Anda.',
            'Saya sudah mendapat mentoring selama 6 bulan dan bisnis saya berkembang pesat. Kuncinya adalah konsistensi dan selalu belajar dari mentor yang berpengalaman.',
            'Untuk mendapatkan pendanaan, pastikan Anda memiliki business plan yang jelas dan proposal yang menarik. Jangan ragu untuk mencari investor atau mengajukan pinjaman ke bank.',
        ];

        return [
            'forum_id' => Forum::factory(),
            'posted_by' => User::factory(),
            'title' => fake()->randomElement($titles),
            'body' => fake()->randomElement($bodies) . ' ' . fake()->paragraph(),
            'status' => fake()->randomElement(['published', 'draft', null]),
        ];
    }
}
