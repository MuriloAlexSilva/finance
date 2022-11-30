<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Expense extends Model
{
    protected $table        =   'Expense';
    protected $primaryKey   =   'id_expense';

    use SoftDeletes;
}
