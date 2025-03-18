<?php

namespace App\Modules\Reports\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property  int $cod_l Código do livro.
 * @property string $titulo Título do livro.
 * @property string $editora Nome da editora.
 * @property string $ano_publicacao Ano de publicação.
 * @property int $edicao Edição do livro.
 * @property float $valor Preço do livro.
 * @property string $autores Nome do autor.
 * @property string $assuntos Assunto do livro (ex.: gênero, tema).
 */
class VwBooksReport extends Model
{
    use HasFactory;

    protected $table = 'vw_books_report';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;
}
