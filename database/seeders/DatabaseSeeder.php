<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Donation;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::insert([
            [
                'name' => 'Yunus Febriansyah',
                'email' => 'yunus@dc.id',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Budi Antasalam',
                'email' => 'budi@dc.id',
                'password' => bcrypt('password'),
                'role' => 'user',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        Category::insert([
            [
                'name' => 'Zakat',
                'icon' => 'category-photos/zakat.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pembangunan Masjid',
                'icon' => 'category-photos/masjid.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bencana Alam',
                'icon' => 'category-photos/bencana-alam.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Panti Asuhan',
                'icon' => 'category-photos/panti-asuhan.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        Donation::insert([
            [
                'category_id' => 1,
                'title' => 'Zakat Fitrah',
                'description' => 'Zakat fitrah adalah zakat yang wajib dikeluarkan oleh setiap muslim yang mampu pada bulan Ramadhan.',
                'image' => 'donation-photos/donasi-1.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'title' => 'Pembangunan Masjid Al-Ikhlas',
                'description' => 'Pembangunan masjid Al-Ikhlas di kampung kami yang sangat membutuhkan bantuan.',
                'image' => 'donation-photos/donasi-2.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3,
                'title' => 'Galangan Dana Banjir',
                'description' => 'Bantu korban banjir di kota kami yang terkena musibah banjir bandang.',
                'image' => 'donation-photos/donasi-3.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 4,
                'title' => 'Donasi Yatim Piatu',
                'description' => 'Bantu anak yatim piatu di panti asuhan kami yang sangat membutuhkan uluran tangan.',
                'image' => 'donation-photos/donasi-4.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
