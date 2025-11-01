<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bodies = [
            'Sangat informatif! Terima kasih telah berbagi.',
            'Setuju sekali dengan poin yang Anda sampaikan.',
            'Pengalaman yang sangat menginspirasi, terima kasih!',
            'Saya juga pernah mengalami hal serupa. Tips yang sangat membantu.',
            'Bagus sekali, mohon dijelaskan lebih detail tentang poin ketiga.',
            'Terima kasih atas sharing-nya, sangat bermanfaat untuk saya.',
            'Wah, ini persis yang saya cari! Terima kasih banyak.',
            'Ide yang sangat menarik, saya akan coba terapkan.',
            'Pertanyaan bagus! Saya juga ingin tahu lebih lanjut.',
            'Saya setuju, ini memang penting untuk diperhatikan.',
        ];

        return [
            'post_id' => Post::factory(),
            'user_id' => User::factory(),
            'body' => fake()->randomElement($bodies) . ' ' . fake()->optional()->sentence(),
        ];
    }
}
