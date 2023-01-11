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
     */
        public function up()
        {
            Schema::create('Revenue', function (Blueprint $table) 
            {
                $table->bigIncrements('id_revenue');
                $table->boolean('is_recurrent')->default(false);
                $table->longText('description')->nullable();
                $table->decimal('value',12,2)->default(0);
                $table->dateTime('date');           
                
                $table->bigInteger('id_revenue_type')->unsigned();
                $table->bigInteger('id_revenue_sub_type')->unsigned();
                $table->bigInteger('created_by')->unsigned();
                $table->bigInteger('deleted_by')->unsigned()->nullable();
                
                $table->timestamps();

                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('deleted_by')->references('id')->on('users');

                $table->foreign('id_revenue_type')->references('id_revenue_type')->on('RevenueType');
                $table->foreign('id_revenue_sub_type')->references('id_revenue_sub_type')->on('RevenueSubType');

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
};
