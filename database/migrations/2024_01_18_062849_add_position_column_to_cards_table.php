<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('cards', function (Blueprint $table) {
            $table->integer('position')->after('activity')->default(0);
        });
    }

    public function down(): void {
        Schema::table('cards', function (Blueprint $table) {
            $table->drop('position');
        });
    }
};
