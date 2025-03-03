<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('first_last_name');
            $table->string('second_last_name');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Insert initial users after creating the tables
        DB::table('users')->insert([
            [
                'name' => 'Emiliano',
                'first_last_name' => 'Garcia',
                'second_last_name' => 'Oñate',
                'role' => 'admin',
                'email' => 'ashraahx@gmail.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => DB::table('users')->value('id'), 
            ],
        ]);

        $createdById = DB::table('users')->where('email', 'ashraahx@gmail.com')->value('id');

        // Insert the remaining users
        DB::table('users')->insert([
            [
                'name' => 'Daniel',
                'first_last_name' => 'Ramírez',
                'second_last_name' => 'Flores',
                'role' => 'admin',
                'email' => 'spartandanii117@gmail.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => $createdById,
            ],
            [
                'name' => 'Yahir',
                'first_last_name' => 'López',
                'second_last_name' => 'De Santiago',
                'role' => 'admin',
                'email' => 'lopezyahir884@gmail.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => $createdById,
            ],
            [
                'name' => 'Carlos',
                'first_last_name' => 'Díaz',
                'second_last_name' => 'Faz',
                'role' => 'admin',
                'email' => 'carlos.diazfaz@gmail.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => $createdById,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};