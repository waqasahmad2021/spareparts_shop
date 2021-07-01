<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('username', 15)->unique()->after('id');
            $table->string('firstname', 15)->nullable()->after('name');
            $table->string('lastname', 15)->nullable()->after('firstname');
            $table->string('contact')->nullable()->after('email');
            $table->string('image')->nullable()->after('contact');
            // i did mistake here that is ok but i should have to put status instead of choices ( the column name ).
            $table->enum('choices', ['0', '1'])->default(1)->after('updated_at')->comment = '0=admin,1=common-user';
            // $table->tinyInteger('status')->default(1)->after('birthday');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
