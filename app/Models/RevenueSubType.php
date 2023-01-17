<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class RevenueSubType extends Model
{
    protected $table        =   'RevenueSubType';
    protected $primaryKey   =   'id_revenue_sub_type';

    use SoftDeletes;
    use HasFactory;
}
