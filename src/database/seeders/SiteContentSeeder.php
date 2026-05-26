<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = self::contents();
        $pages = array_values(array_unique(array_column($contents, 0)));
        $activeKeys = [];

        foreach ($contents as [$page, , $key]) {
            $activeKeys[$page . ':' . $key] = true;
        }

        foreach (self::contents() as $index => [$page, $section, $key, $label, $type, $value]) {
            $content = SiteContent::firstOrNew(['page' => $page, 'key' => $key]);

            $content->fill([
                'section' => $section,
                'label' => $label,
                'type' => $type,
                'sort_order' => $index + 1,
                'is_active' => true,
                'is_locked' => true,
            ]);

            if (! $content->exists || blank($content->value)) {
                $content->value = is_array($value) ? json_encode($value) : $value;
            }

            $content->save();
        }

        SiteContent::query()
            ->whereIn('page', $pages)
            ->where('is_locked', true)
            ->get()
            ->each(function (SiteContent $content) use ($activeKeys): void {
                if (! isset($activeKeys[$content->page . ':' . $content->key])) {
                    $content->delete();
                }
            });
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
            ['welcome', 'hero', 'hero_eyebrow', 'Hero eyebrow', 'text', 'Programmer Portfolio'],
            ['welcome', 'hero', 'profile_name', 'Profile name', 'text', 'Dika'],
            ['welcome', 'hero', 'hero_title', 'Hero title', 'text', 'Halo, saya Dika seorang programer.'],
            ['welcome', 'hero', 'hero_summary', 'Hero summary', 'textarea', 'Saya fokus membuat aplikasi web yang cepat, mudah dipakai, dan gampang dikembangkan. Terbiasa membangun fitur dari tampilan, backend, database, sampai deployment.'],
            ['welcome', 'hero', 'hero_buttons', 'Hero buttons', 'json', [
                'projects' => 'Portofolio',
                'report' => 'Laporan UTS',
                'contact' => 'Kontak',
            ]],
            ['welcome', 'hero', 'stack_items', 'Technology stack', 'list', ['Laravel', 'PHP', 'JavaScript', 'MySQL', 'Tailwind CSS']],
            ['welcome', 'hero', 'profile_photo', 'Profile photo', 'image', 'coverimg/dika.png'],
            ['welcome', 'portfolio', 'portfolio_eyebrow', 'Portfolio eyebrow', 'text', 'Portofolio'],
            ['welcome', 'portfolio', 'portfolio_title', 'Portfolio title', 'text', 'Project yang saya kerjakan.'],
            ['welcome', 'portfolio', 'portfolio_text', 'Portfolio text', 'textarea', 'Beberapa project web yang saya buat untuk melatih frontend, backend, database, dan tampilan responsif.'],
            ['welcome', 'portfolio', 'project_card_texts', 'Project card texts', 'json', [
                'progress_aria_prefix' => 'Progress ',
                'progress_aria_suffix' => ' persen',
                'github_label' => 'Lihat GitHub',
                'empty_title' => 'Belum ada project',
                'empty_text' => 'Project yang sudah masuk database akan tampil di bagian ini.',
            ]],
            ['welcome', 'contact', 'contact_eyebrow', 'Contact eyebrow', 'text', 'Contact'],
            ['welcome', 'contact', 'contact_title', 'Contact title', 'text', 'Hubungi saya.'],
            ['welcome', 'contact', 'contact_text', 'Contact text', 'textarea', 'Kirim pesan lewat form ini. Data pesan akan tersimpan ke database dan bisa saya cek dari halaman admin.'],
            ['welcome', 'contact', 'contact_note', 'Contact note', 'textarea', 'Terbuka untuk diskusi project, kerja sama, atau pertanyaan seputar website yang saya buat.'],
            ['welcome', 'contact', 'contact_labels', 'Contact labels', 'json', [
                'name' => 'Nama',
                'email' => 'Email',
                'subject' => 'Subjek',
                'message' => 'Pesan',
                'submit' => 'Kirim Pesan',
                'success' => 'Pesan berhasil dikirim. Terima kasih sudah menghubungi saya.',
            ]],

            ['projects.show', 'meta', 'title_suffix', 'Title suffix', 'text', ' - Laporan Awal'],
            ['projects.show', 'header', 'back_label', 'Back label', 'text', 'Kembali ke Portfolio'],
            ['projects.show', 'header', 'page_badge', 'Page badge', 'text', 'Laporan Awal Project Akhir'],
            ['projects.show', 'hero', 'hero_eyebrow', 'Hero eyebrow', 'text', 'Showcase / Project'],
            ['projects.show', 'hero', 'action_buttons', 'Action buttons', 'json', [
                'github' => 'Source Code GitHub',
                'live' => 'Live Demo',
                'report' => 'PDF Laporan',
            ]],
            ['projects.show', 'status', 'status_labels', 'Status labels', 'json', [
                'status' => 'Status Progress',
                'percentage' => 'Persentase',
                'progress_aria_prefix' => 'Progress ',
                'progress_aria_suffix' => ' persen',
                'tech_stack_aria' => 'Tech stack',
            ]],
            ['projects.show', 'content', 'content_headings', 'Content headings', 'json', [
                'analysis' => 'Analisis Masalah',
                'requirements' => 'Kebutuhan Sistem',
                'architecture' => 'Arsitektur & Tech Stack',
                'implementation' => 'Implementasi Teknis',
                'diagram' => 'Rencana Perancangan Sistem',
            ]],
            ['projects.show', 'content', 'empty_texts', 'Empty texts', 'json', [
                'analysis' => 'Analisis masalah belum diisi dari panel admin.',
                'requirements' => 'Kebutuhan sistem belum diisi dari panel admin.',
                'architecture' => 'Arsitektur dan tech stack belum diisi dari panel admin.',
                'diagram' => 'Flowchart belum diisi dari panel admin.',
            ]],
            ['projects.show', 'content', 'implementation_heading', 'Implementation heading', 'text', 'Implementasi Teknis'],
            ['projects.show', 'content', 'implementation_text', 'Implementation text', 'textarea', 'Website menggunakan pola MVC Laravel, database MySQL, halaman publik portfolio, form kontak dinamis, dan panel admin Filament untuk CRUD project serta monitoring pesan masuk.'],

            ['reports.show', 'meta', 'title_suffix', 'Title suffix', 'text', ' - Laporan Project'],
            ['reports.show', 'header', 'back_label', 'Back label', 'text', 'Kembali ke Portfolio'],
            ['reports.show', 'content', 'section_headings', 'Section headings', 'json', [
                'problem' => 'Analisis Masalah & Kebutuhan Sistem',
                'features' => 'Fitur Utama',
                'architecture' => 'Arsitektur & Tech Stack',
                'technologies' => 'Teknologi yang Digunakan',
                'diagrams' => 'Rencana Perancangan Diagram',
            ]],
            ['reports.show', 'content', 'pdf_button_label', 'PDF button label', 'text', 'Buka PDF Lengkap'],

            ['reports.uts', 'meta', 'meta_title', 'Meta title', 'text', 'Laporan UTS - Portfolio Dika'],
            ['reports.uts', 'header', 'back_label', 'Back label', 'text', 'Kembali ke Portfolio'],
            ['reports.uts', 'header', 'top_badge', 'Top badge', 'text', 'Halaman Laporan UTS'],
            ['reports.uts', 'hero', 'hero_eyebrow', 'Hero eyebrow', 'text', 'PDF Laporan'],
            ['reports.uts', 'hero', 'hero_title', 'Hero title', 'text', 'Laporan UTS Portfolio'],
            ['reports.uts', 'hero', 'hero_lead', 'Hero lead', 'textarea', 'Halaman ini khusus untuk menampilkan file laporan UTS dalam bentuk PDF, terpisah dari halaman utama dan halaman detail project.'],
            ['reports.uts', 'hero', 'open_pdf_label', 'Open PDF label', 'text', 'Buka PDF'],
            ['reports.uts', 'pdf', 'pdf_preview_label', 'PDF preview label', 'text', 'Preview PDF Laporan UTS'],
        ];
    }

}
