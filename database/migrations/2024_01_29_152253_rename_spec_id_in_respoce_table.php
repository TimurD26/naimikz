<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('respoces', function (Blueprint $table) {
            $table->renameColumn('spec_id', 'user_id');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respoces', function (Blueprint $table) {
            $table->renameColumn('user_id', 'spec_id');
        });
      
    }
};
