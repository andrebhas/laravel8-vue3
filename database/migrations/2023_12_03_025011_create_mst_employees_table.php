<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->nullable();
            $table->string('nik', 150)->nullable();
            $table->boolean('status')->default(1);
            $table->date('join_date')->nullable();
            $table->date('dob')->nullable();

            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('department_id')->unsigned()->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')
                ->on('mst_companies')
                ->onDelete('set null');

            $table->foreign('department_id')
                ->references('id')
                ->on('mst_departments')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_employees');
    }
}
