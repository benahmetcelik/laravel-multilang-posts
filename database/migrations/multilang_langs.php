<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class MultiLangLangs extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('multilang_langs', function (Blueprint $table) {

            $table->id('id');
            $table->string('flag');
            $table->string('name');
            $table->string('short_name');
            $table->integer('status')->default(0)->comment('1: Active  2: InActive');
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

        Schema::dropIfExists('multilang_langs');

    }

}

