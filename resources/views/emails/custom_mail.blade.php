<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<body>

<div style="margin: 1em; align-items: center;">
    {{html_entity_decode($body)}}
</div>

<div style="margin: 2em 1em; align-items: first; font-weight: bold">
    Sent with VanillaSoft!
</div>

</body>
</html>
