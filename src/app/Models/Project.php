<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'technologies',
        'status',
        'progress',
        'problem_analysis',
        'system_requirements',
        'architecture',
        'diagram_steps',
        'report_file',
        'github_url',
        'live_url',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'system_requirements' => 'array',
            'diagram_steps' => 'array',
            'progress' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Project $project) {
            if (blank($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
