@extends('layout.app')

@section('content')
<!-- Wrapper for full-height background -->
<div class="relative w-full min-h-screen">
    <!-- Background Gradients -->
    <div class="absolute -top-12 right-1/4 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
    <div class="absolute bottom-1/3 -left-12 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>
    <div class="absolute top-2/3 -right-24 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-4000"></div>

    <!-- Content container -->
    <div class="min-h-[calc(100vh-4rem)] py-16">
        <div class="container mx-auto px-4">
            <!-- Back Button with animation - Moved here and changed from fixed to static -->
            <div class="mb-8">
                <a href="{{ route('projects') }}"
                   class="group inline-flex items-center space-x-3 px-5 py-2.5 bg-white/80
                          backdrop-blur-sm rounded-xl shadow-lg hover:shadow-xl
                          transform hover:-translate-y-0.5 transition-all duration-300
                          border border-gray-100 hover:border-purple-100">
                    <svg class="w-5 h-5 text-purple-600 transform group-hover:-translate-x-1 transition-transform duration-300"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="text-gray-700 font-medium text-sm">Back to Projects</span>

                    <!-- Hover effect circle -->
                    <div class="absolute inset-0 rounded-xl bg-purple-50/50 opacity-0
                                group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                </a>
            </div>

            @if(isset($project))
                <!-- Project Details with animations -->
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden animate-fade-in-up">
                    <div class="flex flex-col">
                        <!-- Project Image Section with hover effect and click popup -->
                        <div class="relative w-full md:h-[500px] group">
                            <div class="relative w-full h-full overflow-hidden">
                                <img src="{{ $project['demo_image'] }}"
                                     alt="{{ $project['title'] }}"
                                     onclick="openImagePopup('{{ $project['demo_image'] }}')"
                                     class="w-full h-auto md:h-full object-contain md:object-cover object-center transition-transform duration-500 group-hover:scale-105 cursor-pointer"
                                     style="min-height: auto; max-height: none; @media (min-width: 768px) { min-height: 500px; max-height: 500px; }">
                            </div>
                        </div>

                        <!-- Project Info Section -->
                        <div class="p-8 md:p-12 max-w-4xl mx-auto w-full">
                            <h1 class="text-3xl font-bold text-gray-800 mb-4 animate-fade-in-delay">
                                {{ $project['title'] }}
                            </h1>

                            <!-- Technologies Used -->
                            <div class="flex flex-wrap gap-2 mb-6 animate-fade-in-delay" style="animation-delay: 0.1s">
                                @foreach((array)$project['technologies'] as $tech)
                                    <span class="px-4 py-2 bg-purple-100 text-purple-600 rounded-full text-sm
                                               hover:bg-purple-200 transition-colors duration-300">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="mb-8 animate-fade-in-delay" style="animation-delay: 0.2s">
                                <h2 class="text-xl font-semibold text-gray-700 mb-3">Overview</h2>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ $project['description'] }}
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            @if(isset($project['link']) && $project['link'])
                                <div class="flex space-x-4 animate-fade-in-delay" style="animation-delay: 0.5s">
                                    <a href="{{ $project['link'] }}"
                                       target="_blank"
                                       class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-full
                                              hover:bg-purple-700 transition duration-300 transform hover:scale-105">
                                        <span>Repository</span>
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center text-gray-600 animate-fade-in">
                    Project not found
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Image Popup Modal -->
<div id="imagePopup" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center">
    <div class="relative w-full h-full flex items-center justify-center p-4">
        <button onclick="closeImagePopup()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors duration-300">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="popupImage" src="" alt="Enlarged project image" class="max-w-full max-h-[90vh] object-contain">
    </div>
</div>

<script>
function openImagePopup(imageSrc) {
    const popup = document.getElementById('imagePopup');
    const popupImage = document.getElementById('popupImage');
    popup.style.display = 'flex';
    popupImage.src = imageSrc;
    document.body.style.overflow = 'hidden';

    // Add fade-in animation
    popup.style.opacity = '0';
    popup.style.transition = 'opacity 0.3s ease-in-out';
    setTimeout(() => {
        popup.style.opacity = '1';
    }, 10);
}

function closeImagePopup() {
    const popup = document.getElementById('imagePopup');
    popup.style.opacity = '0';
    setTimeout(() => {
        popup.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
}

// Close popup when clicking outside the image
document.getElementById('imagePopup').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImagePopup();
    }
});

// Close popup with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImagePopup();
    }
});
</script>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
}

.animate-fade-in-delay {
    opacity: 0;
    animation: fadeInUp 0.8s ease-out forwards;
}

/* Custom media query untuk mengatur tinggi gambar di mobile */
@media (max-width: 767px) {
    .group img {
        height: auto !important;
        max-height: none !important;
        min-height: auto !important;
    }
}

/* Add new animation for popup */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

#imagePopup {
    animation: fadeIn 0.3s ease-in-out;
}

#popupImage {
    animation: fadeIn 0.3s ease-in-out 0.1s both;
}

/* Remove any existing button animations that might conflict */
.group {
    animation: none;
}

/* Optional: Add subtle underline animation on hover */
.group:hover span {
    background-image: linear-gradient(transparent 95%, currentColor 5%);
    background-repeat: no-repeat;
    background-size: 0% 100%;
    animation: underline 0.3s forwards;
}

@keyframes underline {
    to {
        background-size: 100% 100%;
    }
}

/* Add smooth transition for back button */
.group:hover .text-purple-600 {
    color: theme('colors.purple.700');
}

/* Add subtle pulse animation for better visibility */
@keyframes subtlePulse {
    0% { box-shadow: 0 0 0 0 rgba(147, 51, 234, 0.1); }
    70% { box-shadow: 0 0 0 10px rgba(147, 51, 234, 0); }
    100% { box-shadow: 0 0 0 0 rgba(147, 51, 234, 0); }
}

.group {
    animation: subtlePulse 2s infinite;
}
</style>
@endsection
