<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('dislikes', function (Blueprint $table) {
            $table->foreign('news_id')->references('id')->on('news');
        });
    }


    public function down()
    {
        Schema::table('dislikes', function (Blueprint $table) {
            $table->dropForeign(['news_id']);
        });
    }
};
