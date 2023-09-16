@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ $message }}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="alert alert-warning" role="alert">
    <i class="bi bi-exclamation-triangle-fill h4"></i><strong> Verify Your Email Address </strong>

    Before proceeding, please check your email for a verification link. If you did not receive the email,
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click here to request
            another</button>.
    </form>
</div>
