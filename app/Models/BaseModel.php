<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * @var string
     */
    public $orderColumn = 'order';

    /**
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    /**
     * @return $this
     */
    public static function createNewInstance(): Model
    {
        return self::query()->make();
    }

    /**
     * @return $this
     */
    public function cloneAttribute(): Model
    {
        return self::createNewInstance()->fill($this->attributesToArray());
    }
}
