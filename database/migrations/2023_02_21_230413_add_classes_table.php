<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500)->nullable();
            $table->string('code', 100)->nullable()->comment('mã lớp học');
            $table->unsignedInteger('order')->nullable()->comment('thứ tự hiển thị');
            $table->tinyInteger('level')->nullable()->comment('1: cấp 1, 2: cấp 2, 3: cấp 3');
            $table->boolean('is_public')->default(1)->comment('có hiển thị không');
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
        Schema::dropIfExists('classes');
    }
}
