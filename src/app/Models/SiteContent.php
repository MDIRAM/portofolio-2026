<?php

namespace App\Models;

use Database\Seeders\SiteContentSeeder;
use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $fillable = [
        'page',
        'section',
        'key',
        'label',
        'type',
        'value',
        'sort_order',
        'is_active',
        'is_locked',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'is_locked' => 'boolean',
        ];
    }

    public static function valuesForPage(string $page): array
    {
        $values = static::query()
            ->where('page', $page)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->mapWithKeys(fn (SiteContent $content): array => [
                $content->key => $content->decodedValue(),
            ])
            ->all();

        return array_replace(SiteContentSeeder::valuesForPage($page), $values);
    }

    public static function value(string $page, string $key, mixed $default = null): mixed
    {
        $content = static::query()
            ->where('page', $page)
            ->where('key', $key)
            ->where('is_active', true)
            ->first();

        return $content?->decodedValue() ?? SiteContentSeeder::valuesForPage($page)[$key] ?? $default;
    }

    public function decodedValue(): mixed
    {
        if ($this->type === 'image') {
            $decoded = json_decode($this->value ?: '', true);

            return is_array($decoded) ? ($decoded['path'] ?? '') : $this->value;
        }

        if (in_array($this->type, ['json', 'list'], true)) {
            $decoded = json_decode($this->value ?: '[]', true);

            return is_array($decoded) ? $decoded : [];
        }

        return $this->value;
    }

    public static function mediaUrl(?string $path, string $fallback): string
    {
        $path = filled($path) ? $path : $fallback;

        if (blank($path)) {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (
            str_starts_with($path, 'coverimg/')
            || str_starts_with($path, 'files/')
            || str_starts_with($path, 'storage/')
        ) {
            return asset($path);
        }

        return asset('storage/' . ltrim($path, '/'));
    }
}
