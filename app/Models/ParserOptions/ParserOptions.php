<?php

namespace App\Models\ParserOptions;

use App\Models\Parser\Parser;
use Illuminate\Database\Eloquent\Model;

class ParserOptions extends Model
{
    const TABLE_NAME = 'parser_options';

    protected $fillable = [
        'name',
        'description',
        'img',
        'price',
        'old_price',
        'count',
        'period',
        'encoding',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function parser()
    {
        return $this->hasOne(Parser::class, 'option_id');
    }
}
