@extends('layouts.app')
@section('content')
<header class="absolute inset-x-0 top-0 z-50">
  <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
    <div class="flex flex-1 justify-end">
      <a href="{{ url('login') }}" class="text-sm font-semibold leading-6 text-gray-900">Log ind <span aria-hidden="true">&rarr;</span></a>
    </div>
  </nav>
</header>

<main class="isolate">
  <!-- Hero section -->
  <div class="relative pt-14">
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
      <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="py-24 sm:py-32">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
          <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Steiner listen</h1>
          <p class="mt-6 text-lg leading-8 text-gray-600">En lille service der gør det muligt at få skole-opdateringer via SMS.</p>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="sms:+4552516166&body=tilmeld" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tilmeld</a>
            <a href="#faq" class="text-sm font-semibold leading-6 text-gray-900">Lær mere <span aria-hidden="true">→</span></a>
          </div>
        </div>
      </div>
    </div>
    <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
      <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
  </div>

  <!-- FAQs -->
  <div id="faq" class="mx-auto max-w-2xl divide-y divide-gray-900/10 px-6 pb-8 sm:pb-24 sm:pt-12 lg:max-w-7xl lg:px-8 lg:pb-32">
    <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">Spørgsmål og svar</h2>
    <dl class="mt-10 space-y-8 divide-y divide-gray-900/10">
      <div class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
        <dt class="text-base font-semibold leading-7 text-gray-900 lg:col-span-5">Hvordan tilmelder man sig?</dt>
        <dd class="mt-4 lg:col-span-7 lg:mt-0">
          <p class="text-base leading-7 text-gray-600">Skriv en SMS med beskeden "tilmeld" til <a href="sms:+4552516166&body=tilmeld">52 51 61 66</a></p>
        </dd>
      </div>
      <div class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
        <dt class="text-base font-semibold leading-7 text-gray-900 lg:col-span-5">Hvornår får jeg beskeder fra listen?</dt>
        <dd class="mt-4 lg:col-span-7 lg:mt-0">
          <p class="text-base leading-7 text-gray-600">Beskeder bliver kun sendt ud når Tulle skriver. Der er ikke andre der kan sende beskder på listen.</p>
        </dd>
      </div>
      <div class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
        <dt class="text-base font-semibold leading-7 text-gray-900 lg:col-span-5">Hvordan framelder man sig igen?</dt>
        <dd class="mt-4 lg:col-span-7 lg:mt-0">
          <p class="text-base leading-7 text-gray-600">Skriv en SMS med beskeden "frameld" til <a href="sms:+4552516166&body=frameld">52 51 61 66</a></p>
        </dd>
      </div>
      <div class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
        <dt class="text-base font-semibold leading-7 text-gray-900 lg:col-span-5">Hvem kan modtage beskeder?</dt>
        <dd class="mt-4 lg:col-span-7 lg:mt-0">
          <p class="text-base leading-7 text-gray-600">Listen er kun for forældre i 4. Klasse på Steiner Skolen i Vordingborg</p>
        </dd>
      </div>
    </dl>
  </div>

</main>
@endsection