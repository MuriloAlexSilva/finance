<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class ExpenseType extends Model
{
    protected $table        =   'ExpenseType';
    protected $primaryKey   =   'id_expense_type';

    use SoftDeletes;
}
