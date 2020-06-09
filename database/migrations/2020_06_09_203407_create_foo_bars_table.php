<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Fjord\Support\Migration\MigratePermissions;

class CreateFooBarsTable extends Migration
{
    use MigratePermissions;

    /**
     * Permissions that should be created for this crud.
     *
     * @var array
     */
    protected $permissions = [
        'create foo_bars',
        'read foo_bars',
        'update foo_bars',
        'delete foo_bars',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foo_bars', function (Blueprint $table) {
            $table->bigIncrements('id');

            // enter all non-translated columns here
            // set them to fillable in your model

            // $table->string('title');

            //$table->string('slug')->nullable();

            $table->boolean('active')->default(true);

            $table->timestamps();
        });
        
        Schema::create('foo_bar_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('foo_bar_id')->unsigned();
            $table->string('locale')->index();

            // set all columns that are translated here
            // set them to fillable in the model
            // as well as in the translation-model
            //
            $table->string('slug')->nullable();
             $table->string('title')->nullable();
             $table->text('text')->nullable();

            $table->unique(['foo_bar_id', 'locale']);
            $table->foreign('foo_bar_id')->references('id')->on('foo_bars')->onDelete('cascade');
        });


        $this->upPermissions();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foo_bar_translations');
        Schema::dropIfExists('foo_bars');

        $this->downPermissions();
    }
}
