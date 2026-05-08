<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.ts'])
        <x-inertia::head />
    </head>
    <body class="bg-base-300">
        <div class="p-8">
            <x-inertia::app />
        </div>
    </body>
</html>
