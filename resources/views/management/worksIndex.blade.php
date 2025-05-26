@extends('layouts.app')

@section('content')
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f7f8fc;
            padding: 20px;
        }

        .container {
            max-width: 1000%;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .table-header {
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h1 {
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }

        .btn {
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            margin-right: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #4CAF50; /* Green - Add button */
            color: white;
        }

        .btn-primary:hover {
            opacity: 0.8;
        }

        .btn-danger {
            background-color: #f44336; /* Red - Delete button */
            color: white;
        }

        .btn-danger:hover {
            opacity: 0.8;
        }

        .btn-edit {
            background-color: #2196F3; /* Blue - Edit button */
            color: white;
        }

        .btn-edit:hover {
            opacity: 0.8;
        }

        /* Table styles */
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            margin-bottom: 20px;
        }

        .table th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
            padding: 12px;
            border: 1px solid #ddd;
        }

        .table td {
            padding: 12px;
            border: 1px solid #ddd;
            color: #424242;
        }

        .table tr:hover {
            background-color: #f5f5f5;
        }

        .table-actions {
            white-space: nowrap;
            display: flex;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-success {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .badge-warning {
            background-color: #fff8e1;
            color: #ff8f00;
        }

        .badge-info {
            background-color: #e3f2fd;
            color: #1565c0;
        }

        .description-cell {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sm-no-data {
            text-align: center;
            font-style: italic;
            color: #757575;
            padding: 15px;
        }


        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }

            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .table th,
            .table td {
                padding: 10px;
            }

            .btn {
                font-size: 12px;
                padding: 6px 10px;
                margin-bottom: 5px;
            }
        }
    </style>
    <div class="container">
        <div class="table-header">
            <h1>Recent Works Records</h1>
            <a href="{{route('experience.create')}}" class="btn btn-primary">Add New Experience</a>
        </div>
{{--        @if($errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach($errors->all() as $error)--}}
{{--                        <li>--}}
{{--                            {{$error}}--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        @if(session('success'))--}}
{{--            <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                {{session('success')}}--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--            </div>--}}
{{--        @endif--}}
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Project Title</th>
                    <th>Project Type </th>
                    <th>URL</th>
{{--                    <th>Description</th>--}}
                    <th width="100">Actions</th>
                </tr>
                </thead>
                <tbody>
{{--                    <tr>--}}
{{--                        <td>{{$experience->company_name}}</td>--}}
{{--                        <td>{{$experience->job_title}}</td>--}}
{{--                        <td>{{\Carbon\Carbon::make($experience->start_date)->format('F Y') . ' - ' . ($experience->currently_working != 1  ? \Carbon\Carbon::make($experience->end_date)->format('F Y') : 'Present')}}</td>--}}
{{--                        <td class="description-cell">{{$experience->description}}</td>--}}
{{--                        <td class="table-actions">--}}
{{--                            <a href="{{route('experience.edit', $experience->id)}}" class="btn btn-edit">Edit</a>--}}
{{--                            <form action="{{route('experience.destroy', $experience->id)}}" method="POST" onsubmit="return confirm('Are you sure to delete this?')">--}}
{{--                                @method('delete')--}}
{{--                                @csrf--}}
{{--                                <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    <tr>
                        <td colspan="6">
                            <div class="sm-no-data">
                                No recent works records added yet. Use the form to add your experience details.
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
