@extends('template.home_layout')

@section('content')

<H1>Function Test Page </H1>
    
    <?php 

        echo url()->previous().'</br>';

        echo url()->current().'</br>';

        echo url()->full() .'</br>';

        echo url('').'</br>';

        echo Route::current()->getName().'a';

       



     ?>
	
    



@endsection