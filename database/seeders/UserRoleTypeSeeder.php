<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Funder;
use App\Models\Mentor;
use App\Models\UmkmOwner;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. User dengan role 'user' dan type UMKM_OWNER
        $umkmOwner = User::updateOrCreate(
            ['email' => 'rina.sari@example.com'],
            [
                'name' => 'Rina Sari',
                'password' => Hash::make('password'),
                'phone' => '+6281234567890',
                'bio' => 'Pemilik UMKM Rendang Uni Rina yang telah turun temurun selama 3 generasi.',
                'role' => UserRole::USER,
                'address' => 'Solok, Sumatera Barat',
                'email_verified_at' => now(),
            ]
        );

        UmkmOwner::updateOrCreate(
            ['user_id' => $umkmOwner->id],
            [
                'nik' => '1371016512345678',
                'npwp' => '12.345.678.9-012.345',
                'verified' => true,
            ]
        );

        // 2. User dengan role 'user' dan type MENTOR
        $mentor = User::updateOrCreate(
            ['email' => 'bayu.andrawati@example.com'],
            [
                'name' => 'Bayu Andrawati, S.E., M.M.',
                'password' => Hash::make('password'),
                'phone' => '+6281234567891',
                'bio' => 'Pengusaha sukses asal Padang, kini menetap di Jakarta. Berpengalaman 15+ tahun di bidang F&B dan ekspor kuliner.',
                'role' => UserRole::USER,
                'address' => 'Surabaya, Indonesia',
                'email_verified_at' => now(),
            ]
        );

        $mentorProfile = Mentor::updateOrCreate(
            ['user_id' => $mentor->id],
            [
                'current_job' => 'CEO & Founder - Kuliner Export Co.',
                'experience' => '15+ tahun di bidang F&B, ekspor kuliner, dan manajemen bisnis',
                'about' => 'Mentor berpengalaman dengan fokus pada pengembangan UMKM kuliner dan strategi ekspor produk lokal.',
                'reputation_score' => 4.9,
                'verified' => true,
            ]
        );

        // Add skills untuk mentor (clear existing first to avoid duplicates)
        $mentorProfile->skills()->delete();
        $mentorProfile->skills()->createMany([
            ['skill' => 'Marketing'],
            ['skill' => 'F&B Business'],
            ['skill' => 'Social Media'],
            ['skill' => 'Export Management'],
        ]);

        // 3. User dengan role 'user' dan type FUNDER
        $funder = User::updateOrCreate(
            ['email' => 'ahmad.hidayat@example.com'],
            [
                'name' => 'Ahmad Hidayat',
                'password' => Hash::make('password'),
                'phone' => '+6281234567892',
                'bio' => 'Investor dan entrepreneur diaspora Minangkabau yang fokus pada pengembangan UMKM lokal.',
                'role' => UserRole::USER,
                'address' => 'Jakarta, Indonesia',
                'email_verified_at' => now(),
            ]
        );

        Funder::updateOrCreate(
            ['user_id' => $funder->id],
            [
                'organization_name' => 'Investasi Minang Sejahtera',
                'verified' => true,
            ]
        );

        // 4. User dengan role 'admin'
        User::updateOrCreate(
            ['email' => 'admin@rantauhub.com'],
            [
                'name' => 'Admin RantauHub',
                'password' => Hash::make('password'),
                'phone' => '+6281234567893',
                'bio' => 'Administrator platform RantauHub',
                'role' => UserRole::ADMIN,
                'address' => 'Padang, Sumatera Barat',
                'email_verified_at' => now(),
            ]
        );

        // 5. User dengan role 'user' (regular user tanpa type)
        User::updateOrCreate(
            ['email' => 'budi.santoso@example.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'phone' => '+6281234567894',
                'bio' => 'Pengguna aktif platform RantauHub',
                'role' => UserRole::USER,
                'address' => 'Padang, Sumatera Barat',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Successfully created/updated 5 users with different roles and types!');
        $this->command->info('- UMKM Owner: rina.sari@example.com');
        $this->command->info('- Mentor: bayu.andrawati@example.com');
        $this->command->info('- Funder: ahmad.hidayat@example.com');
        $this->command->info('- Admin: admin@rantauhub.com');
        $this->command->info('- Regular User: budi.santoso@example.com');
        $this->command->info('All passwords are: password');
    }
}

