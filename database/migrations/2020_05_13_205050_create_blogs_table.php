<?php

/**
 * Laravel Schematics
 *
 * WARNING: removing @tag value will disable automated removal
 *
 * @package Laravel-schematics
 * @author  Maarten Tolhuijs <mtolhuys@protonmail.com>
 * @url     https://github.com/mtolhuys/laravel-schematics
 * @tag     laravel-schematics-blogs-model
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', static function (Blueprint $table) {
            $table->id();
            $table->string('blog_title', 255);
            $table->text('blog_description');
            $table->string('blog_tags', 255);
            $table->longText('blog_content');
            $table->string('blog_image', 255)->nullable();
            $table->integer('blog_author');
            $table->string('blog_slug', 255);
            $table->integer('blog_categoryId');
            $table->string('blog_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
