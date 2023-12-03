<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Employee",
 *     description="Employee model",
 *     @OA\Xml(
 *         name="Employee"
 *     )
 * )
 */
class MstEmployee extends Model
{
    use HasFactory;

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Comnpany",
     *      description="Company ID of the new employee",
     *      format="int64",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $company_id;

    /**
     * @OA\Property(
     *     title="Company",
     *     description="Company of the author's user model"
     * )
     *
     * @var \App\Models\MstCompany
     */
    private $company;

    /**
     * @OA\Property(
     *      title="Department ID",
     *      description="Department ID of the new employee",
     *      format="int64",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $department_id;

     /**
     * @OA\Property(
     *     title="Department",
     *     description="Department of the author's user model"
     * )
     *
     * @var \App\Models\MstDepartment
     */
    private $department;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new employee",
     *      example="R. Satrio Adi Pamungkas"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="NIK",
     *      description="NIK of the new employee",
     *      example="201200330"
     * )
     *
     * @var string
     */
    public $nik;

    /**
     * @OA\Property(
     *      title="Status",
     *      description="Status of the new employee",
     *      example="Active"
     * )
     *
     * @var integer
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
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @OA\Property(
     *     title="Deleted at",
     *     description="Deleted at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $deleted_at;

    /**
     * mass assigment list
     *
     * @var array
     */
    protected $guarded = ['id'];
}
