<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->boolean("can_see_book");
            $table->boolean("can_add_book");
            $table->boolean("can_edit_book");
            $table->boolean("can_delete_book");
            $table->boolean("can_see_user");
            $table->boolean("can_add_user");
            $table->boolean("can_edit_user");
            $table->boolean("can_delete_user");
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
        Schema::dropIfExists('levels');
    }
}
