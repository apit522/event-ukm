<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tes</title>
    @livewireStyles
</head>

<body>

    <livewire:counter />
    <p>Versi Laravel saat ini: {{ app()->version() }}</p>

    @livewireScripts
</body>

</html>