<?php

namespace Bitnary\JsonPaginate;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

/**
 * Registrar método jsonPaginate() no eloquent
 * Esse método retorna a páginação em json para ser utilizada via API
 * @author Davi Souto
 * @since  30/05/2019
 */
class JsonPaginateServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBuilderMacro();
    }

    /**
     * Registrar macro no Builder
     * @param int $per_page
     * @return array
     * @author Davi Souto
     * @since  30/05/2019 
     */
    protected function registerBuilderMacro()
    {
        Builder::macro('jsonPaginate', function (int $per_page = null, $each_side = null) {
            $per_page = $per_page ?? 100;
            $each_side = $each_side ?? 3;
            $page_keys = [ ];

            $paginate = $this
                ->paginate($per_page)
                ->toArray();

            for($i = 1; $i <= $paginate['last_page']; $i++)
            {
                if ($i >= $paginate['current_page'] - $each_side && $i <= $paginate['current_page'] + $each_side)
                    $page_keys[] = $i;
            }

            $prev_page = $paginate['current_page'] - 1;
            $next_page = $paginate['current_page'] + 1;

            if ($prev_page < 1) $prev_page = 1;
            if ($next_page > $paginate['last_page']) $next_page = $paginate['last_page'];

            $is_first_page = ($paginate['current_page'] == 1);
            $is_last_page = ($paginate['current_page'] >= $paginate['last_page']);


            return [
                'data'      =>  $paginate['data'],
                'paginator' =>  [
                    'current_page'  =>  $paginate['current_page'],

                    'prev_page'     =>  $prev_page,
                    'next_page'     =>  $next_page,

                    'first_page'    =>  1,
                    'is_first_page' =>  $is_first_page,

                    'last_page'     =>  $paginate['last_page'],
                    'is_last_page'  =>  $is_last_page,

                    'page_keys'     =>  $page_keys,

                    'from_item'     =>  $paginate['from'],
                    'to_item'       =>  $paginate['to'],
                    'total_items'   =>  $paginate['total'],
                    'per_page'      =>  $per_page,
                    'display_items' =>  count($paginate['data']),
                ]
            ];
        });
    }
}
