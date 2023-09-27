<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class ShortLinks extends Model
{

    use HasFactory, Prunable;

    protected $table = 'short_links';


    protected $primaryKey = 'id';


    public $timestamps = true;

    protected $guarded = [];

    public function prunable()
    {
        return static::where('created_at', '>=', now()->subMinutes(5));
    }

}