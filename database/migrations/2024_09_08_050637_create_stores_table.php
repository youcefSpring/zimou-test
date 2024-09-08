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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->char('code', 10)->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phones');
            $table->string('company_name')->nullable();
            $table->string('capital')->nullable();
            $table->string('address')->nullable();
            $table->string('register_commerce_number')->nullable();
            $table->string('nif')->nullable();
            $table->unsignedInteger('legal_form')->nullable()->default(1);
            $table->unsignedInteger('status')->default(1);
            $table->boolean('can_update_preparing_packages')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
