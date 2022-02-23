<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditFkInNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign('news_category_id_foreign');
            $table->foreign('category_id')->references('id')->on('categories')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign('news_category_id_foreign');
            $table->foreign('category_id')->references('id')->on('categories');
            
        });
    }
}
