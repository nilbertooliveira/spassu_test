<?php

namespace App\Modules\Books\Infrastructure\Models;

use App\Modules\Authors\Infrastructure\Models\Author;
use App\Modules\Subjects\Infrastructure\Models\Subject;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property int $Codl
 * @property string $Titulo
 * @property int $Edicao
 * @property string $Editora
 * @property string $AnoPublicacao
 * @property float $Valor
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Collection $authors
 * @property Collection $subjects
 */
class Book extends Model
{
    use HasFactory;

    protected $table = 'Livro';

    protected $primaryKey = 'Codl';

    protected $fillable = [
        'Titulo',
        'Edicao',
        'Editora',
        'AnoPublicacao',
        'Valor',
    ];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'Livro_Autor', 'Livro_Codl', 'Autor_CodAu');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'Livro_Assunto', 'Livro_Codl', 'Assunto_codAs');
    }
}
