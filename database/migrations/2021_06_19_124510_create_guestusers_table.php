<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guestusers', function (Blueprint $table) {
            $table->id();

            $table->string("billing_firstname");
            $table->string("billing_lastname");
            $table->string("billing_company_name");
            $table->text("billing_street_address");
            $table->string("billing_town_city");
            $table->string("billing_stat_country");
            $table->string("billing_phone");
            $table->string("billing_email");
            $table->string("shipment_firstname");
            $table->string("shipment_lastname");
            $table->string("shipment_company_name");
            $table->text("shipment_street_address");
            $table->string("shipment_town_city");
            $table->string("shipment_stat_country");
            $table->string("shipment_phone");
            $table->string("shipment_email");
            $table->text("order_notes");

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
        Schema::dropIfExists('guestusers');
    }
}
