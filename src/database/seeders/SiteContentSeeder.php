<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        foreach (self::contents() as $index => [$page, $section, $key, $label, $type, $value]) {
            SiteContent::updateOrCreate(
                ['page' => $page, 'key' => $key],
                [
                    'section' => $section,
                    'label' => $label,
                    'type' => $type,
                    'value' => is_array($value) ? json_encode($value) : $value,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                    'is_locked' => true,
                ],
            );
        }
    }

    public static function valuesForPage(string $page): array
    {
        $values = [];

        foreach (self::contents() as [$contentPage, , $key, , $type, $value]) {
            if ($contentPage === $page) {
                $values[$key] = in_array($type, ['json', 'list'], true) && is_string($value)
                    ? json_decode($value, true)
                    : $value;
            }
        }

        return $values;
    }

    public static function contents(): array
    {
        return [
            ['welcome', 'meta', 'meta_title', 'Meta title', 'text', 'Programmer Portfolio'],
            ['welcome', 'hero', 'hero_aria', 'Hero aria label', 'text', 'Programmer portfolio introduction'],
            ['welcome', 'hero', 'hero_eyebrow', 'Hero eyebrow', 'text', 'Programmer Portfolio'],
            ['welcome', 'hero', 'hero_title_prefix', 'Hero title prefix', 'text', 'Halo, saya '],
            ['welcome', 'hero', 'hero_title_name', 'Hero title name', 'text', 'Dika'],
            ['welcome', 'hero', 'hero_title_suffix', 'Hero title suffix', 'text', ' seorang programer.'],
            ['welcome', 'hero', 'hero_summary', 'Hero summary', 'textarea', 'Saya fokus membuat aplikasi web yang cepat, mudah dipakai, dan gampang dikembangkan. Terbiasa membangun fitur dari tampilan, backend, database, sampai deployment.'],
            ['welcome', 'hero', 'button_projects', 'Portfolio button', 'text', 'Portofolio'],
            ['welcome', 'hero', 'button_report', 'Report button', 'text', 'Laporan UTS'],
            ['welcome', 'hero', 'button_contact', 'Contact button', 'text', 'Kontak'],
            ['welcome', 'hero', 'stack_aria', 'Stack aria label', 'text', 'Technology stack'],
            ['welcome', 'hero', 'stack_items', 'Technology stack', 'list', ['Laravel', 'PHP', 'JavaScript', 'MySQL', 'Tailwind CSS']],
            ['welcome', 'hero', 'photo_fallback', 'Photo fallback', 'text', '</>'],
            ['welcome', 'hero', 'photo_alt', 'Photo alt text', 'text', 'Foto profil Dika'],
            ['welcome', 'portfolio', 'portfolio_aria', 'Portfolio aria label', 'text', 'Portfolio projects'],
            ['welcome', 'portfolio', 'portfolio_eyebrow', 'Portfolio eyebrow', 'text', 'Portofolio'],
            ['welcome', 'portfolio', 'portfolio_title', 'Portfolio title', 'text', 'Project yang saya kerjakan.'],
            ['welcome', 'portfolio', 'portfolio_text', 'Portfolio text', 'textarea', 'Beberapa project web yang saya buat untuk melatih frontend, backend, database, dan tampilan responsif.'],
            ['welcome', 'portfolio', 'project_progress_aria_prefix', 'Project progress aria prefix', 'text', 'Progress '],
            ['welcome', 'portfolio', 'project_progress_aria_suffix', 'Project progress aria suffix', 'text', ' persen'],
            ['welcome', 'portfolio', 'project_github_label', 'Project GitHub label', 'text', 'Lihat GitHub'],
            ['welcome', 'portfolio', 'project_empty_title', 'Empty project title', 'text', 'Belum ada project'],
            ['welcome', 'portfolio', 'project_empty_text', 'Empty project text', 'textarea', 'Project yang sudah masuk database akan tampil di bagian ini.'],
            ['welcome', 'contact', 'contact_aria', 'Contact aria label', 'text', 'Contact form'],
            ['welcome', 'contact', 'contact_eyebrow', 'Contact eyebrow', 'text', 'Contact'],
            ['welcome', 'contact', 'contact_title', 'Contact title', 'text', 'Hubungi saya.'],
            ['welcome', 'contact', 'contact_text', 'Contact text', 'textarea', 'Kirim pesan lewat form ini. Data pesan akan tersimpan ke database dan bisa saya cek dari halaman admin.'],
            ['welcome', 'contact', 'contact_note', 'Contact note', 'textarea', 'Terbuka untuk diskusi project, kerja sama, atau pertanyaan seputar website yang saya buat.'],
            ['welcome', 'contact', 'contact_label_name', 'Name field label', 'text', 'Nama'],
            ['welcome', 'contact', 'contact_label_email', 'Email field label', 'text', 'Email'],
            ['welcome', 'contact', 'contact_label_subject', 'Subject field label', 'text', 'Subjek'],
            ['welcome', 'contact', 'contact_label_message', 'Message field label', 'text', 'Pesan'],
            ['welcome', 'contact', 'contact_submit_label', 'Contact submit label', 'text', 'Kirim Pesan'],
            ['welcome', 'contact', 'contact_success_message', 'Contact success message', 'textarea', 'Pesan berhasil dikirim. Terima kasih sudah menghubungi saya.'],

            ['projects.show', 'meta', 'title_suffix', 'Title suffix', 'text', ' - Laporan Awal'],
            ['projects.show', 'header', 'back_label', 'Back label', 'text', 'Kembali ke Portfolio'],
            ['projects.show', 'header', 'page_badge', 'Page badge', 'text', 'Laporan Awal Project Akhir'],
            ['projects.show', 'hero', 'hero_eyebrow', 'Hero eyebrow', 'text', 'Showcase / Project'],
            ['projects.show', 'hero', 'github_button', 'GitHub button', 'text', 'Source Code GitHub'],
            ['projects.show', 'hero', 'live_button', 'Live button', 'text', 'Live Demo'],
            ['projects.show', 'hero', 'report_button', 'Report button', 'text', 'PDF Laporan'],
            ['projects.show', 'status', 'status_label', 'Status label', 'text', 'Status Progress'],
            ['projects.show', 'status', 'percentage_label', 'Percentage label', 'text', 'Persentase'],
            ['projects.show', 'status', 'progress_aria_prefix', 'Progress aria prefix', 'text', 'Progress '],
            ['projects.show', 'status', 'progress_aria_suffix', 'Progress aria suffix', 'text', ' persen'],
            ['projects.show', 'status', 'tech_stack_aria', 'Tech stack aria label', 'text', 'Tech stack'],
            ['projects.show', 'content', 'analysis_heading', 'Analysis heading', 'text', 'Analisis Masalah'],
            ['projects.show', 'content', 'analysis_empty', 'Analysis empty text', 'textarea', 'Analisis masalah belum diisi dari panel admin.'],
            ['projects.show', 'content', 'requirements_heading', 'Requirements heading', 'text', 'Kebutuhan Sistem'],
            ['projects.show', 'content', 'requirements_empty', 'Requirements empty text', 'textarea', 'Kebutuhan sistem belum diisi dari panel admin.'],
            ['projects.show', 'content', 'architecture_heading', 'Architecture heading', 'text', 'Arsitektur & Tech Stack'],
            ['projects.show', 'content', 'architecture_empty', 'Architecture empty text', 'textarea', 'Arsitektur dan tech stack belum diisi dari panel admin.'],
            ['projects.show', 'content', 'implementation_heading', 'Implementation heading', 'text', 'Implementasi Teknis'],
            ['projects.show', 'content', 'implementation_text', 'Implementation text', 'textarea', 'Website menggunakan pola MVC Laravel, database MySQL, halaman publik portfolio, form kontak dinamis, dan panel admin Filament untuk CRUD project serta monitoring pesan masuk.'],
            ['projects.show', 'content', 'diagram_heading', 'Diagram heading', 'text', 'Rencana Perancangan Sistem'],
            ['projects.show', 'content', 'diagram_empty', 'Diagram empty text', 'textarea', 'Flowchart belum diisi dari panel admin.'],

            ['reports.show', 'meta', 'title_suffix', 'Title suffix', 'text', ' - Laporan Project'],
            ['reports.show', 'header', 'back_label', 'Back label', 'text', 'Kembali ke Portfolio'],
            ['reports.show', 'content', 'problem_heading', 'Problem heading', 'text', 'Analisis Masalah & Kebutuhan Sistem'],
            ['reports.show', 'content', 'features_heading', 'Features heading', 'text', 'Fitur Utama'],
            ['reports.show', 'content', 'architecture_heading', 'Architecture heading', 'text', 'Arsitektur & Tech Stack'],
            ['reports.show', 'content', 'technologies_heading', 'Technologies heading', 'text', 'Teknologi yang Digunakan'],
            ['reports.show', 'content', 'diagrams_heading', 'Diagrams heading', 'text', 'Rencana Perancangan Diagram'],
            ['reports.show', 'content', 'pdf_button_label', 'PDF button label', 'text', 'Buka PDF Lengkap'],

            ['reports.uts', 'meta', 'meta_title', 'Meta title', 'text', 'Laporan UTS - Portfolio Dika'],
            ['reports.uts', 'header', 'back_label', 'Back label', 'text', 'Kembali ke Portfolio'],
            ['reports.uts', 'header', 'top_badge', 'Top badge', 'text', 'Halaman Laporan UTS'],
            ['reports.uts', 'hero', 'hero_eyebrow', 'Hero eyebrow', 'text', 'PDF Laporan'],
            ['reports.uts', 'hero', 'hero_title', 'Hero title', 'text', 'Laporan UTS Portfolio'],
            ['reports.uts', 'hero', 'hero_lead', 'Hero lead', 'textarea', 'Halaman ini khusus untuk menampilkan file laporan UTS dalam bentuk PDF, terpisah dari halaman utama dan halaman detail project.'],
            ['reports.uts', 'hero', 'open_pdf_label', 'Open PDF label', 'text', 'Buka PDF'],
            ['reports.uts', 'pdf', 'pdf_shell_aria', 'PDF shell aria label', 'text', 'Preview PDF Laporan UTS'],
            ['reports.uts', 'pdf', 'iframe_title', 'Iframe title', 'text', 'Preview PDF Laporan UTS'],
        ];
    }

}
