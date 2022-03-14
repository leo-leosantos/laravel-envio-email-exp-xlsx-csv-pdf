<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Controle de tarefas')
<img src="http://localhost/app_controle_tarefas/public/img/logo.jpg" class="logo" alt="Controle de tarefas">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
