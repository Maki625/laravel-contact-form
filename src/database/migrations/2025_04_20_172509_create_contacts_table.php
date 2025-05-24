<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
    $table->id();
    $table->string('first_name');
    $table->string('last_name');
    $table->string('gender');
    $table->string('email');
    $table->string('tel');
    $table->string('address');
    $table->string('building')->nullable();
    $table->unsignedBigInteger('inquiry_type');
    $table->text('inquiry_content');
    $table->timestamps();

    $table->foreign('inquiry_type')->references('id')->on('categories')->onDelete('cascade');

});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
