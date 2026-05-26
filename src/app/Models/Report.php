<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'slug',
        'project_title',
        'short_description',
        'problem_analysis',
        'system_features',
        'architecture',
        'tech_stack',
        'diagrams',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'system_features' => 'array',
            'tech_stack' => 'array',
            'diagrams' => 'array',
            'is_published' => 'boolean',
        ];
    }
}
