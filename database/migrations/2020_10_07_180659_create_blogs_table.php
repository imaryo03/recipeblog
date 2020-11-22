
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('blogs')){

            Schema::create('blogs', function (Blueprint $table) {
                
                $table->bigIncrements('id');
                $table->integer('user_id');
                $table->string('title',100);
                $table->text('content');
                $table->string('recipe_img')->nullable();
                $table->string('recipe_img_rakuten')->nullable();
                $table->string('recipe_url')->nullable();
                $table->string('recipe_cost')->nullable();
                $table->string('recipe_time')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
