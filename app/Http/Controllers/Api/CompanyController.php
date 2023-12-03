<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MstCompany;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
    *    @OA\Get(
    *       path="/company-list",
    *       tags={"Employee"},
    *       operationId="CompanyList",
    *       summary="Company List",
    *       description="Get company list",
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "success": true,
    *               "status_code": 200,
    *               "message": "Success",
    *               "data": {
    *                   "1": "1700 - ABC",
    *                   "2": "1800 - XYZ",
    *              }
    *          }),
    *      ),
    *  )
    */
    public function list()
    {
        $data = MstCompany::select('id', 'name')->pluck('name', 'id');
        return success($data);
    }
}
