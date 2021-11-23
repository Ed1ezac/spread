@component('mail::message')
#Hello {{ $username }}

This is to inform you that the active rollout of one of your SMS'es has {{ $action }}. 
You can view the rollout {{ $status }} on your Spread application dashboard under the 
statistics section. The SMS being referred to is shown below for your reference.

@component('mail::panel')
##Recipients: {{ $recipientsListName.' - '.$entries.' recipients' }}
*{{ $text }}*
@endcomponent

Regards,<br>
The Spread Team.
@endcomponent

@endcomponent