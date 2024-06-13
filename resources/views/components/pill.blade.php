@props(['theme' => ''])

@if($theme === 'success')
    <span {{$attributes->merge(['class' => 'w-max border border-green-500 bg-green-100 text-green-500 rounded-full font-bold text-xs h-auto w-max px-2 py-1'])}} >{{$slot}}</span>
@elseif($theme === 'warning')
    <span {{$attributes->merge(['class' => 'w-max border border-yellow-500 bg-yellow-100 text-yellow-500 rounded-full font-bold text-xs h-auto w-max px-2 py-1'])}} >{{$slot}}</span>
@elseif($theme === 'danger')
    <span {{$attributes->merge(['class' => 'w-max border border-red-500 bg-red-100 text-red-500 rounded-full font-bold text-xs h-auto w-max px-2 py-1'])}} >{{$slot}}</span>
@else
    <span {{$attributes->merge(['class' => 'w-max border border-slate-500 bg-slate-100 text-slate-500 rounded-full font-bold text-xs h-auto w-max px-2 py-1'])}} >{{$slot}}</span>
@endif
