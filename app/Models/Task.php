<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     *
     *  tasks is TableName
     */
    protected $table='tasks';

    /**
     *
     * fillable is columns name table
     * @var array
     */
    protected  $fillable=[
      'name',
      'note',
      'user_id',
      'created_at',
      'updated_at'
    ];

    /**
     *
     *  RelationShip User by column task_id
     *  @var array
     *
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
