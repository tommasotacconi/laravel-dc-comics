<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comics', function (Blueprint $table) {
            $table->id();
            $table->string('title', 40);
            $table->longText('description')->nullable(true);
            $table->tinyText('thumb')->nullable(true);
            $table->float('price', 4, 2);
            $table->string('series', 20)->nullable(true);
            $table->date('sale_date')->nullable(true);
            $table->string('type', 15)->nullable(true);
            $table->json('artists')->nullable(true);
            $table->json('writers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comics');
    }
};
