<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO: 文字数制限、論理名をいれる
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->string('title')->comment('タイトル');
            $table->string('body')->comment('本文'); //TODO: 255じゃたりないはず
            $table->string('top_image_path')->nullable()->comment('トップ画像パス');
            $table->tinyInteger('is_public')->comment('公開状態か');
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
        Schema::dropIfExists('posts');
    }
};
