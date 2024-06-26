// app/Models/Course.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['logo', 'titre', 'description', 'modules', 'categorie', 'auteur', 'date', 'fichier', 'prix'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie', 'nom');
    }
}
