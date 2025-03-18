<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AirportDetail extends Model
{
    protected $fillable = [
        'ident',
        'type',
        'name',
        'latitude_deg',
        'longitude_deg',
        'elevation_ft',
        'continent',
        'country_name',
        'iso_country',
        'region_name',
        'iso_region',
        'local_region',
        'municipality',
        'scheduled_service',
        'gps_code',
        'icao_code',
        'iata_code',
        'local_code',
        'home_link',
        'wikipedia_link',
        'keywords',
        'score',
        'last_updated'
    ];

    // Accessor to convert last_updated to a valid MySQL DATETIME format
    public function setLastUpdatedAttribute($value)
    {
        $this->attributes['last_updated'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    // Mutator to handle empty elevation_ft values
    public function setElevationFtAttribute($value)
    {
        $this->attributes['elevation_ft'] = $value !== '' ? (int) $value : null;
    }
}
