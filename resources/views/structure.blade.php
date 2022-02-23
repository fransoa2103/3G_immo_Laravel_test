<p>le chiffre est {{$number}}</p>

@if($number<6)
    <p>le chiffre est inférieur à 6</p>
@elseif($number>10)
    <p>le chiffre est inférieur à 10</p>
@else
    <p>le chiffre est compris entre 5 et 10</p>
@endif

@for($i=0; $i <= $number; $i++)
    <p>{{$i}}</p>
@endfor

{{-- unless pose la question 'si la condition est vérifiée alors execute '  --}}
@unless($number%2)

    <p>le chiffre est pair</p>

@endunless

@foreach($fruits as $fruit)
    <p>{{$fruit}}</p>
@endforeach

{{-- la boucle FOR ELSE - EMPTY --}}
@forelse($fruits as $fruit)
    {{-- si le tableau n'est pas vide execute la boucle--}}
    <p>{{$fruit}}</p>
@empty
    {{-- sinon execute le code apres--}}
    <p>vous n'avez pas de fruits !</p>
@endforelse

{{-- php --}}
@php
    // si l'on veut écrire du code php
    echo rand(1,10);
@endphp

@isset($fruits)
<p>votre panier de fruits EXISTE bel et bien !</p>
@endisset
 
@empty($fruits)
    <p>votre panier de fruits est vide</p>
@endempty
