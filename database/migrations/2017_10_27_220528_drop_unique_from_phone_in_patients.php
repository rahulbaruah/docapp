<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUniqueFromPhoneInPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function(Blueprint $table)
        {
            $table->dropUnique('patients_phone_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function(Blueprint $table)
        {
            //Put the index back when the migration is rolled back
            $table->unique('phone');

        });
    }
}
