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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullValue(false);
            $table->string('title')->nullValue(false);
            $table->text('contents')->nullValue(false);
            $table->text('contents_of_html')->nullValue(false);
            $table->bigInteger('post_type_id')->nullValue(false);
            $table->text('post_title_img_path')->nullable();
            $table->integer('is_display')->nullValue(false);
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('updated_user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
