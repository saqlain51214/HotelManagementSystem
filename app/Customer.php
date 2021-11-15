<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'father_name', 'customer_type','gender', 'country', 'province', 'city', 'phone_number', 'cell_number', 'cnic', 'passport', 'cnic_or_passport_expiry_date', 'address', 'customer_status', 'tour_reason', 'next_destination'];

    
}
