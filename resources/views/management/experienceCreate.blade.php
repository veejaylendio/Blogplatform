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
                    <form action="{{route('experience.store')}}" method="POST">
                        @csrf
                    <div class="form-group">
                        <label for="company" class="required">Company or organization</label>
                        <input  name="company_name" type="text" id="company" placeholder="Ex: Microsoft" required>
                    </div>
                    <div class="form-group">
                        <label for="title" class="required">Title</label>
                        <input name="job_title" type="text" id="title" placeholder="Ex: Retail Sales Manager" required>
                    </div>
                    <div class="checkbox-container">
                        <input name="currently_working" type="checkbox" id="current-role">
                        <label for="current-role">I am currently working in this role</label>
                    </div>
                        <div class="form-group">
                            <label for="start-month" class="required">Start date</label>
                            <div class="date-container">
                                <div class="select-wrapper">
                                    <select id="start-month" name="start_month" required>
                                        <option value="" disabled selected>Month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="select-wrapper">
                                    <select id="start-year" name="start_year" required>
                                        <option value="" disabled selected>Year</option>
                                        <option value="2025">2025</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                        <option value="2019">2019</option>
                                        <option value="2018">2018</option>
                                        <option value="2017">2017</option>
                                        <option value="2016">2016</option>
                                        <option value="2015">2015</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="checkbox" id="current-role-hidden" style="display:none;" onchange="this.checked ? document.querySelectorAll('#end-month, #end-year').forEach(el => el.hidden = true) : document.querySelectorAll('#end-month, #end-year').forEach(el => el.hidden = false)">

                        <div class="end-date-container">
                            <div class="form-group">
                                <label for="end-month">End date</label>
                                <div class="date-container">
                                    <div class="select-wrapper">
                                        <select id="end-month" name="end_month">
                                            <option value="" disabled selected>Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="select-wrapper">
                                        <select id="end-year" name="end_year">
                                            <option value="" disabled selected>Year</option>
                                            <option value="2025">2025</option>
                                            <option value="2024">2024</option>
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
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
                            <label class="required" for="description">Description</label>
                            <textarea name="description" id="description" placeholder="Describe your responsibilities and achievements..." required></textarea>
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
