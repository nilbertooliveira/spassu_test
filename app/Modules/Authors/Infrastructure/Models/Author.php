<?php

namespace App\Modules\Authors\Infrastructure\Models;

use App\Modules\Books\Infrastructure\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property integer $CodAu
 * @property string $Nome
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Author extends Model
{
    use HasFactory;

    protected $table = 'Autor';
    protected $primaryKey = 'CodAu';
    protected $fillable = [
        'Nome',
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'Livro_Autor', 'Autor_CodAu', 'Livro_Codl');
    }
}
