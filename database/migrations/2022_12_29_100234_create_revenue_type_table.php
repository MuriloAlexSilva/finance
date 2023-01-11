<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 
     */
        public function up()
        {
            Schema::create('RevenueType', function (Blueprint $table) 
            {
                $table->bigIncrements('id_revenue_type');
                $table->string('name');

                $table->bigInteger('created_by')->unsigned();
                $table->bigInteger('deleted_by')->unsigned()->nullable();
                $table->timestamps();

                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('deleted_by')->references('id')->on('users');

                $table->softDeletes();
            });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RevenueType');
    }
};
