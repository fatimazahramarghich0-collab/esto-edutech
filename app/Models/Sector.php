<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough; // Déplacez cette ligne ici

/**
 * @method static findOrFail($id)
 */
class Sector extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'sectors';

    protected $guarded = [];

    protected $fillable = ['name', 'ChefFil', 'description', 'department_id'];

    public function departments(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'sectors', 'department_id', 'id');
    }


    function students() : HasMany {
        return $this->hasMany(Student::class);
    }

    public function modules() {
        return $this->hasManyThrough(Module::class, Semester::class, 'sector_id', 'semester_id');
    }
    // Relation avec le semestre

    // Dans le modèle Sector
    // Dans votre modèle Sector
    // Dans le modèle Sector, définissez la relation avec les semestres
    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }
    // Associe le secteur à son chef de filière
    public function chefDeFiliere()
    {
        return $this->belongsTo(Teacher::class, 'ChefFil');
    }


}
