<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'symbol';
    protected $casts = [
        'tags' => 'array',
    ];
    public $incrementing = false;

    protected $fillable = [
        'symbol', 'companyName', 'exchange', 'industry', 'website', 'description', 'CEO', 'securityName', 'issueType',
        'sector', 'primarySicCode', 'employees', 'tags', 'address', 'address2', 'state', 'city', 'zip', 'country', 'phone',
    ];
}
