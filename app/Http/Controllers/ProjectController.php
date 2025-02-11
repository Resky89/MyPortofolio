<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    private $baseUrl = 'https://portofolio-api-five.vercel.app/api';

    public function index()
    {
        try {
            $response = Http::get($this->baseUrl . '/projects');

            // Debug response
            Log::info('Raw API Response:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            // Ensure we always have an array, even if empty
            $projects = $response->json() ?? [];

            // Debug parsed data
            Log::info('Parsed Projects:', ['projects' => $projects]);

            return view('projects', ['projects' => $projects]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch projects: ' . $e->getMessage());
            // Return empty array if request fails
            return view('projects', ['projects' => [], 'error' => 'Failed to fetch projects']);
        }
    }

    public function show($id)
    {
        try {
            $response = Http::get($this->baseUrl . '/projects/' . $id);
            $project = $response->json();
            return view('project-detail', compact('project'));
        } catch (\Exception $e) {
            return redirect()->route('projects')->with('error', 'Project not found');
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'title' => 'required|min:3',
                'description' => 'required|min:10',
                'technologies' => 'required',
                'link' => 'required|url',
                'demo_image' => 'required|file|mimes:jpeg,png,jpg'
            ], [
                'description.min' => 'Description must be at least 10 characters long',
                'link.url' => 'Please enter a valid URL'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Log request body
            $demoImageFileName = $request->hasFile('demo_image') ? $request->file('demo_image')->getClientOriginalName() : null;
            Log::info('Request body:', [
                'title' => $request->title,
                'description' => $request->description,
                'technologies' => $request->technologies,
                'link' => $request->link,
                'demo_image' => $demoImageFileName
            ]);

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                // Convert technologies to an array
                'technologies' => explode(',', $request->technologies), // Ensure this is an array
                'link' => $request->link,
            ];

            // Handle file upload directly
            if ($request->hasFile('demo_image')) {
                $file = $request->file('demo_image');

                // Create multipart form data
                $formData = [
                    'multipart' => [
                        [
                            'name' => 'demo_image',
                            'contents' => fopen($file->getPathname(), 'r'),
                            'filename' => $file->getClientOriginalName()
                        ]
                    ]
                ];

                // Add other fields
                foreach ($data as $key => $value) {
                    if ($key === 'technologies') {
                        // Add each technology as a separate field
                        foreach ($value as $tech) {
                            $formData['multipart'][] = [
                                'name' => 'technologies[]', // Use array notation
                                'contents' => $tech
                            ];
                        }
                    } else {
                        $formData['multipart'][] = [
                            'name' => $key,
                            'contents' => $value
                        ];
                    }
                }

                // Send to Express API
                $response = Http::send('POST', $this->baseUrl . '/projects', $formData);

                // Log server response
                Log::info('Server response:', [
                    'status' => $response->status(),
                    'body' => $response->json() // Log the response body
                ]);

                return response()->json([
                    'success' => $response->successful(),
                    'data' => $response->json(),
                    'status' => $response->status()
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Store error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Get existing project data first
            $existingProject = Http::get($this->baseUrl . '/projects/' . $id)->json();

            // Prepare multipart form data
            $formData = [
                'multipart' => []
            ];

            // Handle image
            if ($request->hasFile('demo_image')) {
                $formData['multipart'][] = [
                    'name' => 'demo_image',
                    'contents' => fopen($request->file('demo_image')->getPathname(), 'r'),
                    'filename' => $request->file('demo_image')->getClientOriginalName()
                ];
            } elseif ($request->has('demo_image')) {
                // If demo_image is string (existing image path)
                $formData['multipart'][] = [
                    'name' => 'demo_image',
                    'contents' => $request->demo_image
                ];
            }

            // Add other fields
            $fields = [
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link
            ];

            foreach ($fields as $key => $value) {
                $formData['multipart'][] = [
                    'name' => $key,
                    'contents' => $value
                ];
            }

            // Handle technologies array
            $technologies = explode(',', $request->technologies);
            foreach ($technologies as $tech) {
                $formData['multipart'][] = [
                    'name' => 'technologies[]',
                    'contents' => trim($tech)
                ];
            }

            // Log request data for debugging
            Log::info('Update request data:', [
                'formData' => $formData,
                'hasFile' => $request->hasFile('demo_image'),
                'demo_image' => $request->demo_image
            ]);

            // Send request
            $response = Http::send('PUT', $this->baseUrl . '/projects/' . $id, $formData);

            // Log response for debugging
            Log::info('Update response:', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            return response()->json([
                'success' => $response->successful(),
                'data' => $response->json()
            ]);

        } catch (\Exception $e) {
            Log::error('Update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->baseUrl . '/projects/' . $id);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function testConnection()
    {
        try {
            $response = Http::get($this->baseUrl . '/projects');
            return response()->json([
                'status' => $response->status(),
                'data' => $response->json()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getProjectCount()
    {
        try {
            $response = Http::get($this->baseUrl . '/projects');
            $projects = $response->json() ?? [];
            return count($projects);
        } catch (\Exception $e) {
            Log::error('Failed to fetch project count: ' . $e->getMessage());
            return 0;
        }
    }
}

