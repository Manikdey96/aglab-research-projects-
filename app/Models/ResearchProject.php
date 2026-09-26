<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ResearchProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'principal_investigator',
        'research_area',
        'funding_source',
        'budget',
        'status',
        'start_date',
        'end_date',
        'image',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'budget'     => 'decimal:2',
    ];

    /**
     * Automatically generate a unique slug from the title when creating.
     */
    protected static function booted(): void
    {
        static::creating(function (ResearchProject $project) {
            if (empty($project->slug)) {
                $project->slug = static::generateUniqueSlug($project->title);
            }
        });
    }

    public static function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count;
            $count++;
        }

        return $slug;
    }

    /**
     * Nicely formatted status badge color helper (used in Blade views).
     */
    public function statusColor(): string
    {
        return match ($this->status) {
            'ongoing'   => 'primary',
            'completed' => 'success',
            'upcoming'  => 'warning',
            default     => 'secondary',
        };
    }
}
