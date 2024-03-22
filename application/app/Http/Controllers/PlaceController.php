<?php

namespace App\Http\Controllers;

use App\Services\PlaceService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;

class PlaceController extends Controller
{
    protected $placeService;

    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }


/**
 * @OA\Get(
 *     path="/api/users",
 *     @OA\Response(response="200", description="An example endpoint")
 * )
 */
    

    public function index(Request $request)
    {
        if ($request->has('name')) {
            $places = $this->placeService->findPlacesByName($request->name);
        } else {
            $places = $this->placeService->getAllPlaces();
        }

        return response()->json($places);
    }

    public function store(StorePlaceRequest $request)
    {
        $result = $this->placeService->createPlace($request->validated());

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        return response()->json($result, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $place = $this->placeService->getPlace($id);

        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        return response()->json($place);
    }

    public function update(UpdatePlaceRequest $request, $id)
    {
        $updatedPlace = $this->placeService->updatePlace($id, $request->validated());
    
        if (is_null($updatedPlace)) {
            return response()->json(['message' => 'Place not found'], 404);
        } elseif ($updatedPlace === false) {
            return response()->json(['message' => 'Update failed'], 500);
        }
        
        return response()->json($updatedPlace);
    }    

    public function destroy($id)
    {
        $deleted = $this->placeService->deletePlace($id);

        if (!$deleted) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        return response()->json(['message' => 'Place deleted successfully']);
    }
}
