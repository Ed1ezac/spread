@component('mail::message')
# Payment Success!

Your payment was processed successfully.
Payment for:<br>
**Bulk SMS bundle**

@component('mail::panel')
@component('mail::table')
| Quantity           | Unit Price       | Total               |
| :------------------|:----------------:| -------------------:|
| {{$funds}} SMS     | BWP 0.20 / SMS   | BWP **{{$cost}}**   |

@endcomponent
@endcomponent

User: {{ $username }}<br>
Date: {{ $pdate}}<br>
Time: {{ $ptime}}<br>


Thank you,<br>
{{ config('app.name') }}
@endcomponent
