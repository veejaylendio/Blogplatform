@extends('layouts.app')

@section('content')
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f7f8fc;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .form-header {
            margin-bottom: 25px;
            text-align: center;
        }

        .form-header h1 {
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #424242;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 16px;
            transition: border 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #4a6fdc;
            box-shadow: 0 0 0 3px rgba(74, 111, 220, 0.15);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .required::after {
            content: "*";
            color: #e53935;
            margin-left: 3px;
        }

        .form-footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #4a6fdc;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3d5fc7;
        }

        .btn-secondary {
            background-color: #e0e0e0;
            color: #424242;
        }

        .btn-secondary:hover {
            background-color: #d2d2d2;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .form-footer {
                flex-direction: column-reverse;
                gap: 15px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-15">
                <div class="card">
                    <div class="card-header">{{ __('Education Management') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="educationForm" method="POST" action="{{route("education.store")}}">
                            @csrf
                            <div class="form-group">
                                <label for="institution_name" class="form-label required">Institution Name</label>
                                <input type="text" class="form-control" id="institution_name" name="institution_name" placeholder="Enter institution name">
                            </div>

                            <div class="form-group">
                                <label for="degree_name" class="form-label required">Degree Name</label>
                                <input type="text" class="form-control" id="degree_name" name="degree_name" placeholder="Enter degree name">
                            </div>

                            <div class="form-group">
                                <label for="date" class="form-label">Completion Date</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Describe your education experience, achievements, etc."></textarea>
                            </div>

                            <div class="form-footer">
                                <a href="{{route('education.index')}}">
                                <button type="button" class="btn btn-secondary">Cancel</button>
                                </a>
                                <button type="submit" class="btn btn-primary">Save Education</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
