<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Role ID
            $table->string('name')->unique(); // Role name (e.g., Admin, User)
            $table->timestamps();
        });

        // Insert default roles
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'User'],
            ['id' => 2, 'name' => 'Admin'],
            ['id' => 3, 'name' => 'Super Admin'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
