<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @author Afanasyev Pavel <bupyc9@gmail.com>
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property int $external_id
 * @method static Builder|StopPoint whereName($value)
 * @method static Builder|StopPoint whereExternalId($value)
 */
class StopPoint extends Model
{
    protected $fillable = ['name', 'external_id'];
}