<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    public $table = 'feedbacks';
    protected $fillable = ['name','email','feedback'];

    public function getFeedbacks() {
        return Feedback::paginate(10);
    }

    public function getFeedbackById($id) {
        return Feedback::where('id', '=', $id)->get();
    }
}
