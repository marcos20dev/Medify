@extends('plantillas.portal.plantilla')

@section('title', 'Noticia '. $noticia->titulo)

@section('content')
    @if (session('success'))
        <div id="toastSuccess" class="fixed top-6 right-6 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg flex items-center space-x-2 z-50">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>

        <script>
            setTimeout(() => {
                document.getElementById('toastSuccess').style.display = 'none';
            }, 3000);
        </script>
    @endif

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-0">
        <!-- Botón de volver flotante -->
        <article class="relative">
            <!-- Enlace superior agregado -->
            <div class="mb-6">
                <a href="{{ route('noticias') }}" class="inline-flex items-center text-gray-500 hover:text-gray-700 transition-colors text-sm md:text-base">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver a noticias
                </a>
            </div>

            <!-- Cabecera con efecto de libro -->
            <header class="mb-8 md:mb-12 border-l-4 border-gray-800 pl-4 md:pl-6 -ml-4 md:-ml-8">
                <div class="flex items-baseline justify-between mb-4">
                    <span class="bg-gray-100 text-gray-600 px-2 md:px-3 py-1 rounded-full text-xs font-medium">Tendencias</span>
                </div>
                <h1 class="text-2xl md:text-4xl font-serif font-normal leading-tight tracking-tight text-gray-900 mb-4">{{ $noticia->titulo }}</h1>
                <div class="flex items-center space-x-3">
                    <div class="h-8 w-8 md:h-10 md:w-10 bg-gray-100 rounded-full"></div>
                    <div>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $noticia->etiquetas ?? '') as $tag)
                                @if(trim($tag) !== '')
                                    <span class="bg-gray-200 text-gray-700 text-xs md:text-sm px-2.5 py-0.5 rounded-full">
                {{ trim($tag) }}
            </span>
                                @endif
                            @endforeach
                            @if(empty($noticia->etiquetas))
                                <span class="text-xs text-gray-400 italic">Sin etiquetas</span>
                            @endif
                        </div>

                    </div>
                </div>

            </header>

            <!-- Imagen con leyenda -->
            <figure class="group relative overflow-hidden rounded-lg md:rounded-xl shadow mb-4">
                <img src="data:image/jpeg;base64,{{ $noticia->foto }}" alt="{{ $noticia->titulo }}"
                     class="w-full h-48 sm:h-64 md:h-96 object-cover transform transition-all duration-700 ease-out group-hover:scale-105">
                <figcaption class="absolute bottom-0 w-full bg-gradient-to-t from-gray-900/80 to-transparent px-3 md:px-4 py-2 md:py-3">
                    <p class="text-xs md:text-sm text-white/90 italic font-light">{{ $noticia->leyenda ?? 'Fotografía: Archivo' }}</p>
                </figcaption>
            </figure>

            <div class="pt-2 border-t border-gray-100 flex flex-wrap gap-4 items-center justify-between">
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
                    <div class="relative">
                        <button onclick="sharePage()" class="flex items-center px-3 py-1.5 sm:px-4 sm:py-2 space-x-2 bg-gray-50 hover:bg-gray-100 rounded-full transition-all text-sm">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                            <span class="text-gray-600">Compartir</span>
                        </button>

                        <!-- Menú de compartir -->
                        <div id="shareMenu" class="hidden absolute top-10 sm:top-12 left-0 bg-white shadow-lg rounded-xl p-3 sm:p-4 w-40 sm:w-44 z-50">
                            <button onclick="copyLink({{ $noticia->id }})" class="block w-full text-left text-xs sm:text-sm text-gray-700 hover:text-indigo-600">
                                📋 Copiar enlace
                            </button>
                        </div>
                    </div>

                    <button onclick="handleLike(this)" data-id="{{ $noticia->id }}" class="like-button flex items-center px-3 py-1.5 sm:px-4 sm:py-2 space-x-2 bg-gray-50 hover:bg-gray-100 rounded-full transition-all group text-sm">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-rose-500 group-hover:scale-110 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-600 like-count">{{ $noticia->likes }}</span>
                    </button>
                </div>
                <div class="text-xs sm:text-sm text-gray-400">Tiempo de lectura: 5 min</div>
            </div>

            <div class="pt-6 md:pt-8 contenido-html max-w-none font-serif text-gray-800 leading-relaxed">
                {!! $noticia->descripcion !!}
            </div>

            <style>
                .contenido-html ul {
                    list-style-type: disc;
                    padding-left: 1.5rem;
                    margin-top: 1rem;
                    margin-bottom: 1rem;
                }

                .contenido-html li {
                    margin-bottom: 0.5rem;
                }

                .contenido-html h1, .contenido-html h2, .contenido-html h3 {
                    margin-top: 1.5rem;
                    margin-bottom: 0.5rem;
                    font-weight: 600;
                    color: #1f2937; /* gris oscuro */
                }

                .contenido-html p {
                    margin-bottom: 1rem;
                }

            </style>
            <style>
                .contenido-html {
                    /* Estilos existentes... */

                    /* Nuevos estilos para video responsivo */
                    .video-container {
                        position: relative;
                        padding-bottom: 56.25%; /* Relación 16:9 */
                        height: 0;
                        overflow: hidden;
                        margin: 1.5rem 0;
                    }

                    .video-container iframe,
                    .video-container video {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100% !important;
                        height: 100% !important;
                    }

                    /* Asegurar que los videos embebidos sean responsivos */
                    iframe[src*="youtube"],
                    iframe[src*="vimeo"] {
                        width: 100%;
                        height: auto;
                        aspect-ratio: 16/9;
                    }

                    /* Para elementos video HTML5 */
                    video {
                        max-width: 100%;
                        height: auto;
                    }
                }
            </style>


            <!-- Sección de autor detallada -->
            <div class="mt-8 md:mt-16 p-4 md:p-8 bg-gray-50/80 rounded-xl md:rounded-2xl backdrop-blur-sm">
                <div class="flex items-center gap-4 md:gap-5">
                    <img src="{{ asset('img/hospital.png') }}" alt="Hospital Distrital de Laredo" class="h-12 w-12 md:h-16 md:w-16 rounded-full object-cover">
                    <div>
                        <h3 class="font-serif text-base md:text-lg text-gray-900">Hospital Distrital de Laredo</h3>
                        <p class="text-xs md:text-sm text-gray-500">Estamos a tu disposición para cuidar de tu salud con compromiso y cercanía. Hospital Distrital de Laredo.</p>
                    </div>
                </div>
            </div>


            <!-- Sección de comentarios -->
            <div class="mt-8 md:mt-16 space-y-8 md:space-y-12">
                <div class="border-t border-gray-100 pt-8 md:pt-12">
                    <h2 class="font-serif text-xl md:text-2xl text-gray-900 mb-4 md:mb-8">Comentarios Anónimos</h2>

                    <!-- Formulario de comentario -->
                    <div class="mb-8 md:mb-12 bg-white rounded-xl md:rounded-2xl shadow-sm p-4 md:p-6">
                        <form action="{{ route('noticia.comentar', $noticia->id) }}" method="POST">
                            @csrf
                            <div class="space-y-3 md:space-y-4">
                               <textarea
                                   name="comentario"
                                   rows="3"
                                   maxlength="200"
                                   class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-200 rounded-lg md:rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent placeholder-gray-400 resize-none text-sm md:text-base"
                                   placeholder="Escribe tu comentario (máximo 200 caracteres)..."
                                   required
                               ></textarea>

                                <div class="flex justify-end">
                                    <button
                                        type="submit"
                                        class="px-4 py-1.5 md:px-6 md:py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-full text-xs md:text-sm font-medium transition-colors"
                                    >
                                        Publicar comentario
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Lista de comentarios -->

                    <div class="space-y-8 mb-12">
                        @forelse ($comentarios as $comentario)
                            <div class="group relative pl-4 md:pl-6">
                                <div class="border-l-2 border-gray-200 pl-4">
                                    <div class="prose prose-sm md:prose-gray max-w-none text-gray-700">
                                        <p>{{ $comentario->contenido }}</p>
                                    </div>
                                    <div class="mt-2 text-xs text-gray-500">
                                        {{ $comentario->created_at->format('d M Y, H:i') }} — {{ $comentario->created_at->diffForHumans() }}
                                    </div>

                                    <!-- ✅ Botón Like al final del comentario -->
                                    <div class="mt-3">
                                        <button onclick="likeComentario(this)" data-id="{{ $comentario->id }}" class="flex items-center space-x-1 text-sm text-gray-500 hover:text-rose-500 transition">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="like-count">{{ $comentario->likecomentario }}</span>
                                        </button>
                                    </div>
                                </div>

                                @if (!$loop->last)
                                    <hr class="mt-6 border-gray-200">
                                @endif
                            </div>
                        @empty
                            <div class="text-center text-sm text-gray-500 italic mt-8">✨ ¡Rompe el hielo y comenta primero!</div>
                        @endforelse
                    </div>

                </div>
            </div>
        </article>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        function likeComentario(button) {
            const comentarioId = button.getAttribute('data-id');

            fetch(`/comentario/${comentarioId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then(data => {
                    button.querySelector('.like-count').innerText = data.likecomentario;
                    button.disabled = true;
                    button.classList.add('opacity-50', 'cursor-not-allowed');
                })
                .catch(err => {
                    if (err.status === 403) {
                        button.disabled = true;
                        button.classList.add('opacity-50', 'cursor-not-allowed');
                    } else {
                        console.error('Error al dar like:', err);
                    }
                });
        }
    </script>

    <script>
        function handleLike(button) {
            const noticiaId = button.getAttribute('data-id');

            fetch(`/noticia/${noticiaId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then(data => {
                    button.querySelector('.like-count').innerText = data.likes;
                    button.disabled = true;
                    button.classList.add('opacity-50', 'cursor-not-allowed');
                })
                .catch(err => {
                    if (err.status === 403) {
                        button.disabled = true;
                        button.classList.add('opacity-50', 'cursor-not-allowed');
                    } else {
                        console.error('Error:', err);
                    }
                });

        }
    </script>
    <script>
        function sharePage() {
            const noticiaId = {{ $noticia->id }};

            if (navigator.share && isMobile()) {
                navigator.share({
                    title: document.title,
                    text: 'Mira esta noticia interesante:',
                    url: window.location.href
                }).then(() => {
                    incrementarCompartido(noticiaId);
                }).catch((error) => {
                    console.error('Error al compartir:', error);
                });
            } else {
                // Mostrar menú en PC
                toggleShareMenu();
            }
        }

        function toggleShareMenu() {
            const menu = document.getElementById('shareMenu');
            menu.classList.toggle('hidden');
        }

        function copyLink(noticiaId) {
            navigator.clipboard.writeText(window.location.href).then(() => {
                incrementarCompartido(noticiaId);
                document.getElementById('shareMenu').classList.add('hidden');
                showToast("Enlace copiado al portapapeles");
            });
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            const text = document.getElementById('toast-text');
            text.innerText = message;
            toast.classList.remove('hidden');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 2500);
        }


        function incrementarCompartido(id) {
            fetch(`/noticia/${id}/compartir`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => {
                if (!res.ok) throw res;
                return res.json();
            }).then(data => {
                console.log('Compartido +1:', data.compartidos);
            }).catch(err => {
                if (err.status === 403) {
                    console.log('Ya se había contado esta compartición.');
                } else {
                    console.error('Error al contar compartido:', err);
                }
            });
        }

        function isMobile() {
            return /android|iphone|ipad|ipod/i.test(navigator.userAgent);
        }

        // Cierra el menú al hacer clic fuera
        document.addEventListener('click', function (e) {
            const menu = document.getElementById('shareMenu');
            if (!e.target.closest('#shareMenu') && !e.target.closest('[onclick="sharePage()"]')) {
                menu.classList.add('hidden');
            }
        });
    </script>



@endsection
