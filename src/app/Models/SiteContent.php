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
        if (in_array($this->type, ['json', 'list'], true)) {
            $decoded = json_decode($this->value ?: '[]', true);

            return is_array($decoded) ? $decoded : [];
        }

        return $this->value;
    }
}
