<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * First we create a roles table because we need using as foreign reference in Users Table
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role', 20)->index('code');
            $table->string('description');
            $table->json('permissions')->nullable();
            $table->timestamps();
        });

        \App\Models\Role::create([
            "role" => "CLIENT",
            "description" => 'Cliente',
        ]);
        \App\Models\Role::create([
            "role" => "DOCTOR",
            "description" => 'Doctor',
        ]);
        \App\Models\Role::create([
            "role" => "ADMINISTRATIVE",
            "description" => 'Administrador',
        ]);
        \App\Models\Role::create([
            "role" => "SUPERADMIN",
            "description" => 'Super Administrador',
        ]);

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role_code')->default('CLIENT');
            $table->string('fullname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_code')->references('role')->on('roles')->cascadeOnDelete()->cascadeOnUpdate();
        });

        \App\Models\User::create([
            'role_code' => 'SUPERADMIN',
            'email' => 'superadmin@healthplus.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Superadministrador'),
            'fullname' => 'Vicente Antonio Chiriguaya'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
};
