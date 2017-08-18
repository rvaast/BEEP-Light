<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Queen extends Model
{
    use SoftDeletes;

    protected $fillable = ['hive_id', 'created_at', 'race_id', 'quality', 'color', 'name', 'fertilized', 'clipped', 'fertilizing_location', 'origin', 'tree', 'line', 'mother_id', 'marker', 'goal'];
	protected $guarded 	= ['id'];
    protected $hidden   = ['hive_id', 'fertilizing_location', 'origin', 'tree', 'line', 'mother_id', 'marker', 'goal'];
    protected $appends  = ['race', 'mother'];

    public $timestamps = false;

    // Relations
    public function getRaceAttribute()
    {
        return BeeRace::find($this->race_id)->name;
    }

    public function getMotherAttribute()
    {
        return isset($this->mother_id) ? Queen::find($this->mother_id)->name : '';
    }

	public function hive()
    {
        return $this->belongsTo(Hive::class);
    }

    public function race()
    {
        return $this->hasOne(BeeRace::class, 'race_id');
    }

    public function mother()
    {
        return $this->hasOne(Queen::class, 'mother_id');
    }

}
