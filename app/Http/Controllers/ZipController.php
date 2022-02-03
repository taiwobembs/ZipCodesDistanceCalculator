<?php

namespace App\Http\Controllers;
use App\Models\ZipCode;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class ZipController extends Controller
{

    public function calculateDistanceWithZipCodes(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'zipcodes1' => 'required',
            'zipcodes2' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $zipcodes1 = $input['zipcodes1'];
        $zipcodes2 = $input['zipcodes2'];


        $zipCode1Obj = ZipCode::where('zipcode', $zipcodes1)->get();
        $zipCode2Obj = ZipCode::where('zipcode', $zipcodes2)->get();

        if(empty($zipCode1Obj[0]) || empty($zipCode2Obj[0])){
            return response(['message' => 'ZipCode errors', 'errors' => "Zip Code can't be processed", 'status' => false], 422);
        }

        $distanceReturned = ZipCode::haversineGreatCircleDistance($zipCode1Obj[0]->latitude,$zipCode1Obj[0]->longitude,$zipCode2Obj[0]->latitude,$zipCode2Obj[0]->longitude);

        if (!empty($distanceReturned)){
            return response(['data' => [
                'zipcodes1' => $zipcodes1,
                'zipcodes2' => $zipcodes2,
                'zipcode1_latitude' => $zipCode1Obj[0]->latitude,
                'zipcode1_longitude' => $zipCode1Obj[0]->longitude,
                'zipcode2_latitude' => $zipCode2Obj[0]->latitude,
                'zipcode2_longitude' => $zipCode2Obj[0]->longitude,
                'distanceReturned' => $distanceReturned,
            ], 'message' => 'ZipCodes Distance Calculated!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'zipcodes1' => $zipcodes1,
                'zipcodes2' => $zipcodes2,
                'distanceReturned' => 0,
            ], 'message' => "unable to calculate ZipCodes distance, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function getZipCodes()
    {
        $zipCodes = ZipCode::orderBy('zipcode', 'ASC')->get();
        // $zipCodes->makeHidden(['id','image']);
        return response(['data' => $zipCodes, 'message' => 'zipCodes data', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

    public function getZipCode($id)
    {
        $zipCode = ZipCode::findOrFail($id);
        
        return response(['data' => $zipCode, 'message' => 'get zipCode by id!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

    public function deleteZipCode($id)
    {
        $resultSet = ZipCode::find($id);
        if(!empty($resultSet)){
            ZipCode::findOrFail($id)->delete();
            return response(['data' => [], 'message' => 'Deleted Successfully', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
        }else{
            return response(['data' => [], 'message' => 'ID does not exit', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function addZipCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'zipcode' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $zipcode = $input['zipcode'];
        $latitude = $input['latitude'];
        $longitude = $input['longitude'];

        $zipCodeObj = ZipCode::create([
            'zipcode'    => $zipcode,
            'latitude'   => $latitude,
            'longitude'  => $longitude,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $saved = $zipCodeObj->save();

        if ($saved) {
            return response(['data' => [
                'zipcode' => $zipcode,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ], 'message' => 'ZipCode created!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'zipcode' => $zipcode,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ], 'message' => "unable to create ZipCode, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function updateZipCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'zipcode' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], env('HTTP_SERVER_CODE_UNPROCESSABLE_ENTITY') );
        }

        $input = $request->all();
        $id = $input['id'];
        $zipcode = $input['zipcode'];
        $latitude = $input['latitude'];
        $longitude = $input['longitude'];

        $zipCodeObj = ZipCode::findOrFail($id);
        $zipCodeObj->zipcode = $zipcode;
        $zipCodeObj->latitude = $latitude;
        $zipCodeObj->longitude= $longitude;
        $zipCodeObj->updated_at = Carbon::now();
        $saved = $zipCodeObj->save();

        if ($saved) {
            return response(['data' => [
                'zipcode' => $zipcode,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ], 'message' => 'ZipCode updated!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'zipcode' => $zipcode,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ], 'message' => "unable to update ZipCode, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

}
