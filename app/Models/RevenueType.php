<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class RevenueType extends Model
{
    protected $table        =   'RevenueType';
    protected $primaryKey   =   'id_revenue_type';

    use SoftDeletes;
    use HasFactory;
}
