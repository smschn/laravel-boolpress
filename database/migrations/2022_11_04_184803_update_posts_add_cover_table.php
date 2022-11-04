<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsAddCoverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {

            /* aggiungo la colonna <cover> alla tabella posts */
            $table->string('cover')->nullable()->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {

            /* se faccio rollback, cancello la colonna creata nella up() */
            $table->dropColumn('cover');
        });
    }
}