<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model {
    protected $table = 'zipcodes';
    const EARTHRADIUS = 6371000;


    protected $fillable = [
        'id',
        'zipcode',
        'latitude',
        'longitude',
        'created_at',
        'updated_at'
    ];

    public static function haversineGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = self::EARTHRADIUS)
      {

        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
      
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
      
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
      }

}