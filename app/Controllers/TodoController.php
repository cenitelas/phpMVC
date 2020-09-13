<?php


namespace App\Controllers;


use App\Models\Todo;
use Laminas\Diactoros\ServerRequest;

class TodoController
{
    function show(ServerRequest $request)
    {
        $method = strtolower($request->getMethod());
        if ($method == 'get')
            return view('todo', [
                'title' => 'Todo',
                'todos' => Todo::all()
            ]);
        $data = $request->getParsedBody();
        $data = array_filter($data, function ($item) {
            return $item != null || $item != '';
        });

        $todo = new Todo();
        $todo->text = $data['todo'];
        $todo->save();

        return redirect('/todo');
    }

}