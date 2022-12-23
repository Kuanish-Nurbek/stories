<?php

namespace App\View\Components\Main;

use Illuminate\View\Component;
use App\Models\Category;

class Main extends Component
{




    public function render()
    {
        $categories = Category::all();

        return view('components.main.main', [
            'categories' => $categories,
            'type' => $this -> type,
            'message' => $this -> message,
        ]);
    }
}
