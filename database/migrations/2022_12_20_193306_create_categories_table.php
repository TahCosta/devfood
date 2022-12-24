<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('tenant_id');
			$table->string('name')->unique();
			$table->string('url')->unique();
			$table->text('description')->nullable();
            $table->timestamps();

			$table->foreign('tenant_id')
				->references('id')
				->on('tenants')
				->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};