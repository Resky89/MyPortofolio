@extends('layout.app')

@section('content')
<!-- Wrapper for full-height background -->
<div class="relative w-full min-h-screen">
    <!-- Background Gradients - New positions -->
    <div class="absolute top-1/4 -right-48 w-[28rem] h-[28rem] bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
    <div class="absolute -bottom-24 left-1/3 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>
    <div class="absolute top-12 left-12 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-4000"></div>

    <!-- Content container -->
    <div class="min-h-[calc(100vh-4rem)] py-12">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Main Content Grid -->
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left Side - Image (akan muncul di atas pada mobile) -->
                <div class="relative max-w-sm mx-auto md:max-w-md order-1 md:order-none" data-aos="fade-right" data-aos-duration="1000">
                    <!-- Updated image container with modern styling -->
                    <div class="relative">
                        <!-- Main image container with glass effect -->
                        <div class="relative bg-white/30 backdrop-blur-sm rounded-[2rem] p-3 shadow-xl z-10 border border-white/20 transition-all duration-300 hover:shadow-2xl group">
                            <div class="overflow-hidden rounded-[1.75rem]">
                                <img src="{{ asset('images/me.png') }}" alt="About Me"
                                     class="w-full h-full object-cover object-center transform transition-all duration-500 group-hover:scale-110">
                            </div>
                        </div>

                        <!-- Badge with gradient -->
                        <div class="absolute -bottom-4 right-4 bg-gradient-to-r from-purple-600 to-purple-800 text-white px-4 md:px-6 py-2 md:py-2.5 rounded-full shadow-lg z-20 hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <span class="text-xs md:text-sm font-medium whitespace-nowrap">Muhammad Resky Prabowo Sutejo</span>
                        </div>

                        <!-- Decorative elements -->
                        <div class="absolute -top-4 -right-4 w-full h-full bg-purple-100/50 rounded-[2rem] -z-10 transform rotate-6 backdrop-blur-sm"></div>
                        <div class="absolute -bottom-4 -left-4 w-full h-full bg-purple-200/50 rounded-[2rem] -z-20 transform -rotate-3 backdrop-blur-sm"></div>
                    </div>
                </div>

                <!-- Right Side - Content -->
                <div class="space-y-12 order-2 md:order-none">
                    <!-- Header Section -->
                    <div class="space-y-4" data-aos="fade-up" data-aos-duration="1000">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">About Me</h2>
                        <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                            I am a student at Binaniaga Indonesia University, majoring in Informatics Engineering. I am passionate about web and mobile development, with a strong focus on both frontend and backend technologies. Experienced in managing information systems and actively involved in organizations. Highly motivated to continuously learn and improve skills in the IT world.
                        </p>
                    </div>

                    <!-- Stats with counter animation - Tanpa Card -->
                    <div class="grid grid-cols-2 gap-8" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-center">
                            <div class="space-y-2 animate-count" data-target="6">
                                <h3 class="text-3xl md:text-4xl font-bold text-purple-600">0</h3>
                                <p class="text-sm md:text-base text-gray-600 font-medium">Semester</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="space-y-2 animate-count" data-target="{{ $projectCount }}">
                                <h3 class="text-3xl md:text-4xl font-bold text-purple-600">0</h3>
                                <p class="text-sm md:text-base text-gray-600 font-medium">Projects Completed</p>
                            </div>
                        </div>
                    </div>

                    <!-- Skills Section - Tanpa Card -->
                    <div class="space-y-8" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="text-xl md:text-2xl font-semibold text-gray-800">Core Skills</h3>
                        <div class="grid grid-cols-2 gap-6">
                            <!-- Skill Items -->
                            <div class="skill-item group" data-aos="fade-up" data-aos-delay="500">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-full bg-purple-100 group-hover:bg-purple-200 transition-colors duration-300">
                                        <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-5a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm md:text-base text-gray-700 font-medium group-hover:text-purple-600 transition-colors duration-300">Frontend Development</span>
                                </div>
                            </div>

                            <div class="skill-item group" data-aos="fade-up" data-aos-delay="600">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-full bg-purple-100 group-hover:bg-purple-200 transition-colors duration-300">
                                        <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-5a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm md:text-base text-gray-700 font-medium group-hover:text-purple-600 transition-colors duration-300">Backend Development</span>
                                </div>
                            </div>

                            <div class="skill-item group" data-aos="fade-up" data-aos-delay="700">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-full bg-purple-100 group-hover:bg-purple-200 transition-colors duration-300">
                                        <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-5a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm md:text-base text-gray-700 font-medium group-hover:text-purple-600 transition-colors duration-300">Mobile Development</span>
                                </div>
                            </div>

                            <div class="skill-item group" data-aos="fade-up" data-aos-delay="800">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-full bg-purple-100 group-hover:bg-purple-200 transition-colors duration-300">
                                        <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-5a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm md:text-base text-gray-700 font-medium group-hover:text-purple-600 transition-colors duration-300">Web Development</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi AOS
    AOS.init({
        duration: 1000,
        once: true,
        offset: 50,
        easing: 'ease-out-cubic'
    });

    // Counter animation yang lebih smooth
    const counters = document.querySelectorAll('.animate-count');

    const animateCounter = (counter) => {
        const target = parseInt(counter.dataset.target);
        const h3 = counter.querySelector('h3');
        let current = 0;

        const increment = target / 50; // Membuat animasi lebih smooth

        const updateCounter = () => {
            if (current < target) {
                current += increment;
                h3.textContent = Math.ceil(current);
                requestAnimationFrame(updateCounter);
            } else {
                h3.textContent = target;
            }
        };

        updateCounter();
    };

    // Intersection Observer untuk memulai counter animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.5
    });

    counters.forEach(counter => observer.observe(counter));
});
</script>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

/* Smooth transitions */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}
</style>
@endsection
