<?php

namespace App\Repositories;

use App\Models\House;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HouseRepository
{

    public function getAll(Request $request)
    {
        $orderBy = $request->input('sortingField', 'id');
        $direction = $request->input('sortingDirection', 'desc');
        $limit = $request->input('limit', 10);
        $street = $request->input('street', null);
        $area = $request->input('area', null);
        $numberOfRooms = $request->input('numberOfRooms', null);
        $price = $request->input('price');
        $dateOfConstruction = $request->input('dateOfConstruction', null);
        $thereAreGhosts = $request->input('thereAreGhosts', null);

        $query = House::query();

        if ($street) {
            $query = $query->where('street', $street);
        }

        if ($area) {
            $query = $query->where('area', $area);
        }

        if ($numberOfRooms) {
            $query = $query->where('number_of_rooms', $numberOfRooms);
        }

        if ($price) {
            $query = $query->where('price', $price);
        }

        if ($dateOfConstruction) {
            $dateOfConstruction = Carbon::parse($dateOfConstruction)->format('Y-m-d');
            $query = $query->where('date_of_construction', $dateOfConstruction);
        }

        if (is_bool($thereAreGhosts)) {
            $query = $query->where('there_are_ghosts', $thereAreGhosts);
        }

        $query = $query->orderBy($orderBy, $direction);

        return $query->simplePaginate($limit)->getCollection();

    }

    public function getById(int $id)
    {
        return House::findOrFail($id);
    }

    public function create(array $attributes)
    {
        $house = House::create($attributes);

        return $house;
    }

    public function update(array $attributes, $houseId)
    {
        $house = House::where('id', $houseId)->first();
        if (!$house) {
            return 'Данный id не существует в БД';
        }

        $house->update($attributes);
        return $house;
    }

    public function delete(int $id): void
    {
        House::destroy($id);
    }
}
