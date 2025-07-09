@extends('layouts.user_type.auth')

@section('title', 'Message Management')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Message Management</h6>
                            <p class="text-sm mb-0">
                                View and manage all contact messages from users
                            </p>
                        </div>
                        <a href="{{ route('message.management') }}" class="btn btn-sm btn-primary">Refresh</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Message</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($messages as $message)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $message->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $message->email }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-primary">{{ $message->subject }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ Str::limit($message->message, 30) }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm {{ $message->is_read ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                            {{ $message->is_read ? 'Read' : 'Unread' }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                       <a href="#viewMessageModal" 
   class="text-secondary font-weight-bold text-xs view-message" 
   data-bs-toggle="modal"
   data-message-id="{{ $message->id }}"
   data-message-name="{{ $message->name }}"
   data-message-email="{{ $message->email }}"
   data-message-subject="{{ $message->subject }}"
   data-message-content="{{ $message->message }}"
   data-message-date="{{ $message->created_at->format('d F Y \a\t H:i') }}"
   title="View message">
    View
</a>
                                        {{-- <form action="{{ route('messages.destroy', $message->id) }}" method="POST" class="d-inline"> --}}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger font-weight-bold text-xs ms-2 border-0 bg-transparent" title="Delete message">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-envelope-open-text fa-3x text-secondary mb-3"></i>
                                        <h5 class="text-secondary">No messages yet</h5>
                                        <p class="text-muted">When users contact you, their messages will appear here.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Message View Modal -->
<div class="modal fade" id="viewMessageModal" tabindex="-1" role="dialog" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewMessageModalLabel">Message Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6>From:</h6>
                    <p id="message-sender" class="text-muted"></p>
                </div>
                <div class="mb-3">
                    <h6>Subject:</h6>
                    <p id="message-subject" class="text-muted"></p>
                </div>
                <div class="mb-3">
                    <h6>Date:</h6>
                    <p id="message-date" class="text-muted"></p>
                </div>
                <div>
                    <h6>Message:</h6>
                    <p id="message-content" class="text-muted"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" id="reply-btn" class="btn btn-primary">Reply</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Initialize tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    // View message functionality
    $(document).on('click', '.view-message', function() {
    const name = $(this).data('message-name');
    const email = $(this).data('message-email');
    const subject = $(this).data('message-subject');
    const content = $(this).data('message-content');
    const date = $(this).data('message-date');
    const messageId = $(this).data('message-id');
    
    // Populate modal fields
    $('#message-sender').html(`${name} &lt;${email}&gt;`);
    $('#message-subject').text(subject);
    $('#message-content').text(content);
    $('#message-date').text(date);
    $('#reply-btn').attr('href', `mailto:${email}?subject=Re: ${subject}`);
    
    // Initialize the modal
    var modal = new bootstrap.Modal(document.getElementById('viewMessageModal'));
    modal.show();

    // Mark as read (AJAX call)
    $.ajax({
        url: `/messages/${messageId}/mark-as-read`,
        method: 'PATCH',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function() {
            // Update status badge
            $(`.view-message[data-message-id="${messageId}"]`)
                .closest('tr')
                .find('.badge')
                .removeClass('bg-gradient-secondary')
                .addClass('bg-gradient-success')
                .text('Read');
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-message').forEach(function (button) {
        button.addEventListener('click', function () {
            const name = this.dataset.messageName;
            const email = this.dataset.messageEmail;
            const subject = this.dataset.messageSubject;
            const content = this.dataset.messageContent;
            const date = this.dataset.messageDate;
            const messageId = this.dataset.messageId;

            // Fill modal
            document.getElementById('message-sender').textContent = `${name} <${email}>`;
            document.getElementById('message-subject').textContent = subject;
            document.getElementById('message-content').textContent = content;
            document.getElementById('message-date').textContent = date;
            document.getElementById('reply-btn').href = `mailto:${email}?subject=Re: ${subject}`;

            // Optional: mark as read visually
            const badge = this.closest('tr').querySelector('.badge');
            badge.classList.remove('bg-gradient-secondary');
            badge.classList.add('bg-gradient-success');
            badge.textContent = 'Read';

            // Optional: AJAX to mark as read
            fetch(`/messages/${messageId}/mark-as-read`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({})
            });
        });
    });
});

</script>
@endsection