<?php

use App\Constants\NYConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name', 16)->comment('呈現文字');
            $table->string('code', 20)->unique()->comment('代碼');
            $table->enum('enable', NYConstants::enum())->default(NYConstants::YES)->comment('是否啟用');
            $table->enum('public', NYConstants::enum())->default(NYConstants::YES)->comment('是否公開取用');
            $table->timestamps();
            //index
            $table->index('code', 'idx_role_code');
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
        Schema::dropIfExists('role');
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
