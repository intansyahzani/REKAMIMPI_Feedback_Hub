<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id(); // feedback_id [PK]
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('star_rating')->unsigned(); // 1-5 range
            $table->text('feedback_text')->nullable();
            $table->date('submission_date')->default(DB::raw('CURRENT_DATE')); // 👈 auto date
            $table->timestamps(); // 👈 created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
