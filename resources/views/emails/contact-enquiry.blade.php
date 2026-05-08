<x-mail::message>
    # New Contact Enquiry

    You have received a new enquiry from the website contact form.

    ---

    **Name:** {{ $data['name'] }}

    **Email:** {{ $data['email'] }}

    **Phone:** {{ $data['phone'] ?? 'N/A' }}

    **Subject:** {{ $data['subject'] ?? 'N/A' }}

    **Message:**

    {{ $data['message'] }}

    ---

    <x-mail::button :url="'mailto:' . $data['email']">
        Reply to {{ $data['name'] }}
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
