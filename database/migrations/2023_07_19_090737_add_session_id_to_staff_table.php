<?php

// database/migrations/<timestamp>_add_session_id_to_staff_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSessionIdToStaffTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->string('session_id')->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('session_id');
        });
    }
}

