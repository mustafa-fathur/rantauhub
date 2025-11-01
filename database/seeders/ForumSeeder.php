<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Forum;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostTag;
use App\Models\User;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing users
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }

        // Create forums
        $forumTitles = [
            'Bisnis & Kuliner',
            'Ekspor Produk Lokal',
            'Digital Marketing',
            'Mentorship',
            'Investasi',
            'Teknologi dan Digitalisasi',
        ];

        $forumDescriptions = [
            'Diskusi seputar bisnis kuliner dan makanan khas Sumatera Barat',
            'Tips dan trik ekspor produk lokal ke pasar internasional',
            'Strategi digital marketing untuk meningkatkan penjualan',
            'Berbagi pengalaman mentoring dan pelatihan bisnis',
            'Informasi tentang investasi dan pendanaan UMKM',
            'Pemanfaatan teknologi untuk digitalisasi bisnis',
        ];

        $forums = [];
        foreach ($forumTitles as $index => $title) {
            $forums[] = Forum::create([
                'title' => $title,
                'description' => $forumDescriptions[$index],
            ]);
        }

        // Create posts for each forum
        $postTitles = [
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
        ];

        $postBodies = [
            'Saya ingin berbagi pengalaman tentang packaging rendang untuk ekspor. Pastikan menggunakan kemasan yang kedap udara dan tahan lama. Jangan lupa sertakan label yang jelas dalam bahasa Inggris dan sertifikat halal. Packaging yang baik akan menjaga kualitas produk selama perjalanan.',
            'Digital marketing adalah kunci kesuksesan bisnis online saat ini. Gunakan Instagram dan Facebook untuk menampilkan produk dengan foto yang menarik. Jangan lupa untuk konsisten posting dan berinteraksi dengan customer. Engagement yang tinggi akan meningkatkan visibilitas produk Anda.',
            'Branding yang kuat akan membantu produk Anda lebih mudah diingat. Gunakan warna, logo, dan packaging yang konsisten. Buat cerita yang menarik di balik produk Anda. Storytelling adalah kunci untuk menarik perhatian konsumen.',
            'Saya sudah mendapat mentoring selama 6 bulan dan bisnis saya berkembang pesat. Kuncinya adalah konsistensi dan selalu belajar dari mentor yang berpengalaman. Mentorship membantu saya menghindari kesalahan yang tidak perlu.',
            'Untuk mendapatkan pendanaan, pastikan Anda memiliki business plan yang jelas dan proposal yang menarik. Jangan ragu untuk mencari investor atau mengajukan pinjaman ke bank. Transparansi finansial sangat penting.',
            'Social media adalah platform yang sangat powerful untuk pemasaran. Gunakan hashtag yang relevan, buat konten yang menarik, dan jangan lupa untuk engage dengan followers. Konsistensi adalah kunci kesuksesan.',
            'Kualitas bahan baku menentukan kualitas produk akhir. Pilih supplier yang terpercaya dan pastikan bahan baku selalu fresh. Jangan kompromi dengan kualitas untuk menekan biaya.',
            'Ekspansi bisnis dengan modal terbatas memerlukan strategi yang tepat. Mulai dari pasar lokal, kemudian ekspansi secara bertahap. Gunakan profit untuk reinvestasi ke bisnis.',
            'Teknologi dapat membantu UMKM menjadi lebih efisien dan produktif. Gunakan sistem POS untuk manajemen penjualan, aplikasi akuntansi untuk keuangan, dan social media untuk pemasaran.',
            'Jaringan bisnis yang kuat akan membantu Anda berkembang lebih cepat. Ikuti komunitas bisnis, attend workshop, dan jangan ragu untuk berkolaborasi dengan bisnis lain.',
        ];

        $posts = [];
        foreach ($forums as $forumIndex => $forum) {
            // Create 3-5 posts per forum
            $postsCount = rand(3, 5);
            
            for ($i = 0; $i < $postsCount; $i++) {
                $titleIndex = ($forumIndex * 2 + $i) % count($postTitles);
                $bodyIndex = ($forumIndex * 2 + $i) % count($postBodies);
                
                $post = Post::create([
                    'forum_id' => $forum->id,
                    'posted_by' => $users->random()->id,
                    'title' => $postTitles[$titleIndex],
                    'body' => $postBodies[$bodyIndex],
                    'status' => 'published',
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
                
                $posts[] = $post;

                // Create tags for posts
                $tagOptions = ['ekspor', 'packaging', 'rendang', 'marketing', 'digital', 'bisnis', 'kuliner', 'umkm', 'pendanaan', 'investasi', 'mentorship', 'teknologi'];
                $tagsCount = rand(2, 4);
                $selectedTags = fake()->randomElements($tagOptions, $tagsCount);
                
                foreach ($selectedTags as $tag) {
                    PostTag::create([
                        'post_id' => $post->id,
                        'tag' => $tag,
                    ]);
                }

                // Create likes for each post (5-15 likes)
                $likesCount = min(rand(5, 15), $users->count());
                $likedUsers = $users->random($likesCount);
                
                foreach ($likedUsers as $likedUser) {
                    try {
                        PostLike::create([
                            'post_id' => $post->id,
                            'user_id' => $likedUser->id,
                            'created_at' => $post->created_at->copy()->addMinutes(rand(1, 1440)),
                        ]);
                    } catch (\Exception $e) {
                        // Skip if duplicate (unique constraint)
                    }
                }

                // Create comments for each post (3-8 comments)
                $commentsCount = rand(3, 8);
                $commentUsers = $users->random(min($commentsCount, $users->count()));
                
                foreach ($commentUsers as $commentIndex => $commentUser) {
                    $commentCreatedAt = $post->created_at->copy()->addHours(rand(1, 48));
                    $comment = Comment::create([
                        'post_id' => $post->id,
                        'user_id' => $commentUser->id,
                        'body' => $this->getCommentBody(),
                        'created_at' => $commentCreatedAt,
                    ]);

                    // Create replies for some comments (30% chance)
                    if (rand(1, 100) <= 30) {
                        $repliesCount = rand(1, 3);
                        $replyUsers = $users->random(min($repliesCount, $users->count()));
                        
                        foreach ($replyUsers as $replyUser) {
                            CommentReply::create([
                                'comment_id' => $comment->id,
                                'user_id' => $replyUser->id,
                                'body' => $this->getReplyBody(),
                                'created_at' => $commentCreatedAt->copy()->addHours(rand(1, 24)),
                            ]);
                        }
                    }
                }
            }
        }

        $this->command->info('Created ' . count($forums) . ' forums');
        $this->command->info('Created ' . count($posts) . ' posts');
        $this->command->info('Forum seeder completed!');
    }

    private function getCommentBody(): string
    {
        $comments = [
            'Sangat informatif! Terima kasih telah berbagi pengalaman.',
            'Setuju sekali dengan poin yang Anda sampaikan. Saya juga pernah mengalami hal serupa.',
            'Pengalaman yang sangat menginspirasi, terima kasih!',
            'Tips yang sangat membantu. Saya akan coba terapkan di bisnis saya.',
            'Bagus sekali, mohon dijelaskan lebih detail tentang poin ketiga.',
            'Terima kasih atas sharing-nya, sangat bermanfaat untuk saya.',
            'Wah, ini persis yang saya cari! Terima kasih banyak.',
            'Ide yang sangat menarik, saya akan coba terapkan segera.',
            'Pertanyaan bagus! Saya juga ingin tahu lebih lanjut tentang topik ini.',
            'Saya setuju, ini memang penting untuk diperhatikan dalam menjalankan bisnis.',
        ];

        return fake()->randomElement($comments) . ' ' . fake()->optional(0.5)->sentence();
    }

    private function getReplyBody(): string
    {
        $replies = [
            'Terima kasih atas tanggapannya!',
            'Saya setuju dengan pendapat Anda.',
            'Betul sekali, poin yang sangat penting.',
            'Terima kasih sudah menjelaskan lebih detail.',
            'Ini memang perlu diperhatikan lebih lanjut.',
            'Saya akan coba tips yang Anda berikan.',
            'Pendapat yang sangat membangun, terima kasih!',
            'Setuju, ini memang solusi yang tepat untuk masalah tersebut.',
        ];

        return fake()->randomElement($replies) . ' ' . fake()->optional(0.4)->sentence();
    }
}
