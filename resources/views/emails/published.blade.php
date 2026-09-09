{{-- resources/views/emails/published.blade.php --}}
<x-mail::message>
# Nytt inlägg på bloggen!

Hej! Vi har precis publicerat ett nytt inlägg som vi tror att du vill läsa: **{{ $post->title }}**

<x-mail::button :url="route('show', $post->id)">
Läs hela inlägget här
</x-mail::button>

Tack för att du prenumererar,<br>
{{ config('app.name') }}
</x-mail::message>
