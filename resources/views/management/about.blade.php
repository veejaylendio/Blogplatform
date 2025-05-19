@extends('layouts.app')

@section('content')

    <style>
        /* Main container styles */
        .img-uploader-container {
            font-family: Arial, sans-serif;
            width: 100%;
            /*max-width: 800px;*/
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .img-uploader-wrapper {
            background-color: white;
            border-radius: 8px;
            padding: 100px;
            padding-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .img-uploader-title {
            color: #333;
            text-align: center;
        }

        /* Form layout styles */
        .img-uploader-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .img-uploader-form {
                flex-direction: row;
                justify-content: center;
                align-items: flex-start;
            }
        }

        .img-uploader-controls {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Button styles */
        .img-uploader-btn {
            background-color: #4285f4;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            text-align: center;
            display: inline-block;
        }

        .img-uploader-btn:hover,
        .img-uploader-btn:focus {
            background-color: #3367d6;
        }

        /* Hide the actual file input but keep it accessible */
        #img-uploader-input {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        .image-preview {
            width: 100%;
            height: auto;
            display: none;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }

        /* Additional note */
        .img-uploader-note {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
            text-align: center;
        }

        /* Preview area */
        .img-uploader-preview {
            width: 300px;
            height: 300px;
            border: 2px dashed #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .img-uploader-placeholder {
            color: #999;
            font-size: 14px;
            text-align: center;
            padding: 20px;
        }

        /* Using pure CSS to highlight the preview area on focus */
        input[type="file"]:focus + .img-uploader-preview {
            border-color: #4285f4;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>
                                        {{$error}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-header">{{ __('About Management') }}</div>
                        <div class="img-uploader-container">
                            <div class="img-uploader-wrapper text-center">
                                <h1 class="img-uploader-note">Image Upload with Preview</h1>

                                    <form action="{{ $about ? route('about.update') : route('about.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group flex">
                                            <div class="preview-container">
                                                <img width="200" id="image-preview" class="img-fluid img-thumbnail" src="{{asset($about?->image)}}" alt="Image Preview">
                                            </div>
                                            <div>
                                                <label for="image">Image Upload</label>
                                                <input class="form-control" type="file" id="image" name="image" accept="image/*">
                                            </div>
                                            <div class="error" id="image-error"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cv">File Upload</label>
                                            <input class="form-control" type="file" accept="application/pdf" id="cv" name="cv">
                                            <div class="file-info" id="file-info"></div>
                                            <div class="error" id="file-error"></div>
                                        </div>

                                        <div class="form-floating mt-3">
                                            <textarea style="height: 150px;" class="form-control" id="about" name="about" placeholder="Enter your description here...">{{$about?->about}}</textarea>
                                            <label for="about">About</label>
                                            <div class="error" id="about-error"></div>
                                        </div>
                                        @if($about)
                                            <button class="btn btn-info mt-2" type="submit">Update</button>
                                        @else
                                            <button class="btn btn-success mt-2" type="submit">Create</button>
                                        @endif

                                    </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const imagePreview = $('#image-preview');
        // imagePreview.hide();
        // Image preview functionality
        $('#image').change(function() {
            const file = this.files[0];
            const errorElement = $('#image-error');

            // Reset previous
            imagePreview.hide();
            errorElement.text('');

            if (file) {
                // Validate if it's an image
                if (file.type.match('image.*')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        imagePreview.attr('src', e.target.result);
                        imagePreview.show();
                    }

                    reader.readAsDataURL(file);
                } else {
                    errorElement.text('Please select a valid image file.');
                }
            }
        });

        // File upload info
        $('#cv').change(function() {
            const file = this.files[0];
            const fileInfo = $('#file-info');
            const errorElement = $('#file-error');

            // Reset previous
            fileInfo.hide();
            errorElement.text('');

            if (file) {
                // Display file information
                const fileSizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                fileInfo.text(`Selected file: ${file.name} (${fileSizeInMB} MB)`);
                fileInfo.show();

                // Optional: Validate file size
                if (file.size > 10 * 1024 * 1024) { // 10MB limit
                    errorElement.text('File size should not exceed 10MB.');
                }
            }
        });

        // Form validation before submit
        $('form').submit(function(event) {
            let hasError = false;

            // Validate description
            if ($('#about').val().trim() === '') {
                $('#about-error').text('About is required.');
                hasError = true;
            } else {
                $('#about-error').text('');
            }

            if (hasError) {
                event.preventDefault();
            }
        });
    </script>
@endpush
