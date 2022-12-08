<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug");
            $table->text("description");
            $table->float("price");
            $table->integer("stock");
            $table->foreignId("category_id")->onUpdate("cascade")->onDelete("cascade")
                ->constrained("categories");
            $table->foreignId("brand_id")->nullable()->onUpdate("cascade")->onDelete("cascade")
                ->constrained("brands");
            $table->foreignId("user_id")->onUpdate("cascade")->onDelete("cascade")
                ->constrained("users");
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
        Schema::dropIfExists('products');
    }
};
