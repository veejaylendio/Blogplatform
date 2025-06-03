@extends('layouts.app')

@section('content')
    <style>
        * {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        }

        body {
            background-color: #f9f9f9;
            padding: 20px;
            margin: 0 auto;
        }
        .content-wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-container {
            margin: 0 auto;
            background-color: white;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            color: #333;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .required::after {
            content: "*";
            color: #e74c3c;
            margin-left: 4px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus {
            border-color: #0077cc;
            outline: none;
        }

        .select-wrapper {
            position: relative;
            width: 100%;
        }

        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            appearance: none;
            background-color: white;
            cursor: pointer;
        }

        .select-wrapper::after {
            content: "▼";
            font-size: 12px;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            pointer-events: none;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .checkbox-container input[type="checkbox"] {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-container label {
            display: inline;
            cursor: pointer;
        }

        .date-container {
            display: flex;
            gap: 12px;
        }

        .date-container .select-wrapper {
            flex: 1;
        }

        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            min-height: 120px;
            resize: vertical;
        }

        textarea:focus {
            border-color: #0077cc;
            outline: none;
        }
        input[type="checkbox"]:checked + .end-date-container .select-wrapper select {
            background-color: #f0f0f0;
            color: #888;
            cursor: not-allowed;
        }
        .date-preview {
            font-size: 14px;
            color: #666;
            margin-top: 8px;
            display: none;
        }

        input[type="checkbox"]:checked + .end-date-container + .date-preview {
            display: block;
        }
        .card-header {
            padding: var(--bs-card-cap-padding-y) var(--bs-card-cap-padding-x);
            margin-bottom: 0;
            color: var(--bs-card-cap-color);
            background-color: var(--bs-card-cap-bg);
            border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color);
        }
    </style>
    <div class="content-wrapper">
        <div class="form-container ">
            <div class="card">
                <div class="card-header">{{ __('Works Management') }}</div>
                <div class="card-body">
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
                    <form action="{{route('works.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="image" class="">File/Image Upload</label>
                            <input  name="works_image" type="file" id="image">
                        </div>
                        <div class="form-group">
                            <label for="title" class="required">Project Title</label>
                            <input name="works_title" type="text" id="title" placeholder="Ex: Fame" required>
                        </div>
                        <div class="form-group">
                            <label for="type" class="required">Project Type</label>
                            <input name="works_project_type" type="text" id="type" placeholder="Ex: Branding" required>
                        </div>
                        <div class="sm-form-group">
                            <label class="sm-label" for="urlInput">URL</label>
                            <input name="works_url" type="text" class="sm-input-text" id="urlInput" placeholder="Enter URL">
                        </div>
                        <!-- Description field (added as requested) -->
                        <div class="form-group">
                            <label class="required" for="description">Description</label>
                            <textarea name="works_description" id="description" placeholder="Describe your Movies..." required></textarea>
                        </div>
                        <div class="form-footer">
                            <a href="">
                                <button type="button" class="btn btn-secondary">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-primary" style="float: right;">Save Recent Works</button>
                        </div>
                    </form>
              </div>
        </div>
    </div>
@endsection
