Hi {{ ucwords($first_name) }} {{ ucwords($last_name) }},
<p>Your registration is completed. Please click the link to get access.</p>
{{ route('confirmation', $token) }}
