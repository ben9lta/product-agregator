<?php

namespace App\Models\Parser;

use App\Models\Category\Category;
use App\Models\ParserOptions\ParserOptions;
use App\Models\Store\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parser extends Model
{
    use SoftDeletes;

    const TABLE_NAME = 'parser';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $with = [
        'option'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function option()
    {
        return $this->belongsTo(ParserOptions::class, 'option_id');
    }
}
