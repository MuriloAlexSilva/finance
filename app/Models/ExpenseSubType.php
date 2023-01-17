<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class ExpenseSubType extends Model
{
    protected $table        =   'ExpenseSubType';
    protected $primaryKey   =   'id_expense_sub_type';

    use SoftDeletes;
    use HasFactory;

}