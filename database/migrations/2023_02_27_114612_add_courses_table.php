<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lms_id')->nullable();
            $table->string('name', 500)->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('type')->nullable()->comment('1: khóa học lẻ, 2: combo');
            $table->string('desktop_avatar', 100)->nullable();
            $table->string('mobile_avatar', 100)->nullable();
            $table->string('intro_link')->nullable();
            $table->tinyInteger('method')->nullable()->comment('Hình thức học, 1: video, 2: livestream');
            $table->boolean('is_public')->default(1)->comment('hiển thị');
            $table->boolean('is_highlight')->default(0)->comment('hiển thị trang chủ');
            $table->string('description', 500)->nullable();
            $table->text('detail')->nullable();
            $table->text('result_content')->nullable();
            $table->text('object_content')->nullable();
            $table->json('include_content')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
