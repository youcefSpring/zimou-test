<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Store extends Model
{
    use HasFactory;
    protected $primay_key="id";
    protected $fillable = ['code', 'name', 'email', 'phones',
                           'company_name', 'capital', 'address',
                            'register_commerce_number', 'nif',
                            'legal_form', 'status',
                            'can_update_preparing_packages'
                          ];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
