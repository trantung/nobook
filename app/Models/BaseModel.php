<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function __construct(array $attributes = [])
    {
        if ($this->connection == 'moodle') {
            $this->table = env('MOODLE_TABLE_PREFIX', 'mdl') . '_' . $this->table;
        }
        parent::__construct($attributes);
    }

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
