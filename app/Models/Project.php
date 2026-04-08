<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['number', 'tag', 'title', 'description', 'stack', 'link', 'bg_image', 'sort_order'];

    // Returns stack as array for easy looping in Blade
    public function getStackArrayAttribute(): array
    {
        return array_map('trim', explode(',', $this->stack));
    }
}
