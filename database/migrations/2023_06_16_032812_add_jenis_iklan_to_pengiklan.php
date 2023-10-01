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
        Schema::table('pengiklan', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_iklan')->after('no_telp');

            // Pastikan 'id_iklan' sesuai dengan nama kolom di tabel 'iklan'.
            $table->foreign('jenis_iklan')->references('id_iklan')->on('iklan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pengiklan', function (Blueprint $table) {
            $table->dropForeign(['jenis_iklan']);
            $table->dropColumn('jenis_iklan');
        });
    }

};
