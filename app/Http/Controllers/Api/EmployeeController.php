<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\MstCompany;
use App\Models\MstDepartment;
use App\Models\MstEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
    *    @OA\Get(
    *       path="/employees",
    *       tags={"Employee"},
    *       operationId="EmployeeDatatable",
    *       summary="Employee Datatable",
    *       description="Get employee datatable",
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "success": true,
    *               "status_code": 200,
    *               "message": "Success",
    *               "data": {
    *                   {
    *                       "nama": "1",
    *                       "nama_kategori": "Pendidikan",
    *                  }
    *              }
    *          }),
    *      ),
    *  )
    */
    public function index(Request $request)
    {
        $filter = $request->all();

        $employeeTable = (new MstEmployee())->getTable();
        $model = MstEmployee::select([
                $employeeTable . '.id',
                $employeeTable . '.name',
                $employeeTable . '.nik',
                $employeeTable . '.status',
                DB::raw('IF('.$employeeTable .'.status=1, "Active", "Inactive") as status_name'),
                DB::raw('DATE_FORMAT(join_date, "%d-%m-%Y") as join_date'),
                DB::raw('CONCAT(TIMESTAMPDIFF(YEAR, join_date, NOW()), "y ",TIMESTAMPDIFF(MONTH, join_date, NOW()), "m ")  as srv_time'),
                'cpn.name as company_name',
                'dpn.name as department_name',
            ])
            ->when($request->has('keyword'), function($q) use ($employeeTable, $filter) {
                return $q->where($employeeTable . '.name', 'like', '%' . $filter['keyword'] . '%');
            })
            ->leftJoin((new MstCompany)->getTable() . ' as cpn', $employeeTable . '.company_id', '=', 'cpn.id')
            ->leftJoin((new MstDepartment)->getTable() . ' as dpn', $employeeTable . '.department_id', '=', 'dpn.id')
            ->orderBy($employeeTable . '.updated_at', 'desc')
            ->get();
        $datatable = DataTables::of($model)->toJson();

        return paging($datatable);
    }

    /**
     * @OA\Post(
     *      path="/employees",
     *      operationId="storeEmployee",
     *      tags={"Employee"},
     *      summary="Store new Employee",
     *      description="Returns employee data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreEmployeeRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/MstEmployee")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *          @OA\JsonContent
     *           (example={
     *           "message": "The given data was invalid.",
     *           "errors": {
     *               "company_id": {"The selected company id is invalid."},
     *               "department_id": {"The department id field is required."},
     *           }
     *          }),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            MstEmployee::create($request->all());
            return success();
        } catch (\Throwable $th) {
            Log::error('Failed Store Employee: ', $th->getMessage() . ': ' . $th->getFile() . ': ' . $th->getLine());
            return internalServerError();
        }
    }

    /**
     * @OA\Get(
     *      path="/employees/{id}",
     *      operationId="showEmployee",
     *      tags={"Employee"},
     *      summary="Get Employee information",
     *      description="Returns employee data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Employee id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/MstEmployee")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */
    public function show($id)
    {
        $employeeTable = (new MstEmployee())->getTable();
        $model = MstEmployee::select([
                $employeeTable . '.id',
                $employeeTable . '.name',
                $employeeTable . '.nik',
                $employeeTable . '.dob',
                $employeeTable . '.status',
                DB::raw('IF('.$employeeTable .'.status=1, "Active", "Inactive") as status_name'),
                DB::raw('DATE_FORMAT(join_date, "%d %M %Y") as join_date'),
                DB::raw('join_date as join_date_form'),
                DB::raw('CONCAT(TIMESTAMPDIFF(YEAR, join_date, NOW()), " yrs ",TIMESTAMPDIFF(MONTH, join_date, NOW()), " mths ")  as srv_time'),
                'cpn.name as company_name',
                'cpn.id as company_id',
                'dpn.name as department_name',
                'dpn.id as department_id',
                DB::raw('CONCAT(TIMESTAMPDIFF(YEAR, dob, NOW()), " yrs old")  as age')
            ])
            ->where($employeeTable . '.id', $id)
            ->leftJoin((new MstCompany)->getTable() . ' as cpn', $employeeTable . '.company_id', '=', 'cpn.id')
            ->leftJoin((new MstDepartment)->getTable() . ' as dpn', $employeeTable . '.department_id', '=', 'dpn.id')
            ->first();

        if (!$model) {
            return notFound();
        }

        return success($model);
    }

    /**
     * @OA\Put(
     *      path="/employees/{id}",
     *      operationId="EmployeeUpdate",
     *      tags={"Employee"},
     *      summary="Update existing employee",
     *      description="Returns updated employee data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateEmployeeRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/MstEmployee")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(UpdateEmployeeRequest $request)
    {
        $input = $request->all();
        $emplopyee = MstEmployee::where('id', $input['id'])->first();
        $emplopyee->update([
            'name' => $input['name'],
            'nik' => $input['nik'],
            'dob' => $input['dob'],
            'join_date' => $input['join_date_form'],
            'status' => $input['status'],
            'company_id' => $input['company_id'],
            'department_id' => $input['department_id'],
        ]);

        return success();
    }

    /**
    *    @OA\Get(
    *       path="/employees/summary",
    *       tags={"Employee"},
    *       operationId="EmployeeSummary",
    *       summary="Employee Summary",
    *       description="Get employee summary",
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "success": true,
    *               "status_code": 200,
    *               "message": "Success",
    *               "data": {
    *                   {
    *                       "nama": "1",
    *                       "nama_kategori": "Pendidikan",
    *                  }
    *              }
    *          }),
    *      ),
    *  )
    */
    public function summary()
    {
        $data = MstEmployee::select([
                DB::raw('COUNT(id) as total'),
                DB::raw('IF(status=1,COUNT(status),0) as active'),
                DB::raw('IF(status=0,COUNT(status),0) as inactive')
            ])
            ->groupBy('status')
            ->get();
        return success([
            'total' => $data->sum('total'),
            'active' => $data->sum('active'),
            'inactive' => $data->sum('inactive'),
        ]);
    }
}
