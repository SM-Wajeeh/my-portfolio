<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Project;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // ── Skills ──────────────────────────────────────────────────
        $skills = [
            ['icon' => '⚡', 'name' => 'C++ / Systems',     'description' => 'Memory management, templates, RAII, concurrency',    'proficiency' => 92, 'sort_order' => 1],
            ['icon' => '🏗️', 'name' => 'Software Arch.',    'description' => 'Design patterns, ECS, layered architecture',          'proficiency' => 80, 'sort_order' => 2],
            ['icon' => '🎮', 'name' => 'Game Dev',          'description' => 'OpenGL, SDL2, game loops, physics',                   'proficiency' => 75, 'sort_order' => 3],
            ['icon' => '📹', 'name' => 'Content Creation',  'description' => 'Video editing, thumbnail design, branding',           'proficiency' => 85, 'sort_order' => 4],
            ['icon' => '🔧', 'name' => 'Data Structures',   'description' => 'Trees, graphs, hash maps, custom allocators',         'proficiency' => 70, 'sort_order' => 5],
            ['icon' => '🐧', 'name' => 'Linux / CLI',       'description' => 'Bash, GDB, Valgrind, Make, CMake',                   'proficiency' => 65, 'sort_order' => 6],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // ── Projects ────────────────────────────────────────────────
        $projects = [
            [
                'number'      => '05',
                'tag'         => 'Compilers',
                'title'       => 'LEXR',
                'description' => 'A hand-rolled lexer and recursive descent parser for a toy language. Generates an AST, performs semantic analysis, and produces x86-64 assembly output via a custom code-gen pass.',
                'stack'       => 'C++, AST, x86 ASM, Compiler Theory',
                'link'        => '#',
                'bg_image'    => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&w=800&q=80',
                'sort_order'  => 5,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
