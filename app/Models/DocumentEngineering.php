<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentEngineering extends Model
{
    use HasFactory;
    protected $table ='document_engineer';

    protected $fillable = [
        'document_number',
        'description', 
        'discipline', 
        'version',
        'author',
        'tanggal', 
        'category',
        'status',
        'path',
        'ext',
        'size',
        'checker',
        'reviewer',
        'approver',
        'uploader',
        'email_check',
        'email_review',
        'email_approve',
    ];

    public function r_discipline()
    {
        return $this->hasOne(MasterDiscipline::class, 'id', 'discipline');
    }
    public function r_category()
    {
        return $this->hasOne(MasterCategory::class, 'id', 'category');
    }
    public function r_status()
    {
        return $this->hasOne(MasterStatus::class, 'code', 'status');
    }
    public function r_history()
    {
        return $this->hasMany(DocumentEngineeringHistory::class, 'document_engineer_id', 'id');
    }
}
