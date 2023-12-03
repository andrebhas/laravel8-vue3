<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Store Employee request",
 *      description="Store Employee request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StoreEmployeeRequest extends FormRequest
{
     /**
     * @OA\Property(
     *      title="companyId",
     *      description="Company's id of the new employee",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $company_id;

    /**
     * @OA\Property(
     *      title="departmentId",
     *      description="Department's id of the new employee",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $department_id;

    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new employee",
     *      example="A nice project"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="nik",
     *      description="NIK of the new employee",
     *      example="A nice project"
     * )
     *
     * @var string
     */
    public $nik;

    /**
     * @OA\Property(
     *      title="status",
     *      description="Staus of the new employee",
     *      format="int64",
     *      example=1
     * )
     *
     * @var string
     */
    public $status;

     /**
     * @OA\Property(
     *      title="Join date",
     *      description="Join Date of the new employee",
     *      example="2023-11-11"
     * )
     *
     * @var \DateTime
     */
    public $join_date;

    /**
     * @OA\Property(
     *      title="Date of Birth",
     *      description="Date of Birth of the new employee",
     *      example="2023-11-11"
     * )
     *
     * @var \DateTime
     */
    public $dob;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_id' => 'required|exists:mst_companies,id',
            'department_id' => 'required|exists:mst_departments,id',
            'name' => 'required|string|max:150',
            'nik' => 'required|string|max:150',
            'status' => 'required|boolean',
            'join_date' => 'required|date_format:Y-m-d',
            'dob' => 'required|date_format:Y-m-d',
        ];
    }

    public function attributes()
    {
        return [
            'company_id' => 'company',
            'department_id' => 'department',
        ];
    }
}
