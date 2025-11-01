<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentReply>
 */
class CommentReplyFactory extends Factory
{
    protected $model = CommentReply::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bodies = [
            'Terima kasih atas tanggapannya!',
            'Saya setuju dengan pendapat Anda.',
            'Betul sekali, poin yang sangat penting.',
            'Terima kasih sudah menjelaskan lebih detail.',
            'Ini memang perlu diperhatikan lebih lanjut.',
            'Saya akan coba tips yang Anda berikan.',
            'Pendapat yang sangat membangun, terima kasih!',
            'Setuju, ini memang solusi yang tepat.',
        ];

        return [
            'comment_id' => Comment::factory(),
            'user_id' => User::factory(),
            'body' => fake()->randomElement($bodies) . ' ' . fake()->optional()->sentence(),
        ];
    }
}
