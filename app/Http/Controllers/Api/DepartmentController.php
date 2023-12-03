<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MstDepartment;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
    *    @OA\Get(
    *       path="/department-list",
    *       tags={"Employee"},
    *       operationId="DetpartmentList",
    *       summary="Department List",
    *       description="Get department list",
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "success": true,
    *               "status_code": 200,
    *               "message": "Success",
    *               "data": {
    *                    "1": "Agency",
    *                    "2": "BOC",
    *              }
    *          }),
    *      ),
    *  )
    */
    public function list()
    {
        $data = MstDepartment::select('id', 'name')->pluck('name', 'id');
        return success($data);
    }
}
