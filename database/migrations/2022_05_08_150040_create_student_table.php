<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
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
            $table->string('title', 100);
            $table->string('father', 100);
            $table->string('mother', 100);
            $table->date('dob');
            $table->string('member_id', 9)->unique();
            $table->string('aadhaar', 12)->unique();
            $table->signedTinyInteger('class');
            $table->string('address');
            $table->string('mobile', 10);
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
    }
}
