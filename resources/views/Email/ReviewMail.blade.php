@component('mail::message')
# Review Submitted successfully

Your review for book {{$book_title}} has been submitted successfully. Here is your review.<br>

{{$review}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
