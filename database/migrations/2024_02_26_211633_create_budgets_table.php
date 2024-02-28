<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetsTable extends Migration
{

    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->decimal('total',10,2);
            $table->foreignId('provider_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('family_client_id')->constrained();
            $table->foreignId('safe_type_id')->constrained();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('budgets');
    }
}
