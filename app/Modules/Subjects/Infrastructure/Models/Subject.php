<?php

namespace App\Modules\Subjects\Infrastructure\Models;

use App\Modules\Books\Infrastructure\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $codAs
 * @property string $Descricao
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Subject extends Model
{
    use HasFactory;

    protected $table = 'Assunto';

    protected $primaryKey = 'codAs';

    protected $fillable = [
        'Descricao',
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'Livro_Assunto', 'Assunto_codAs', 'Livro_Codl');
    }
}
