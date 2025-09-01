<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Employee;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AvailableCarsRequest;

class CarAvailability extends Controller
{
    public function index(Request $request)
    {
        $employeeId = $request->query("employee_id");
        $startsAt = $request->query("starts_at");
        $finishesAt = $request->query("finishes_at");

        // Получаем позицию сотрудника и доступные категории комфорта
        $employeePosition = Employee::findOrFail($employeeId)->position;
        $allowedComfortCategories = $employeePosition->comfortCategory->pluck('id');

        // Получаем модели автомобилей, доступные для данной позиции
        $allowedCarModels = CarModel::whereIn("comfort_category_id", $allowedComfortCategories)->pluck('id');

        // Получаем все автомобили доступных моделей
        $allAvailableCarIds = Car::whereIn("car_model_id", $allowedCarModels)->pluck('id');

        // Находим забронированные автомобили на указанное время
        $reservedCarIds = Reservation::whereIn('car_id', $allAvailableCarIds)
            ->where('starts_at', "<", $finishesAt)
            ->where('finishes_at', ">", $startsAt)
            ->where('status', '!=', 'cancelled')
            ->pluck('car_id')
            ->toArray();

        // Строим запрос для доступных автомобилей
        $query = Car::with(['carModel.comfortCategory', 'driver'])
            ->whereIn('id', $allAvailableCarIds)
            ->whereNotIn('id', $reservedCarIds);

        // Фильтрация по категории комфорта
        if ($request->query('comfort_category_id')) {
            $comfortCategoryIds = explode(',', $request->query('comfort_category_id'));
            $query->whereHas('carModel', function ($q) use ($comfortCategoryIds) {
                $q->whereIn('comfort_category_id', $comfortCategoryIds);
            });
        }

        // Фильтрация по модели автомобиля
        if ($request->query('car_model_id')) {
            $carModelIds = explode(',', $request->query('car_model_id'));
            $query->whereIn('car_model_id', $carModelIds);
        }

        $availableCars = $query->get();

        return response()->json([
            'data' => $availableCars,
            'count' => $availableCars->count(),
        ]);
    }
}
