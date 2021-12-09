<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeuControlador extends Controller
{
    public function produtos()
    {
        echo '<h1>Produtos</h1>';
        echo '<ol>';
        echo '<li>Cachaças</li>';
        echo '<li>Doces</li>';
        echo '<li>Diversos</li>';
        echo '</ol>';
    }

    public function getNome()
    {
        return "Maria Luiza";
    }

    public function getIdade()
    {
        return "23";
    }

    public function multiplica($n1, $n2)
    {
        return $n1 * $n2;
    }
}
