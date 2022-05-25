<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Image extends Model {

    use HasFactory;

    public function project() {

        return $this->belongsTo(Project::class);
    }

    public function toStandardClass() {

        $image = new \stdClass();

        var_dump($this);exit;
    }
}
