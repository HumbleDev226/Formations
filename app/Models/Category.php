<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['nom'];
   

    // Définissez la relation One-to-Many avec les cours si nécessaire
    public function courses()
    {
        return $this->hasMany(Course::class, 'categorie', 'nom');
    }





}


