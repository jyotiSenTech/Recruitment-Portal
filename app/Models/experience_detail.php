<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class experience_detail extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps

    protected $table = 'applicant_experience_details';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'Applicant_ID',
        'Organization_Name',
        'Organization_Type',
        'NGO_No',
        'Designation',
        'Date_From',
        'Date_To',
        'Nature_Of_Work',
        'Created_On',
        'Created_By',
        'IP_Address'
    ];
}
