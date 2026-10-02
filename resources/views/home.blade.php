<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Tailwind (per defecte al projecte Laravel) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fonts opcionals (ex: Inter) -> afegeix-les a app.css si cal --}}
</head>
<body class="h-full bg-gray-50 text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100">
    <!-- Header global -->
    <header class="border-b border-gray-200 bg-white/80 backdrop-blur dark:border-gray-800 dark:bg-gray-900/60">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 font-semibold">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-indigo-600 text-white">L</span>
                    <span>{{ config('app.name', 'Laravel') }}</span>
                </a>

                <nav aria-label="Principal" class="hidden gap-6 md:flex">
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Inici</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">About</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Contacte</a>
                </nav>

            </div>
        </div>
    </header>

    <!-- Main -->
    <main id="content" class="relative">
        <!-- Hero -->
        <section class="relative">
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
                <div class="mx-auto max-w-3xl text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl">
                        Benvinguts al nostre projecte Laravel
                    </h1>
                    <p class="mt-4 text-lg leading-8 text-gray-600 dark:text-gray-300">
                        Un exemple senzill amb una petita base de dades de <span class="font-semibold">llibres</span> utilitzant <span class="font-semibold">SQLite</span>.
                    </p>

                    <div class="mt-8 flex items-center justify-center gap-3">
                        <a href="https://laravel.com/docs" target="_blank" rel="noopener"
                           class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                           Documentació Laravel
                        </a>
                        <a href="https://tailwindcss.com/docs" target="_blank" rel="noopener"
                           class="rounded-xl border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800">
                           Tailwind CSS
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Llibres -->
        <section aria-labelledby="books-heading" class="bg-white py-12 dark:bg-gray-950/40">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-8 flex items-end justify-between gap-4">
                    <div>
                        <h2 id="books-heading" class="text-2xl font-semibold tracking-tight">📚 Darrers llibres</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                            Mostrem una selecció de llibres de la base de dades.
                        </p>
                    </div>
                    @isset($books)
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $books->count() }} resultats</span>
                    @endisset
                </div>

                @if(isset($books) && $books->count())
                    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($books as $book)
                            <li class="group overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="text-lg font-bold leading-tight group-hover:underline">
                                            {{ $book->title }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                            {{ $book->author }}
                                            @if($book->year) · {{ $book->year }} @endif
                                            @if($book->pages) · {{ $book->pages }} pàg. @endif
                                        </p>
                                    </div>
                                    <time datetime="{{ optional($book->created_at)->toDateString() }}"
                                          class="shrink-0 text-xs text-gray-500 dark:text-gray-400">
                                        {{ optional($book->created_at)->format('d/m/Y') }}
                                    </time>
                                </div>

                                @if($book->description)
                                    <p class="mt-3 line-clamp-3 text-sm text-gray-700 dark:text-gray-200">
                                        {{ $book->description }}
                                    </p>
                                @endif

                                <div class="mt-4 flex items-center gap-3">
                                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-200 dark:bg-indigo-950/40 dark:text-indigo-300 dark:ring-indigo-900/60">
                                        Llibre
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="rounded-2xl border border-dashed border-gray-300 p-10 text-center dark:border-gray-700">
                        <h3 class="text-lg font-semibold">Encara no hi ha llibres</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                            Poblarem la base de dades amb un seeder o afegirem un CRUD per crear nous registres.
                        </p>
                        <div class="mt-6">
                            <a href="{{ url('/') }}"
                               class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                                Refrescar
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 bg-white py-8 text-sm text-gray-600 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tots els drets reservats.</p>
            <p class="opacity-80">
                Fet amb <span aria-hidden="true">💙</span> Laravel & Tailwind.
            </p>
        </div>
    </footer>
</body>
</html>
