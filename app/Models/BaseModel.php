<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * @var bool
     */
    protected $needFormatTimestamp = false;
    protected static $moodleTableName = '';

    public function __construct(array $attributes = [])
    {
        if ($this->connection == 'moodle') {
            $this->table = moodle_table_name($this->table);
        }
        parent::__construct($attributes);
    }

    /**
     * @return string
     */
    public static function getMoodleTableName(): string
    {
        return moodle_table_name(static::$moodleTableName ?? '');
    }

    /**
     * @param string $fieldName
     * @return string
     */
    public static function field(string $fieldName): string
    {
        return self::getMoodleTableName() . ".$fieldName";
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

    /**
     * @return mixed|string|null
     */
    public function getCreatedAtAttribute($value)
    {
        if (!$this->needFormatTimestamp) {
            return $value;
        }

        return $value ? Carbon::parse($value)->format('Y-m-d H:i:s') : null;
    }

    /**
     * @return mixed|string|null
     */
    public function getUpdatedAtAttribute($value)
    {
        if (!$this->needFormatTimestamp) {
            return $value;
        }

        return $value ? Carbon::parse($value)->format('Y-m-d H:i:s') : null;
    }
}
