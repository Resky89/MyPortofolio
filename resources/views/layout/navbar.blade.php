<nav class="bg-white shadow-lg fixed w-full top-0 z-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo/Brand -->
            <div class="flex-shrink-0">
                <a href="/" class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-purple-800 bg-clip-text text-transparent">
                    Portofolio
                </a>
            </div>

            <!-- Desktop Menu - Moved to the right side -->
            <div class="hidden md:flex items-center space-x-8">
                <div class="flex space-x-6">
                    <a href="/" class="text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md transition duration-300 relative group {{ request()->is('/') ? 'text-purple-600' : '' }}">
                        Home
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->is('/') ? 'scale-x-100' : '' }}"></span>
                    </a>
                    <a href="/about" class="text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md transition duration-300 relative group {{ request()->is('about') ? 'text-purple-600' : '' }}">
                        About Me
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->is('about') ? 'scale-x-100' : '' }}"></span>
                    </a>
                    <a href="/projects" class="text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md transition duration-300 relative group {{ request()->is('projects') ? 'text-purple-600' : '' }}">
                        Projects
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->is('projects') ? 'scale-x-100' : '' }}"></span>
                    </a>
                </div>
                <!-- Hire Me Button -->
                <div class="ml-6">
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=reskyprabowo89@gmail.com&su=Job%20Opportunity&body=Hello%20Resky,%0D%0A%0D%0AI%20would%20like%20to%20discuss%20a%20job%20opportunity%20with%20you.%0D%0A%0D%0ABest%20regards,"
                       target="_blank"
                       class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-6 py-2 rounded-full hover:shadow-lg transition duration-300">
                        Hire Me!
                    </a>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-purple-600 focus:outline-none p-2 rounded-lg transition duration-300 hover:bg-purple-50">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <a href="/" class="block text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md transition duration-300 {{ request()->is('/') ? 'bg-purple-50 text-purple-600' : '' }}">
                Home
            </a>
            <a href="/about" class="block text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md transition duration-300 {{ request()->is('about') ? 'bg-purple-50 text-purple-600' : '' }}">
                About Me
            </a>
            <a href="/projects" class="block text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md transition duration-300 {{ request()->is('projects') ? 'bg-purple-50 text-purple-600' : '' }}">
                Projects
            </a>
            <a href="mailto:reskyprabowo89@gmail.com?subject=Job%20Opportunity&body=Hello%20Resky,%0D%0A%0D%0AI%20would%20like%20to%20discuss%20a%20job%20opportunity%20with%20you."
               class="block bg-gradient-to-r from-purple-600 to-purple-800 text-white px-4 py-2 rounded-full mt-4 text-center hover:shadow-lg transition duration-300">
                Hire Me!
            </a>
        </div>
    </div>
</nav>

<script>
    // Toggle mobile menu
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
