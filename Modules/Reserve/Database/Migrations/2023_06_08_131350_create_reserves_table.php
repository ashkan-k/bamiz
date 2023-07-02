<?php

use App\Enums\EnumHelpers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('start_time');
            $table->string('end_time')->nullable();
            $table->integer('guest_count')->default(1);
            $table->integer('room_number')->nullable();
            $table->string('amount')->default(0);
            $table->boolean('status')->default(false);
            $table->enum('type', EnumHelpers::$ReserveTypesEnum)->default('table_for_food');

            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('place_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserves');
    }
};
