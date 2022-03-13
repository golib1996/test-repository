<?php

namespace App\Http\Controllers;


use App\Http\Requests\HouseCreateRequest;
use App\Http\Requests\HouseUpdateRequest;
use App\Repositories\HouseRepository;
use Illuminate\Http\Request;

class HouseController extends Controller
{

    /**
     * @var HouseRepository
     */
    private $houseRepository;


    public function __construct(HouseRepository $houseRepository)
    {
        $this->houseRepository = $houseRepository;
    }

    /**
     * @OA\Get (
     *     path = "/",
     *     tags={"Houses"},
     *     summary="Получение коллекции сущностей",
     *     @OA\Parameter (
     *          name="sortingField",
     *          in="query",
     *          description="Поле сортировки",
     *          required=false,
     *          @OA\Schema (
     *               type="text",
     *          ),
     *     ),
     *     @OA\Parameter (
     *          name="sortingDirection",
     *          in="query",
     *          description="Направление сортировки",
     *          required=false,
     *          @OA\Schema (
     *               type="text",
     *          ),
     *     ),
     *     @OA\Parameter (
     *          name="limit",
     *          in="query",
     *          description="Лимит",
     *          required=false,
     *          @OA\Schema (
     *               type="integer",
     *          ),
     *     ),
     *     @OA\Parameter (
     *          name="street",
     *          in="query",
     *          description="Улица",
     *          required=false,
     *          @OA\Schema (
     *               type="text",
     *          ),
     *     ),
     *     @OA\Parameter (
     *          name="area",
     *          in="query",
     *          description="Площадь",
     *          required=false,
     *          @OA\Schema (
     *               type="float",
     *          ),
     *     ),
     *     @OA\Parameter (
     *          name="numberOfRooms",
     *          in="query",
     *          description="Число комнат",
     *          required=false,
     *          @OA\Schema (
     *               type="integer",
     *          ),
     *     ),
     *     @OA\Parameter (
     *          name="dateOfConstuction",
     *          in="query",
     *          description="Дата постройки",
     *          required=false,
     *          @OA\Schema (
     *               type="string",
     *               format="date",
     *          ),
     *     ),
     *     @OA\Parameter (
     *          name="thereAreGhosts",
     *          in="query",
     *          description="Наличие призраков))",
     *          required=false,
     *          @OA\Schema (
     *               type="boolean",
     *          ),
     *     ),
     *     @OA\Response (
     *         response="200",
     *         description="success"
     *      ),
     *     @OA\Response (
     *         response="404",
     *         description="House not Found"
     *      ),
     * )
     *
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $houses = $this->houseRepository->getAll($request);

        return response()->json($houses);
    }


    /**
     * @OA\Get (
     *     path = "/{id}",
     *     tags={"Houses"},
     *     summary="Получение сущности по id",
     *     @OA\Parameter (
     *          in="path",
     *          name="id",
     *          required=true,
     *     ),
     *     @OA\Response (
     *         response="200",
     *         description="success"
     *      ),
     *     @OA\Response (
     *         response="404",
     *         description="Not Found"
     *      ),
     * )
     */
    public function show(int $id)
    {
        $house = $this->houseRepository->getById($id);

        return response()->json($house);
    }

    /**
     * @OA\Post  (
     *     path = "/",
     *     tags={"Houses"},
     *     summary="Сохранение данных в БД",
     *     @OA\RequestBody (
     *          required=true,
     *          @OA\JsonContent(
     *              required={"street","area","number_of_rooms","price","date_of_construction","there_are_ghosts"},
     *              @OA\Property(property="street", type="string",example="Ул.Пушкинская, дом 19"),
     *              @OA\Property (property="area", type="float", example=19.00),
     *              @OA\Property (property="number_of_rooms", type="integer", example=3),
     *              @OA\Property (property="price", type="float", example=10000.45),
     *              @OA\Property (property="date_of_construction", type="string", format="date", example="2022-03-04"),
     *              @OA\Property (property="there_are_ghosts",type="boolean", example=true),
     *          )
     *      ),
     *     @OA\Response (
     *         response=200,
     *         description="success"
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Ошибка валидации",
     *     ),
     * ),
     *
     */

    public function store(HouseCreateRequest $request)
    {
        $house = $this->houseRepository->create($request->all());
        return response()->json($house);
    }

    /**
     * @OA\Put  (
     *     path = "/{id}",
     *     tags={"Houses"},
     *     summary="Изменение данных в БД",
     *     @OA\Parameter (
     *          in="path",
     *          name="id",
     *          required=true,
     *     ),
     *     @OA\RequestBody (
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="street", type="string",example="Ул.Пушкинская, дом 19"),
     *              @OA\Property (property="area", type="float", example=19.00),
     *              @OA\Property (property="number_of_rooms", type="integer", example=3),
     *              @OA\Property (property="price", type="float", example=10000.45),
     *              @OA\Property (property="date_of_construction", type="string", format="date", example="2022-03-04"),
     *              @OA\Property (property="there_are_ghosts",type="boolean", example=true),
     *          )
     *      ),
     *     @OA\Response (
     *         response=200,
     *         description="success"
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Ошибка валидации",
     *     ),
     * ),
     *
     * @param Request $request
     * @param $houseId
     * @return mixed
     */
    public function update(HouseUpdateRequest $request, $houseId)
    {
        return $this->houseRepository->update($request->all(), $houseId);
    }


    /**
     * @OA\Delete  (
     *     path = "/{id}",
     *     tags={"Houses"},
     *     summary="Удаление сущности из БД",
     *     @OA\Parameter (
     *          in="path",
     *          name="id",
     *          required=true,
     *     ),
     *     @OA\Response (
     *         response="200",
     *         description="success"
     *      ),
     * )
     */
    public function destroy($id): void
    {
        $this->houseRepository->delete($id);
    }
}
