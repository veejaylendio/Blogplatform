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
    <body>
    <div class="content-wrapper">
        <div class="form-container ">
            <div class="card">
                <div class="card-header">{{ __('Experience Management') }}</div>
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
                    <form action="{{route('experience.update', $experience->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                    <div class="form-group">
                        <label for="company" class="required">Company or organization</label>
                        <input  name="company_name" type="text" id="company" placeholder="Ex: Microsoft" required value="{{$experience->company_name}}">
                    </div>
                    <div class="form-group">
                        <label for="title" class="required">Title</label>
                        <input name="job_title" type="text" id="title" placeholder="Ex: Retail Sales Manager" value="{{$experience->job_title}}" required>
                    </div>
                    <div class="checkbox-container">
                        <input name="currently_working" type="checkbox" id="current-role" {{$experience->currently_working ? 'checked' : ''}}>
                        <label for="current-role">I am currently working in this role</label>
                    </div>
                        <div class="form-group">
                            <label for="start-month" class="required">Start date</label>
                            <div class="date-container">
                                <div class="select-wrapper">
                                    @php
                                        $startMonth = \Carbon\Carbon::make($experience->start_date)->month;
                                        $startYear = \Carbon\Carbon::make($experience->start_date)->year;
                                        $endMonth = $experience->end_date ? \Carbon\Carbon::make($experience->end_date)->month :'';
                                        $endYear = $experience->end_date ? \Carbon\Carbon::make($experience->end_date)->year :'';
                                    @endphp
                                    <select id="start-month" name="start_month">
                                        <option value="" disabled selected>Month</option>
                                        <option {{$startMonth == 1 ? 'selected' : ''}} value="1">January</option>
                                        <option {{$startMonth == 2 ? 'selected' : ''}} value="2">February</option>
                                        <option {{$startMonth == 3 ? 'selected' : ''}} value="3">March</option>
                                        <option {{$startMonth == 4 ? 'selected' : ''}} value="4">April</option>
                                        <option {{$startMonth == 5 ? 'selected' : ''}} value="5">May</option>
                                        <option {{$startMonth == 6 ? 'selected' : ''}} value="6">June</option>
                                        <option {{$startMonth == 7 ? 'selected' : ''}} value="7">July</option>
                                        <option {{$startMonth == 8 ? 'selected' : ''}} value="8">August</option>
                                        <option {{$startMonth == 9 ? 'selected' : ''}} value="9">September</option>
                                        <option {{$startMonth == 10 ? 'selected' : ''}} value="10">October</option>
                                        <option {{$startMonth == 11 ? 'selected' : ''}} value="11">November</option>
                                        <option {{$startMonth == 12 ? 'selected' : ''}} value="12">December</option>
                                    </select>
                                </div>
                                <div class="select-wrapper">
                                    <select id="start-year" name="start_year">
                                        <option value="" disabled selected>Year</option>
                                        <option {{$startYear == 2025 ? 'selected' : ''}} value="2025">2025</option>
                                        <option {{$startYear == 2024 ? 'selected' : ''}} value="2024">2024</option>
                                        <option {{$startYear == 2023 ? 'selected' : ''}} value="2023">2023</option>
                                        <option {{$startYear == 2022 ? 'selected' : ''}} value="2022">2022</option>
                                        <option {{$startYear == 2021 ? 'selected' : ''}} value="2021">2021</option>
                                        <option {{$startYear == 2020 ? 'selected' : ''}} value="2020">2020</option>
                                        <option {{$startYear == 2019 ? 'selected' : ''}} value="2019">2019</option>
                                        <option {{$startYear == 2018 ? 'selected' : ''}} value="2018">2018</option>
                                        <option {{$startYear == 2017 ? 'selected' : ''}} value="2017">2017</option>
                                        <option {{$startYear == 2016 ? 'selected' : ''}} value="2016">2016</option>
                                        <option {{$startYear == 2015 ? 'selected' : ''}} value="2015">2015</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="checkbox" id="current-role-hidden" style="display:none;" onchange="this.checked ? document.querySelectorAll('#end-month, #end-year').forEach(el => el.hidden = true) : document.querySelectorAll('#end-month, #end-year').forEach(el => el.hidden = false)" {{$experience->currently_working ? 'checked' : ''}}>
                        <div class="end-date-container">
                            <div class="form-group">
                                <label for="end-month" class="required">End date</label>
                                <div class="date-container">
                                    <div class="select-wrapper">
                                        <select id="end-month" name="end_month">
                                            <option value="" disabled selected>Month</option>
                                            <option {{$endMonth == 1 ? 'selected' : ''}} value="1">January</option>
                                            <option {{$endMonth == 2 ? 'selected' : ''}} value="2">February</option>
                                            <option {{$endMonth == 3 ? 'selected' : ''}} value="3">March</option>
                                            <option {{$endMonth == 4 ? 'selected' : ''}} value="4">April</option>
                                            <option {{$endMonth == 5 ? 'selected' : ''}} value="5">May</option>
                                            <option {{$endMonth == 6 ? 'selected' : ''}} value="6">June</option>
                                            <option {{$endMonth == 7 ? 'selected' : ''}} value="7">July</option>
                                            <option {{$endMonth == 8 ? 'selected' : ''}} value="8">August</option>
                                            <option {{$endMonth == 9 ? 'selected' : ''}} value="9">September</option>
                                            <option {{$endMonth == 10 ? 'selected' : ''}} value="10">October</option>
                                            <option {{$endMonth == 11 ? 'selected' : ''}} value="11">November</option>
                                            <option {{$endMonth == 12 ? 'selected' : ''}} value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="select-wrapper">
                                        <select id="end-year" name="end_year">
                                            <option value="" disabled selected>Year</option>
                                            <option {{$endYear == 2025 ? 'selected' : ''}} value="2025">2025</option>
                                            <option {{$endYear == 2024 ? 'selected' : ''}} value="2024">2024</option>
                                            <option {{$endYear == 2023 ? 'selected' : ''}} value="2023">2023</option>
                                            <option {{$endYear == 2022 ? 'selected' : ''}} value="2022">2022</option>
                                            <option {{$endYear == 2021 ? 'selected' : ''}} value="2021">2021</option>
                                            <option {{$endYear == 2020 ? 'selected' : ''}} value="2020">2020</option>
                                            <option {{$endYear == 2019 ? 'selected' : ''}} value="2019">2019</option>
                                            <option {{$endYear == 2018 ? 'selected' : ''}} value="2018">2018</option>
                                            <option {{$endYear == 2017 ? 'selected' : ''}} value="2017">2017</option>
                                            <option {{$endYear == 2016 ? 'selected' : ''}} value="2016">2016</option>
                                            <option {{$endYear == 2015 ? 'selected' : ''}} value="2015">2015</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="date-preview" id="date-preview">
                            <span id="preview-text"></span>
                        </div>

                        <!-- Description field (added as requested) -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" placeholder="Describe your responsibilities and achievements...">{{$experience->description}}</textarea>
                        </div>
                        <div class="form-footer">
                            <a href="{{route('experience.index')}}">
                                <button type="button" class="btn btn-secondary">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-primary" style="float: right;">Save Experience</button>
                        </div>
                    </form>
              </div>
            </div>
        </div>
    </div>
    <script>
        // Pure CSS solution to sync the visible and hidden checkboxes
        document.getElementById('current-role').addEventListener('change', function() {
            document.getElementById('current-role-hidden').checked = this.checked;

            // This updates the preview text for "Start Date - Present"
            const startMonth = document.getElementById('start-month');
            const startYear = document.getElementById('start-year');
            const previewText = document.getElementById('preview-text');

            if (this.checked && startMonth.value && startYear.value) {
                const monthName = startMonth.options[startMonth.selectedIndex].text;
                previewText.textContent = monthName + " " + startYear.value + " – Present";
            }
        });
        // Update preview when start date changes
        document.getElementById('start-month').addEventListener('change', updatePreview);
        document.getElementById('start-year').addEventListener('change', updatePreview);

        function updatePreview() {
            if (document.getElementById('current-role').checked) {
                const startMonth = document.getElementById('start-month');
                const startYear = document.getElementById('start-year');
                const previewText = document.getElementById('preview-text');

                if (startMonth.value && startYear.value) {
                    const monthName = startMonth.options[startMonth.selectedIndex].text;
                    previewText.textContent = monthName + " " + startYear.value + " – Present";
                }
            }

        }
    </script>
@endsection
