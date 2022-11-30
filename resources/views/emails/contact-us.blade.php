<x-mail::message>
   # Order Shipped

   {{ $mailData['message'] }}

   Thanks,<br>
   {{ $mailData['name'] }}
</x-mail::message>
