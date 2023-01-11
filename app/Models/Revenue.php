<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Revenue extends Model
{
    protected $table        =   'revenue';
    protected $primaryKey   =   'id_revenue';

    use SoftDeletes;
    use HasFactory;
}
