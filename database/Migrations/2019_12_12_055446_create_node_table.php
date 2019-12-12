<?php

use App\Constants\NYConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('node', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('enable', NYConstants::enum())->default(NYConstants::YES)->comment('是否啟用');
            $table->enum('display', NYConstants::enum())->default(NYConstants::YES)->comment('是否顯示');
            $table->enum('public', NYConstants::enum())->default(NYConstants::NO)->comment('是否公開取用');
            $table->string('display_name', 50)->comment('預設顯示名稱');
            $table->string('code', 50)->comment('代號');
            $table->timestamps();
            // index
            $table->unique('code', 'node_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('node');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
