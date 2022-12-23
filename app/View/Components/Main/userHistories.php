<?php

namespace App\View\Components\main;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\History;

class UserHistories extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        
        $histories = History::all() -> where('author',Auth::user() -> email);

        return view('components.main.userHistories',[
            'histories' => $histories,
        ]);
    }
}
