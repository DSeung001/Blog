<x-mail::message>
# Introduction

{{$message}}

<x-mail::button :url="$url">
Home
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}

</x-mail::message>

