<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discountables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('discount_id')
                  ->constrained('discounts')
                  ->onDelete('cascade')
            ;
            $table->unsignedBigInteger('discountable_id');
            $table->string('discountable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discountables');
    }
};
