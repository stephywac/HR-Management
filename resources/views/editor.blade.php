<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Online IDE</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset('assets/ide/css/style.css')}}" />
    <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.png')}}" />
</head>

<body>
    <div class="container">
        <div class="row">
        </div>
        <div align="left">
            <div class="control-panel">
                Select Language:
                &nbsp; &nbsp;
                <select id="languages" class="languages" onchange="changeLanguage()">
                    <option value="c"> C </option>
                    <option value="cpp"> C++ </option>
                    <option value="php"> PHP </option>
                    <option value="python"> Python </option>
                    <option value="node"> Node JS </option>
                </select>
            </div>
        </div>
        <div align="left">
            <div class="button-container">
                <button class="btn" onclick="executeCode()"> Run </button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

        </div>
        <div style="width: 50%; float:left">
            <div id="left">
                <div class="editor" id="editor"></div>
            </div>
        </div>

        <div style="width: 50%; float:right">
            <div id="left">
                <div class="output"></div>
            </div>
        </div>
    </div>



    <!-- <div class="editor" id="editor">

    </div> -->

    <!-- <div class="button-container">
        <button class="btn" onclick="executeCode()"> Run </button>
    </div> -->

    <!-- <div class="output"></div> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('assets/ide/js/lib/ace.js')}}"></script>
    <script src="{{asset('assets/ide/js/lib/theme-monokai.js')}}"></script>
    <script src="{{asset('assets/ide/js/ide.js')}}"></script>

</body>

</html>