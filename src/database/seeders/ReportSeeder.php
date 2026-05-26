<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        Report::updateOrCreate(
            ['slug' => 'panduangame'],
            [
                'project_title' => 'PanduanGame - Walkthrough Game Hub Sistem Panduan',
                'short_description' => 'PanduanGame adalah website pusat panduan game yang mengumpulkan daftar game, ringkasan, kategori, dan walkthrough dalam satu platform yang rapi. Solusi ini membantu pemain menemukan informasi permainan dengan lebih cepat tanpa harus membuka banyak sumber terpisah.',
                'problem_analysis' => 'Banyak pemain masih mencari panduan game dari forum, video, media sosial, atau artikel yang tersebar. Kondisi ini membuat informasi sulit dibandingkan, memakan waktu, dan kurang nyaman bagi pemain baru yang membutuhkan arahan tentang misi, item, karakter, level sulit, atau strategi bermain. Sistem dibutuhkan untuk menyajikan panduan yang terstruktur, mudah dicari, dapat dikelola admin, dan berjalan konsisten di lingkungan pengembangan maupun deployment.',
                'system_features' => [
                    'Menampilkan daftar game lengkap dengan deskripsi dan kategori.',
                    'Menyediakan halaman detail game berisi informasi game dan panduan bermain.',
                    'Mendukung pencarian serta filter berdasarkan nama game atau kategori.',
                    'Menyediakan CRUD untuk data game, kategori, dan panduan melalui backend Laravel.',
                    'Mendukung autentikasi pengguna untuk login dan registrasi.',
                    'Menggunakan tampilan responsif berbasis Blade dan CSS.',
                    'Dijalankan dalam lingkungan Docker Compose yang memuat Nginx, PHP-FPM, dan MySQL.',
                ],
                'architecture' => 'Aplikasi menggunakan arsitektur client-server berbasis Laravel MVC. Request pengguna diterima oleh Nginx, diteruskan ke PHP-FPM, lalu diproses oleh Laravel. Model Eloquent mengelola data pada MySQL, Blade merender antarmuka, dan Docker Compose mengorkestrasi layanan app, webserver, serta database agar lingkungan berjalan konsisten.',
                'tech_stack' => [
                    [
                        'name' => 'Laravel',
                        'description' => 'Framework PHP dengan pola MVC untuk routing, model Eloquent, validasi, dan pengelolaan logika aplikasi.',
                    ],
                    [
                        'name' => 'Blade',
                        'description' => 'Template engine Laravel untuk membuat halaman HTML dinamis.',
                    ],
                    [
                        'name' => 'MySQL',
                        'description' => 'Database relasional untuk menyimpan data game, kategori, panduan, dan pengguna.',
                    ],
                    [
                        'name' => 'Nginx',
                        'description' => 'Web server dan reverse proxy yang meneruskan request ke PHP-FPM.',
                    ],
                    [
                        'name' => 'Docker Compose',
                        'description' => 'Orkestrasi container untuk layanan PHP-FPM, Nginx, dan MySQL.',
                    ],
                ],
                'diagrams' => [
                    [
                        'title' => 'Use Case Diagram',
                        'image_path' => 'coverimg/USE CASE.png',
                        'description' => 'Menjelaskan interaksi pengguna dan admin dengan fitur utama sistem.',
                    ],
                    [
                        'title' => 'Flowchart Sistem',
                        'image_path' => 'coverimg/FlowChart.png',
                        'description' => 'Menggambarkan alur penggunaan sistem mulai dari membuka website hingga membaca panduan.',
                    ],
                    [
                        'title' => 'Entity Relationship Diagram',
                        'image_path' => 'coverimg/ERD.png',
                        'description' => 'Menunjukkan rancangan relasi data utama seperti users, games, categories, dan guides.',
                    ],
                ],
                'is_published' => true,
            ],
        );
    }
}
