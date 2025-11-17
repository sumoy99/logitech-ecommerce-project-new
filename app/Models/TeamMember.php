<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'designation', 'description','social_icon_url', 'skill_title', 'skill_subtitle', 'skill_name_level', 'senior_team_member', 'image', 'updated_at', 'created_at'
    ];
}
