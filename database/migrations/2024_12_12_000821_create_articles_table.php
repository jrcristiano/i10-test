<?php

use App\Enums\ArticleStatus;
use App\Enums\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $table = 'articles';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->text('banner');
            $table->string('title')->unique();
            $table->string('subtitle');
            $table->longText('content');
            $table->string('slug')->unique();

            $table->enum('status', [
                ArticleStatus::RASCUNHO->value,
                ArticleStatus::PUBLICADO->value,
            ]);

            $table->foreignId('user_id')
                ->references('id')
                ->on('users');

            $table->foreignId('category_id')
                ->references('id')
                ->on('categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
