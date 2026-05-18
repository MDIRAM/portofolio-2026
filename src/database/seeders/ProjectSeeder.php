<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::updateOrCreate(
            ['slug' => 'website-portfolio-personal-dinamis'],
            [
                'title' => 'Website Portfolio Personal Dinamis',
                'description' => 'Website portfolio untuk menampilkan profil profesional, daftar project, form kontak, dan laporan awal project akhir secara dinamis dari database.',
                'technologies' => ['Laravel', 'Filament', 'MySQL', 'Blade', 'Tailwind CSS'],
                'status' => 'Progress',
                'progress' => 65,
                'problem_analysis' => 'Banyak portfolio mahasiswa masih statis sehingga data project, progress, dan pesan kontak sulit diperbarui. Sistem ini dibuat agar pemilik portfolio bisa mengelola konten, laporan awal, dan pesan masuk lewat panel admin tanpa mengubah kode secara langsung.',
                'system_requirements' => [
                    'Halaman Home/About berisi profil, bio singkat, dan stack keahlian.',
                    'Halaman Showcase menampilkan daftar project dari database.',
                    'Halaman detail project menampilkan laporan awal project akhir.',
                    'Form Contact menyimpan pesan pengunjung ke database.',
                    'Panel admin menyediakan CRUD project dan pesan kontak.',
                ],
                'architecture' => 'Aplikasi menggunakan arsitektur MVC Laravel. Model Project dan ContactMessage mengelola data, route/controller closure menangani request publik, Blade menampilkan halaman portfolio, MySQL menyimpan data, dan Filament dipakai sebagai panel admin untuk CRUD.',
                'diagram_steps' => [
                    'Pengunjung membuka halaman portfolio.',
                    'Sistem mengambil daftar project aktif dari database.',
                    'Pengunjung memilih detail laporan awal project.',
                    'Sistem menampilkan analisis, kebutuhan, arsitektur, dan flowchart.',
                    'Pengunjung mengirim pesan lewat form kontak.',
                    'Admin membaca pesan dan memperbarui progress lewat panel admin.',
                ],
                'github_url' => 'https://github.com/MDIRAM/portofolio',
                'sort_order' => 0,
                'is_active' => true,
            ],
        );

        Project::updateOrCreate(
            ['github_url' => 'https://github.com/MDIRAM/2D-3D-Kalkulus-2.git'],
            [
                'title' => '2D & 3D Kalkulus 2',
                'slug' => '2d-3d-kalkulus-2',
                'description' => 'Project pembelajaran kalkulus yang menampilkan visualisasi 2D dan 3D supaya materi matematika lebih mudah dipahami.',
                'technologies' => ['Kalkulus', '2D', '3D'],
                'status' => 'Selesai',
                'progress' => 100,
                'problem_analysis' => 'Materi kalkulus sering sulit dipahami jika hanya disajikan dalam bentuk rumus. Visualisasi membantu pengguna melihat bentuk grafik dan hubungan antar konsep.',
                'system_requirements' => ['Visualisasi grafik 2D', 'Visualisasi objek 3D', 'Antarmuka pembelajaran yang mudah digunakan'],
                'architecture' => 'Project berfokus pada visualisasi interaktif dengan pemisahan tampilan, logika perhitungan, dan aset visual.',
                'diagram_steps' => ['Pengguna memilih materi', 'Sistem memproses parameter', 'Grafik 2D/3D ditampilkan', 'Pengguna mengeksplorasi hasil visualisasi'],
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        Project::updateOrCreate(
            ['github_url' => 'https://github.com/MDIRAM/TierlistMu.git'],
            [
                'title' => 'TierlistMu',
                'slug' => 'tierlistmu',
                'description' => 'Aplikasi web untuk membuat dan mengelola tier list dengan tampilan yang mudah dipakai.',
                'technologies' => ['Laravel', 'PHP', 'MySQL'],
                'status' => 'Selesai',
                'progress' => 100,
                'problem_analysis' => 'Pengguna membutuhkan cara cepat untuk menyusun ranking item secara visual dan menyimpan hasilnya.',
                'system_requirements' => ['CRUD kategori tier', 'Manajemen item', 'Tampilan tier list responsif'],
                'architecture' => 'Aplikasi menggunakan backend PHP dan database MySQL untuk menyimpan data tier list, dengan halaman web sebagai antarmuka utama.',
                'diagram_steps' => ['Pengguna membuat tier list', 'Pengguna menambah item', 'Sistem menyimpan perubahan', 'Tier list ditampilkan kembali'],
                'sort_order' => 2,
                'is_active' => true,
            ],
        );
    }
}
