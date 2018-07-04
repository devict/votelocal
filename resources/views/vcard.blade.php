BEGIN:VCARD
VERSION:2.1
N:{{ implode(';', array_reverse(explode(' ', config('app.name'), 2))) }};;;
ORG:{{ config('app.name') }}
TEL:+1{{ env('TWILIO_FROM_NUMBER') }}
URL:{{ config('app.url') }}
END:VCARD
