<?php

namespace App\Models\PrimaryModels;

use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    protected $table = "documents";
    protected $fillable = ['file_name', 'path', 'size', 'datetime'];
}
