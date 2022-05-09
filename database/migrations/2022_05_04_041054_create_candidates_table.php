<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('designation_id');
            $table->string('fname');
            $table->string('lname')->nullable();
            $table->string('email')->nullable();
            $table->integer('mobile')->nullable();
            $table->integer('age')->nullable();
            $table->text('address')->nullable();
            $table->text('resume')->nullable();
            $table->text('experience')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1-Active 0-Inactive');
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
        Schema::dropIfExists('candidates');
    }
}
