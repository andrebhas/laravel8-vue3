<?php
namespace App\Resources;

/**
 * @OA\Schema(
 *     title="EmployeeResource",
 *     description="Employee resource",
 *     @OA\Xml(
 *         name="EmployeeResource"
 *     )
 * )
 */
class EmployeeResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Models\Employee
     */
    private $data;
}
