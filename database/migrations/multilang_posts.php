<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class MultiLangPosts extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('multilang_posts', function (Blueprint $table) {

            $table->id();
            $table->string('model');
            $table->integer('model_id');
            $table->integer('status')->nullable()->default(0)->comment('1: Active  2: InActive');
            $table->string('lang')->default('en')->nullable();
            $table->softDeletes();
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

        Schema::dropIfExists('multilang_posts');

    }

}

