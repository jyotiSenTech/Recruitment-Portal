<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class education_detail extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps

    protected $table = 'applicant_edu_qualification';

    protected $primaryKey = 'ID';

}
