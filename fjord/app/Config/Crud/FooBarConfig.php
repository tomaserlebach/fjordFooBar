<?php

namespace FjordApp\Config\Crud;

use Fjord\Crud\CrudForm;
use Fjord\Vue\Crud\CrudTable;
use Fjord\Crud\Config\CrudConfig;
use Fjord\Crud\Fields\Blocks\Repeatables;
use Illuminate\Database\Eloquent\Builder;

use App\Models\FooBar;
use FjordApp\Controllers\Crud\FooBarController;

class FooBarConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = FooBar::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = FooBarController::class;

    /**
     * Index table search keys.
     *
     * @var array
     */
    public $search = ['title'];

    /**
     * Index table sort by default.
     *
     * @var string
     */
    public $sortByDefault = 'id.desc';

    /**
     * Model singular and plural name.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => ucfirst(__f('models.foo_bars')),
            'plural' => ucfirst(__f('models.foo_bars')),
        ];
    }

    /**
     * Sort by keys.
     *
     * @return array
     */
    public function sortBy()
    {
        return [
            'id.desc' => __f('fj.sort_new_to_old'),
            'id.asc' => __f('fj.sort_old_to_new'),
        ];
    }

    /**
     * Initialize index query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function indexQuery(Builder $query)
    {
        // $query->with('relation');

        return $query;
    }

    /**
     * Index table filter groups.
     *
     * @return array
     */
    public function filter()
    {
        return [
            // Filter have to be in groups.
            'Fitler Group Title' => [

                // Use scopes as filter.
                'scopeName' => 'Description',
            ],
        ];
    }

    /**
     * Build index table.
     *
     * @param \Fjord\Vue\Crud\CrudTable $table
     * @return void
     */
    public function index(CrudTable $table)
    {
        $table->col('Title')->value('{title}')->sortBy('title');
        $table->col('Slug')->value('{slug}')->sortBy('slug');
    }

    /**
     * Setup create and edit form.
     *
     * @param \Fjord\Crud\CrudForm $form
     * @return void
     */
    public function form(CrudForm $form)
    {
        $form->card(function($form) {

            $this->mainCard($form);
            
        })
        ->width(12)
        ->title('Main');
    }

    /**
     * Define form sections in methods to keep the overview.
     *
     * @param \Fjord\Crud\CrudForm $form
     * @return void
     */
    protected function mainCard(CrudForm $form)
    {
        $form->input('title')
                ->title('Title')
                ->width(6);
        $form->wysiwyg('text')
                ->title('Text')
                ->width(6);    
        $form->input('slug')
                ->title('Slug')
                ->width(12);    
    }
}
