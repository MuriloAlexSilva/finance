<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevenueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Revenue', function (Blueprint $table) 
        {
            $table->bigIncrements('id_revenue');
            $table->string('name');
            $table->boolean('is_recurrent')->default(false);
            $table->longText('description')->nullable();
            $table->decimal('value',12,2)->default(0);
            $table->dateTime('date');           
            
            $table->bigInteger('id_revenue_type')->unsigned();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');

            $table->foreign('id_revenue_type')->references('id_revenue_type')->on('RevenueType');

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
        Schema::dropIfExists('Revenue');
    }
}
