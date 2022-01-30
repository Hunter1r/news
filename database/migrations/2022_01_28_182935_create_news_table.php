<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('author', 255)->default('admin');
            $table->boolean('active')->default(true); 
            $table->string('image', 255)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['slug','active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
        // $table->dropIndex(['slug','active']);
    }
}
