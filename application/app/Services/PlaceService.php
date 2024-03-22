<?php

namespace App\Services;

use App\Repositories\PlaceRepository;
use Illuminate\Support\Str;

class PlaceService
{
    protected $placeRepository;

    public function __construct(PlaceRepository $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    public function createPlace(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        
        // Checa se já existe um lugar com o mesmo nome, slug ou cidade
        $exists = $this->placeRepository->existsWithAttributes([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'city' => $data['city'],
        ]);
    
        if ($exists) {
            return [
                'error' => 'A place with the same name, slug, or city already exists.'
            ];
        }

        return $this->placeRepository->create($data);
    }
    

    public function updatePlace($id, array $data)
    {
        $place = $this->placeRepository->find($id);
        if (!$place) {
            return null; 
        }
        
        $data['slug'] = Str::slug($data['name']);
        $success = $this->placeRepository->update($place, $data);
        
        if ($success) {
            return $this->placeRepository->find($id);
        }
        
        return false;
    }
    

    public function getPlace($id)
    {
        return $this->placeRepository->find($id);
    }

    public function getAllPlaces()
    {
        return $this->placeRepository->all();
    }

    public function deletePlace($id)
    {
        $place = $this->placeRepository->find($id);
        return $this->placeRepository->delete($place);
    }

    // Método para listar lugares filtrando por nome
    public function findPlacesByName($name)
    {
        return $this->placeRepository->model->where('name', 'like', "%{$name}%")->get();
    }
}
