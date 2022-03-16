site da aplicação

@auth
 <h1>Usuario logado</h1>
 <p> {{ Auth::user()->name }}</p>

 <p> {{ Auth::user()->email }}</p>
 <p> {{ Auth::user()->email }}</p>


@endauth


@guest
    <h1>Visitante</h1>

@endguest
