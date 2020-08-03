<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLogbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('teacher_id');
            $table->integer('parent_id');
            $table->integer('age');
            $table->string('gender');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('logbook', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('student_id');
            $table->time('time',0);
            $table->date('date');
            $table->string('sender', 100);
            $table->string('is_healthy', 10)->default('yes');
            $table->string('illness',255)->nullable();
            $table->longText('equipment')->nullable();
            $table->longText('medicine')->nullable();
            $table->time('milk_1',0)->nullable();
            $table->time('milk_2',0)->nullable();
            $table->string('breakfast', 255)->nullable();
            $table->string('lunch', 255)->nullable();
            $table->string('teatime', 255)->nullable();
            $table->string('circle_time', 255)->nullable();
            $table->string('outdoor', 255)->nullable();
            $table->string('dypers', 255)->nullable();
            $table->longText('dypers_info')->nullable();
            $table->string('brush_teeth', 255)->nullable();
            $table->string('bath', 255)->nullable();
            $table->string('sleep', 255)->nullable();
            $table->string('additional_note')->nullable();
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
        Schema::dropIfExists('student');
        Schema::dropIfExists('logbook');
    }
}
