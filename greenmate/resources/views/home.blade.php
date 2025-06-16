<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <title>Green Mate</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="bg-white text-gray-900 antialiased">

    <!-- Navbar -->
    <nav class="flex items-center justify-between px-20 py-4 bg-white shadow">
        <div class="text-xl font-bold text-green-600">Green Mate</div>
        <div class="scroll-smooth">
            <a href="#speel" class="text-gray-700 hover:text-green-600 mx-4">Spelen</a>
            <a href="#over-ons" class="text-gray-700 hover:text-green-600 mx-4">Over ons</a>
            <a href="#comment" class="text-gray-700 hover:text-green-600 mx-4">Comment</a>
        </div>
        <div class="flex items-center">
            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 mx-4">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-green-600 mx-4">Register</a>
            @else
                <span class="text-gray-700 mx-4">Hey, {{ Auth::user()->name }}!</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-green-600 mx-4">Logout</button>
                </form>
            @endguest
        </div>
    </nav>

    <!-- Green City Header -->
    <header class="bg-green-400 text-white py-48 text-center">
        <p class="mt-4 text-md text-green-100"><i>Greenmate presents:</i></p>
        <h1 class="text-5xl md:text-6xl font-extrabold tracking-wide">Green City</h1>
    </header>

    <!-- Background shape behind the section -->
    <div class="relative">
        <svg class="absolute top-[-2rem] left-0 w-full h-[110%] -z-10" viewBox="0 0 100 100" preserveAspectRatio="none">
            <polygon fill="#A7E8A1" points="0,20 100,0 100,80 0,100" />
        </svg>

        <!-- Actual section content -->
        <section id="unity-section" class="py-20 flex flex-col items-center">
        <h2 class="text-4xl font-bold text-green-400 mb-10">Speel Green City</h2>
        
        <div id="unity-container" class="relative w-full max-w-4xl aspect-[16/9] rounded-lg overflow-hidden bg-black shadow-xl">
            
            <!-- Canvas, hidden initially -->
            <canvas id="unity-canvas" class="absolute top-0 left-0 w-full h-full hidden"></canvas>

            <!-- Loading bar -->
            <div id="unity-loading-bar" class="absolute inset-0 flex flex-col justify-center items-center bg-black bg-opacity-80 z-30">
            <div class="w-3/4 bg-gray-700 rounded-full h-6 overflow-hidden mb-4">
                <div id="unity-progress-bar-full" class="bg-green-500 h-6 w-0 transition-all duration-300"></div>
            </div>
            <p class="text-green-400 font-semibold">Laden...</p>
            </div>

            <!-- Start button, hidden initially -->
            <button id="unity-start-button" class="hidden absolute inset-0 m-auto w-40 h-12 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg z-40">
            Start
            </button>

            <!-- Fullscreen button -->
            <button id="unity-fullscreen-button" class="absolute top-3 left-3 bg-green-700 text-white px-3 py-1 rounded hover:bg-green-800 z-40">
            Fullscreen
            </button>
            
        </div>
        </section>
    </div>



    <!-- Over Ons Section -->
    <div class="relative">
        <svg class="absolute top-[3rem] left-0 w-full h-full -z-10" viewBox="0 0 100 100" preserveAspectRatio="none">
            <polygon fill="#EFEFEF" points="0,0 100,20 100,100 0,80" />
        </svg>
        <section class="py-36 px-6 mt-px50" id="over-ons">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-green-600 mb-6">Over Ons!</h2>
                <p class="text-center">
                    Bij <b class="text-green-500">Greenmate</b> draait alles om creativiteit, duurzaamheid en technologie.
                    Wij zijn een gepassioneerd team van developers en game designers die samenkomen om innovatieve spellen
                    te maken en slimme software-oplossingen te bouwen.
                </p>
                <p class="mt-2">Onze missie? Toffe digitale ervaringen creëren die niet alleen leuk zijn, maar ook impact
                    maken.</p>
                <p class="mt-2">Op dit moment presenteren we met trots ons nieuwste spel: <b class="text-green-500">Green
                        City</b>. Een interactieve game waarin jij de toekomst van een duurzame stad bepaalt. Bouw, beheer
                    en laat jouw groene stad groeien terwijl je leert over milieuvriendelijke keuzes op een speelse manier.
                </p>
                <p class="mt-2">Of het nu gaat om games of software, bij <b class="text-green-500">Greenmate</b>
                    combineren we fun met functionaliteit.</p>
            </div>
        </section>
    </div>
    

    <!-- Comment Section -->
    <section class="py-20 px-6 mt-px50" id="comment">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-green-600 mb-6">Reacties</h2>

            <!-- Display existing comments -->
            @foreach ($comments as $comment)
                <div class="bg-gray-100 p-4 rounded-lg mb-4 text-left">
                    <p class="font-bold text-green-600">
                        {{ $comment->user->name ?? $comment->email }}
                    </p>
                    <p>{{ $comment->message }}</p>
                    <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            @endforeach

            <!-- Pagination links -->
            <div class="mt-4">
                {{ $comments->links() }}
            </div>
            <h2 class="text-3xl font-bold text-green-600 mb-6 mt-12">Laat een reactie achter</h2>

            @auth
                <form action="{{ route('comments.store') }}" method="POST"
                    class="bg-white shadow-md rounded-lg p-8 space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-left text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" id="email" name="email"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                            required value="{{ old('email', Auth::user()->email) }}">
                    </div>
                    <div>
                        <label for="message" class="block text-left text-sm font-semibold text-gray-700">Bericht</label>
                        <textarea id="message" name="message" rows="4"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                            required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit"
                        class="bg-green-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-600 transition">
                        Verstuur
                    </button>
                </form>
            @else
                <p class="mt-4 text-red-500">
                    Je moet ingelogd zijn om een reactie achter te laten. <a href="{{ route('login') }}"
                        class="underline">Login</a>
                </p>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-green-600 text-white py-12">
        <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-6 md:mb-0">
                <h3 class="text-2xl font-bold">Green Mate</h3>
                <p class="text-green-100 mt-2">Samen voor een duurzamere toekomst.</p>
            </div>
            <div>
                <p class="text-sm">📍 Amsterdam, Nederland</p>
                <p class="text-sm">📞 +31 6 1234 5678</p>
                <p class="text-sm">✉️ info@greenmate.nl</p>
            </div>
        </div>
        <div class="text-center text-sm mt-8 text-green-200">
            &copy; {{ date('Y') }} Green Mate. Alle rechten voorbehouden.
        </div>
    </footer>

    <script type="module" src="{{ Vite::asset('resources/js/app.js') }}"></script>
</body>

</html>
