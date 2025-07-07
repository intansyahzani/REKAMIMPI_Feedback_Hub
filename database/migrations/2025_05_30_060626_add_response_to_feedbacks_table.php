<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('feedbacks', function (Blueprint $table) {
        $table->text('response')->nullable()->after('feedback_text');
    });
}

public function down()
{
    Schema::table('feedbacks', function (Blueprint $table) {
        $table->dropColumn('response');
    });
}

};
