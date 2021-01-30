<?php

namespace App\Models\Category;

use App\Http\Requests\CategoryRequest;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property string $icon
 * @property string $description
 * @property string $slug
 * @property integer $parent_id
 * @property integer $order
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Category extends Model
{
    use SoftDeletes;
    use Sluggable;

    const ATTR_ID          = 'id';
    const ATTR_NAME        = 'name';
    const ATTR_IMG         = 'img';
    const ATTR_ICON        = 'icon';
    const ATTR_DESCRIPTION = 'description';
    const ATTR_SLUG        = 'slug';
    const ATTR_ORDER       = 'order';
    const ATTR_STATUS      = 'status';
    const ATTR_PARENT_ID   = 'parent_id';
    const ATTR_CREATED_AT  = 'created_at';
    const ATTR_UPDATED_AT  = 'updated_at';

    const TABLE_NAME = 'categories';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_DESCRIPTION,
        self::ATTR_ORDER,
        self::ATTR_STATUS,
        self::ATTR_PARENT_ID,
    ];

    public function getImgUrl()
    {
        return $this->img ? url('storage/' . $this->img) : asset('admin_assets/img/no_image.png');
    }

    public function getIconUrl()
    {
        return $this->icon ? url('storage/' . $this->icon) : null;
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

}
