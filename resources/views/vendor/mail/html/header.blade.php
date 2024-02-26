@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'NEAC Medical Exams Center')
<a href="https://medexamcenter.com/"><img src="https://admin.medicalexamcenter.com/storage/photos/logo.png" class="logo" alt="NEAC Logo" style="width:150px; height:50px;"></a> 
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
