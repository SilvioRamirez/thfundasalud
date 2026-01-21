@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('storage/img/fundasalud.png') }}" class="logo" alt="FUNDASALUD Trujillo">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
