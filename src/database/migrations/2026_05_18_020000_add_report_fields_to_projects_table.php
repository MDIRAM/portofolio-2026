<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'slug')) {
                $table->string('slug')->nullable()->after('title')->index();
            }

            if (! Schema::hasColumn('projects', 'status')) {
                $table->string('status')->default('Proposal')->after('technologies');
            }

            if (! Schema::hasColumn('projects', 'progress')) {
                $table->unsignedTinyInteger('progress')->default(0)->after('status');
            }

            if (! Schema::hasColumn('projects', 'problem_analysis')) {
                $table->text('problem_analysis')->nullable()->after('progress');
            }

            if (! Schema::hasColumn('projects', 'system_requirements')) {
                $table->json('system_requirements')->nullable()->after('problem_analysis');
            }

            if (! Schema::hasColumn('projects', 'architecture')) {
                $table->text('architecture')->nullable()->after('system_requirements');
            }

            if (! Schema::hasColumn('projects', 'diagram_steps')) {
                $table->json('diagram_steps')->nullable()->after('architecture');
            }

            if (! Schema::hasColumn('projects', 'report_file')) {
                $table->string('report_file')->nullable()->after('diagram_steps');
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            foreach ([
                'report_file',
                'diagram_steps',
                'architecture',
                'system_requirements',
                'problem_analysis',
                'progress',
                'status',
                'slug',
            ] as $column) {
                if (Schema::hasColumn('projects', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
