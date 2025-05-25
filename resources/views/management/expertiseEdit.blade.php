@extends('layouts.app')

@section('content')
    <style>
        .sm-manager-body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .sm-platform-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .sm-platform-table th,
        .sm-platform-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .sm-platform-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .sm-platform-table tr:hover {
            background-color: #f5f5f5;
        }

        .sm-form-group {
            margin-bottom: 15px;
        }

        .sm-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .sm-input-text {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .sm-button {
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            margin-right: 5px;
        }

        .sm-add-btn {
            background-color: #4CAF50;
        }

        .sm-edit-btn {
            background-color: #2196F3;
        }

        .sm-delete-btn {
            background-color: #f44336;
        }

        .sm-save-btn {
            background-color: #4267B2;
        }

        .sm-cancel-btn {
            background-color: #9e9e9e;
        }

        .sm-button:hover {
            opacity: 0.8;
        }

        .sm-action-cell {
            white-space: nowrap;
        }

        .sm-message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            display: none;
        }

        .sm-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .sm-error {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .sm-form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
        }

        .sm-button-container {
            margin-top: 15px;
        }

        .sm-no-data {
            text-align: center;
            font-style: italic;
            color: #757575;
            padding: 15px;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Expertise Management') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="sm-manager-body">
                            <form action="{{ route('expertise.update', $expertise->id) }}" method="POST">
                                @csrf
                                <div class="sm-form-container">
                                    <h2 id="form-title">Edit Expertise</h2>

                                    <div class="sm-form-group">
                                        <label class="sm-label" for="expertiseInput">Update Expertise:</label>
                                        <input name="expertise" type="text" class="sm-input-text" id="expertiseInput" placeholder="Enter Expertise" value="{{$expertise->expertise}}" required>
                                    </div>

                                    <div class="sm-button-container">
                                        <button id="saveButton" class="sm-button sm-save-btn">Save</button>
                                        <a href="{{route('expertise.index')}}">
                                            <button id="cancelButton" class="sm-button sm-cancel-btn">Cancel</button>
                                        </a>
                                    </div>
                                    <p id="messageBox" class="sm-message"></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
