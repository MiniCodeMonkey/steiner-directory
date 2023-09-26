@extends('layouts.app')
@section('content')

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Log ind</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <p class="text-center text-sm text-gray-500">
      Vi har sendt en kode til dit telefon nummer. Indtast den venligst her for at logge ind.
    </p>

    <form class="space-y-6" action="{{ url('login') }}" method="POST">
      @csrf
      <div>
        <label for="code" class="block text-sm font-medium leading-6 text-gray-900">Kode</label>
        <div class="mt-2">
          <input id="code" name="code" type="text" autocomplete="code" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log ind</button>
      </div>
    </form>
</div>


@endsection