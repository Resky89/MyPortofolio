@extends('layout.app')

@section('content')
<!-- Wrapper for full-height background -->
<div class="relative w-full min-h-screen">
    <!-- Background Gradients - Different positions for projects page -->
    <div class="absolute -top-12 left-1/3 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
    <div class="absolute bottom-1/4 -right-12 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>
    <div class="absolute top-1/2 -left-24 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-4000"></div>

    <!-- Content container -->
    <div class="min-h-[calc(100vh-4rem)] py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">My Projects</h2>
                <p class="text-gray-600">Showcasing some of my best work</p>
            </div>

            <!-- Projects Grid with improved animation -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($projects as $index => $project)
                    <div class="group relative overflow-hidden rounded-2xl transform transition-all duration-500 hover:-translate-y-2 hover:shadow-xl"
                         data-aos="fade-up"
                         data-aos-delay="{{ $index * 100 }}">
                        <!-- Project Image -->
                        <img src="{{ $project['demo_image'] }}"
                             alt="{{ $project['title'] }}"
                             class="w-full h-64 object-cover transform transition-transform duration-500 group-hover:scale-110">

                        <!-- Simplified Overlay Content - Only Title -->
                        <div class="absolute inset-0 bg-gradient-to-t from-purple-900/90 to-purple-600/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                            <div class="text-center text-white p-6 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                <h3 class="text-2xl font-bold">{{ $project['title'] }}</h3>
                                <!-- View Button -->
                                <a href="{{ route('project.show', $project['id']) }}"
                                   class="mt-4 inline-block px-6 py-2 border-2 border-white rounded-full hover:bg-white hover:text-purple-600 transition duration-300">
                                    View Project
                                </a>
                                <!-- Admin Buttons -->
                                <div class="mt-2 space-x-2">
                                    <button onclick="editProject({{ json_encode($project) }})"
                                            class="admin-button hidden px-6 py-2 border-2 border-blue-500 rounded-full text-white hover:bg-blue-500 hover:text-white transition duration-300">
                                        Edit
                                    </button>
                                    <button onclick="deleteProject({{ $project['id'] }})"
                                            class="admin-button hidden px-6 py-2 border-2 border-red-500 rounded-full text-white hover:bg-red-500 hover:text-white transition duration-300">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-600" data-aos="fade-up">
                        No projects found
                    </div>
                @endforelse
            </div>

            <!-- Add Project Button -->
            <div class="text-center mt-8">
                <button
                    type="button"
                    id="openModal"
                    class="hidden inline-block px-6 py-2 rounded-full bg-purple-600 text-white hover:bg-purple-700 transition duration-300"
                >
                    Add Project
                </button>
            </div>

            <!-- Modal -->
            <div id="projectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
                <div class="relative top-20 mx-auto p-5 w-full max-w-2xl">
                    <div class="relative bg-white rounded-3xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold mb-6">Add New Project</h2>

                        <!-- Form content -->
                        <form id="projectForm" enctype="multipart/form-data" class="overflow-y-auto max-h-[60vh]">
                            @csrf
                            <input type="hidden" name="project_id" value="">
                            <!-- Project Name -->
                            <div class="mb-6">
                                <label for="projectName" class="block text-gray-700 mb-2">Project Name</label>
                                <input type="text" id="projectName" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <label for="projectDescription" class="block text-gray-700 mb-2">Description</label>
                                <textarea id="projectDescription" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" rows="4" required></textarea>
                            </div>

                            <!-- Project Link -->
                            <div class="mb-6">
                                <label for="projectLink" class="block text-gray-700 mb-2">Project Link</label>
                                <input type="url" id="projectLink" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="https://example.com">
                            </div>

                            <!-- Demo Image Upload -->
                            <div class="mb-6">
                                <label for="demoImage" class="block text-gray-700 mb-2">Demo Image</label>
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col w-full h-32 border-2 border-dashed border-purple-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                        <div class="flex flex-col items-center justify-center pt-7">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="pt-1 text-sm tracking-wider text-gray-400">Upload image</p>
                                        </div>
                                        <input type="file" id="demoImage" accept="image/*" class="opacity-0" />
                                    </label>
                                </div>
                                <div id="imagePreview" class="mt-2 hidden">
                                    <img src="" alt="Preview" class="max-h-32 rounded-lg">
                                </div>
                            </div>

                            <!-- Technologies as Toggle Buttons -->
                            <div class="mb-6">
                                <label class="block text-gray-700 mb-3">Technologies</label>
                                <div class="flex flex-wrap gap-2">
                                    <!-- Web Development -->
                                    <button type="button" data-tech="Laravel" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Laravel</button>
                                    <button type="button" data-tech="React" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">React</button>
                                    <button type="button" data-tech="Vue.js" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Vue.js</button>
                                    <button type="button" data-tech="Angular" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Angular</button>
                                    <button type="button" data-tech="Svelte" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Svelte</button>
                                    <button type="button" data-tech="Node.js" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Node.js</button>
                                    <button type="button" data-tech="Express" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Express</button>
                                    <button type="button" data-tech="Django" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Django</button>
                                    <button type="button" data-tech="Flask" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Flask</button>
                                    <button type="button" data-tech="FastAPI" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">FastAPI</button>

                                    <!-- Mobile Development -->
                                    <button type="button" data-tech="React Native" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">React Native</button>
                                    <button type="button" data-tech="Flutter" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Flutter</button>
                                    <button type="button" data-tech="Swift" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Swift</button>
                                    <button type="button" data-tech="Kotlin" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Kotlin</button>
                                    <button type="button" data-tech="SwiftUI" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">SwiftUI</button>
                                    <button type="button" data-tech="Jetpack Compose" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Jetpack Compose</button>

                                    <!-- Frontend -->
                                    <button type="button" data-tech="HTML5" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">HTML5</button>
                                    <button type="button" data-tech="CSS3" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">CSS3</button>
                                    <button type="button" data-tech="JavaScript" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">JavaScript</button>
                                    <button type="button" data-tech="TypeScript" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">TypeScript</button>
                                    <button type="button" data-tech="Tailwind" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Tailwind</button>
                                    <button type="button" data-tech="Bootstrap" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Bootstrap</button>
                                    <button type="button" data-tech="SASS" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">SASS</button>
                                    <button type="button" data-tech="Material UI" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Material UI</button>

                                    <!-- Backend -->
                                    <button type="button" data-tech="PHP" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">PHP</button>
                                    <button type="button" data-tech="Python" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Python</button>
                                    <button type="button" data-tech="Java" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Java</button>
                                    <button type="button" data-tech="Go" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Go</button>
                                    <button type="button" data-tech="Ruby" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Ruby</button>
                                    <button type="button" data-tech="C#" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">C#</button>
                                    <button type="button" data-tech="Rust" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Rust</button>

                                    <!-- Database -->
                                    <button type="button" data-tech="MySQL" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">MySQL</button>
                                    <button type="button" data-tech="PostgreSQL" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">PostgreSQL</button>
                                    <button type="button" data-tech="MongoDB" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">MongoDB</button>
                                    <button type="button" data-tech="Redis" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Redis</button>
                                    <button type="button" data-tech="SQLite" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">SQLite</button>
                                    <button type="button" data-tech="Firebase" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Firebase</button>

                                    <!-- DevOps & Cloud -->
                                    <button type="button" data-tech="Docker" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Docker</button>
                                    <button type="button" data-tech="Kubernetes" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Kubernetes</button>
                                    <button type="button" data-tech="AWS" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">AWS</button>
                                    <button type="button" data-tech="GCP" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">GCP</button>
                                    <button type="button" data-tech="Azure" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Azure</button>
                                    <button type="button" data-tech="Jenkins" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Jenkins</button>
                                    <button type="button" data-tech="Git" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Git</button>
                                    <button type="button" data-tech="GitHub Actions" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">GitHub Actions</button>

                                    <!-- UI/UX Design -->
                                    <button type="button" data-tech="Figma" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Figma</button>
                                    <button type="button" data-tech="Adobe XD" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Adobe XD</button>
                                    <button type="button" data-tech="Sketch" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Sketch</button>
                                    <button type="button" data-tech="InVision" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">InVision</button>
                                    <button type="button" data-tech="Principle" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Principle</button>
                                    <button type="button" data-tech="Framer" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Framer</button>
                                    <button type="button" data-tech="Protopie" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Protopie</button>
                                    <button type="button" data-tech="Zeplin" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Zeplin</button>
                                    <button type="button" data-tech="Adobe Photoshop" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Adobe Photoshop</button>
                                    <button type="button" data-tech="Adobe Illustrator" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Adobe Illustrator</button>
                                    <button type="button" data-tech="Maze" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Maze</button>
                                    <button type="button" data-tech="UsabilityHub" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">UsabilityHub</button>
                                    <button type="button" data-tech="Optimal Workshop" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Optimal Workshop</button>
                                    <button type="button" data-tech="Hotjar" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Hotjar</button>
                                    <button type="button" data-tech="Miro" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Miro</button>
                                    <button type="button" data-tech="Balsamiq" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Balsamiq</button>
                                    <button type="button" data-tech="Abstract" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Abstract</button>
                                    <button type="button" data-tech="UX Pin" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">UX Pin</button>
                                    <button type="button" data-tech="Adobe After Effects" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Adobe After Effects</button>
                                    <button type="button" data-tech="Lottie" class="tech-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-600 hover:text-white transition duration-300">Lottie</button>
                                </div>
                                <input type="hidden" id="selectedTechnologies" name="technologies">
                            </div>

                            <!-- Form Actions -->
                            <div class="flex space-x-4">
                                <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition duration-300">Submit</button>
                                <button type="button" id="closeModal" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 transition duration-300">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add validation error display -->
            <div id="validationErrors" class="hidden mb-4 p-4 rounded-lg bg-red-100 text-red-700">
            </div>

            <script>
                // Secret key combination handler (Ctrl + Shift + A)
                let keysPressed = {};

                document.addEventListener('keydown', function(event) {
                    keysPressed[event.key] = true;

                    if (keysPressed['Control'] && keysPressed['Shift'] && event.key === 'A') {
                        event.preventDefault();
                        const addButton = document.getElementById('openModal');
                        const adminButtons = document.querySelectorAll('.admin-button');

                        // Toggle add button
                        addButton.classList.toggle('hidden');

                        // Toggle edit and delete buttons
                        adminButtons.forEach(button => {
                            button.classList.toggle('hidden');
                        });

                        // Auto-hide after 3 seconds
                        setTimeout(() => {
                            addButton.classList.add('hidden');
                            adminButtons.forEach(button => {
                                button.classList.add('hidden');
                            });
                        }, 3000);
                    }
                });

                document.addEventListener('keyup', function(event) {
                    delete keysPressed[event.key];
                });

                // Pindahkan fungsi ke global scope
                window.editProject = function(project) {
                    const modal = document.getElementById('projectModal');
                    const form = document.getElementById('projectForm');
                    const modalTitle = modal.querySelector('h2');
                    modalTitle.textContent = 'Edit Project';

                    // Reset validation errors
                    const errorDiv = document.getElementById('validationErrors');
                    errorDiv.classList.add('hidden');
                    errorDiv.innerHTML = '';

                    // Isi form dengan data project yang ada
                    document.getElementById('projectName').value = project.title;
                    document.getElementById('projectDescription').value = project.description;
                    document.getElementById('projectLink').value = project.link;
                    document.getElementById('selectedTechnologies').value = project.technologies.join(',');

                    // Set image preview
                    const imagePreview = document.getElementById('imagePreview');
                    const previewImg = imagePreview.querySelector('img');
                    const demoImageUrl = project.demo_image.startsWith('http')
                        ? project.demo_image
                        : `https://portofolio-api-eta.vercel.app${project.demo_image}`;
                    previewImg.src = demoImageUrl;
                    imagePreview.classList.remove('hidden');

                    // Reset dan set technologies
                    const techButtons = document.querySelectorAll('.tech-btn');
                    techButtons.forEach(button => {
                        const tech = button.dataset.tech;
                        if (project.technologies.includes(tech)) {
                            button.classList.remove('bg-gray-200', 'text-gray-700');
                            button.classList.add('bg-purple-600', 'text-white');
                        } else {
                            button.classList.add('bg-gray-200', 'text-gray-700');
                            button.classList.remove('bg-purple-600', 'text-white');
                        }
                    });

                    // Set form submission untuk update
                    form.onsubmit = async function(e) {
                        e.preventDefault();

                        // Validasi
                        const modalErrorDiv = document.createElement('div');
                        modalErrorDiv.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-700';
                        const errorMessages = [];

                        const title = document.getElementById('projectName').value;
                        const description = document.getElementById('projectDescription').value;
                        const technologies = document.getElementById('selectedTechnologies').value;
                        const link = document.getElementById('projectLink').value;
                        const demoImage = document.getElementById('demoImage').files[0];

                        // Validasi field
                        if (!title || title.length < 3) errorMessages.push('Title must be at least 3 characters');
                        if (!description || description.length < 10) errorMessages.push('Description must be at least 10 characters');
                        if (!technologies) errorMessages.push('Please select at least one technology');
                        if (!link || !link.match(/^https?:\/\/.+/)) errorMessages.push('Please enter a valid URL');

                        if (errorMessages.length > 0) {
                            const existingError = this.querySelector('.bg-red-100');
                            if (existingError) existingError.remove();
                            modalErrorDiv.innerHTML = errorMessages.map(msg => `<p>${msg}</p>`).join('');
                            this.insertBefore(modalErrorDiv, this.firstChild);
                            return;
                        }

                        const formData = new FormData();
                        formData.append('_method', 'PUT'); // Tambahkan method PUT
                        formData.append('title', title);
                        formData.append('description', description);
                        formData.append('technologies', technologies);
                        formData.append('link', link);

                        // Handle image
                        if (demoImage) {
                            formData.append('demo_image', demoImage);
                        } else {
                            formData.append('demo_image', project.demo_image); // Kirim existing image path
                        }

                        try {
                            const response = await fetch(`/projects/${project.id}`, {
                                method: 'POST', // Gunakan POST dengan _method: PUT
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                }
                            });

                            const result = await response.json();
                            console.log('Update Response:', result); // Debug response

                            if (result.success) {
                                window.location.reload();
                            } else {
                                const existingError = this.querySelector('.bg-red-100');
                                if (existingError) existingError.remove();
                                modalErrorDiv.innerHTML = result.message || 'Failed to update project';
                                this.insertBefore(modalErrorDiv, this.firstChild);
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            const existingError = this.querySelector('.bg-red-100');
                            if (existingError) existingError.remove();
                            modalErrorDiv.textContent = 'An unexpected error occurred';
                            this.insertBefore(modalErrorDiv, this.firstChild);
                        }
                    };

                    modal.classList.remove('hidden');
                };

                // Separate handler for creating new project
                document.getElementById('openModal').addEventListener('click', function() {
                    const form = document.getElementById('projectForm');
                    form.reset();

                    document.querySelector('#projectModal h2').textContent = 'Add New Project';
                    document.getElementById('imagePreview').classList.add('hidden');

                    // Reset technology buttons
                    document.querySelectorAll('.tech-btn').forEach(button => {
                        button.classList.add('bg-gray-200', 'text-gray-700');
                        button.classList.remove('bg-purple-600', 'text-white');
                    });

                    document.getElementById('selectedTechnologies').value = '';

                    // Set form submission untuk create
                    form.onsubmit = async function(e) {
                        e.preventDefault();

                        // Validasi di dalam modal
                        const modalErrorDiv = document.createElement('div');
                        modalErrorDiv.className = 'mb-4 p-4 rounded-lg bg-red-100 text-red-700';
                        const errorMessages = [];

                        const title = document.getElementById('projectName').value;
                        const description = document.getElementById('projectDescription').value;
                        const technologies = document.getElementById('selectedTechnologies').value;
                        const link = document.getElementById('projectLink').value;
                        const demoImage = document.getElementById('demoImage').files[0];

                        if (!title || title.length < 3) errorMessages.push('Title must be at least 3 characters');
                        if (!description || description.length < 10) errorMessages.push('Description must be at least 10 characters');
                        if (!technologies) errorMessages.push('Please select at least one technology');
                        if (!link || !link.match(/^https?:\/\/.+/)) errorMessages.push('Please enter a valid URL');
                        if (!demoImage) errorMessages.push('Please select an image');

                        // Tampilkan error di dalam modal jika ada
                        if (errorMessages.length > 0) {
                            const existingError = this.querySelector('.bg-red-100');
                            if (existingError) existingError.remove();

                            modalErrorDiv.innerHTML = errorMessages.map(msg => `<p>${msg}</p>`).join('');
                            this.insertBefore(modalErrorDiv, this.firstChild);
                            return;
                        }

                        const formData = new FormData();
                        formData.append('title', title);
                        formData.append('description', description);
                        formData.append('technologies', technologies);
                        formData.append('link', link);
                        formData.append('demo_image', demoImage);

                        try {
                            const response = await fetch('/projects', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            });

                            const result = await response.json();
                            if (result.success) {
                                window.location.reload();
                            } else {
                                const existingError = this.querySelector('.bg-red-100');
                                if (existingError) existingError.remove();

                                modalErrorDiv.innerHTML = result.message || 'Failed to create project';
                                this.insertBefore(modalErrorDiv, this.firstChild);
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            const existingError = this.querySelector('.bg-red-100');
                            if (existingError) existingError.remove();

                            modalErrorDiv.textContent = 'An unexpected error occurred';
                            this.insertBefore(modalErrorDiv, this.firstChild);
                        }
                    };
                });

                window.deleteProject = function(projectId) {
                    if (confirm('Are you sure you want to delete this project?')) {
                        fetch(`/projects/${projectId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.success) {
                                window.location.reload();
                            } else {
                                alert(result.message || 'Failed to delete project');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An unexpected error occurred');
                        });
                    }
                }

                // Modal functionality
                document.addEventListener('DOMContentLoaded', function() {
                    const modal = document.getElementById('projectModal');
                    const openModalBtn = document.getElementById('openModal');
                    const closeModalBtn = document.getElementById('closeModal');
                    const projectForm = document.getElementById('projectForm');

                    // Debug
                    console.log('Modal:', modal);
                    console.log('Open button:', openModalBtn);
                    console.log('Close button:', closeModalBtn);

                    // Open modal
                    openModalBtn.addEventListener('click', function() {
                        console.log('Opening modal');
                        modal.classList.remove('hidden');
                    });

                    // Close modal
                    closeModalBtn.addEventListener('click', function() {
                        modal.classList.add('hidden');
                    });

                    // Close on outside click
                    window.addEventListener('click', function(event) {
                        if (event.target === modal) {
                            modal.classList.add('hidden');
                        }
                    });

                    // Image preview functionality
                    const demoImage = document.getElementById('demoImage');
                    const imagePreview = document.getElementById('imagePreview');
                    const previewImg = imagePreview.querySelector('img');

                    demoImage.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                previewImg.src = e.target.result;
                                imagePreview.classList.remove('hidden');
                            }
                            reader.readAsDataURL(file);
                        }
                    });

                    // Technologies toggle functionality
                    const techButtons = document.querySelectorAll('.tech-btn');
                    const selectedTechnologies = new Set();

                    techButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const tech = this.dataset.tech;
                            if (this.classList.contains('bg-purple-600')) {
                                // Deselect
                                this.classList.remove('bg-purple-600', 'text-white');
                                this.classList.add('bg-gray-200', 'text-gray-700');
                                selectedTechnologies.delete(tech);
                            } else {
                                // Select
                                this.classList.remove('bg-gray-200', 'text-gray-700');
                                this.classList.add('bg-purple-600', 'text-white');
                                selectedTechnologies.add(tech);
                            }
                            document.getElementById('selectedTechnologies').value = Array.from(selectedTechnologies).join(',');
                        });
                    });
                });

                document.addEventListener('DOMContentLoaded', function() {
                    // Inisialisasi AOS dengan konfigurasi yang diperbarui
                    AOS.init({
                        duration: 800,
                        once: true,
                        offset: 50,
                        easing: 'ease-out-cubic',
                        delay: 50
                    });
                });
            </script>
        </div>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.animate-fade-in {
    animation: fadeIn 0.8s ease-out forwards;
}

.group:hover img {
    transform: scale(1.1);
}

.group:hover .overlay {
    opacity: 1;
}

/* Smooth transitions */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi AOS dengan konfigurasi yang diperbarui
    AOS.init({
        duration: 800,
        once: true,
        offset: 50,
        easing: 'ease-out-cubic',
        delay: 50
    });

    // Rest of the JavaScript remains the same
});
</script>
@endsection
