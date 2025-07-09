@extends('layouts.agence.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title') Messages @endsection

@section("content")
    <div class="container">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-header">
          <h2>Messages</h2>
        </div>
        <div class="tabs">
          <button class="tab-button active" data-filter="all">All</button>
          <button class="tab-button" data-filter="unread">Unread <span class="conversation-badge">{{ $unreadCount ?? 0 }}</span></button>
      </div>
        <div class="search-box">
          <input type="text" placeholder="Search conversations..." />
        </div>
        <div class="conversation-list">
          @foreach($messages as $userId => $conversation)
            @php $message = $conversation->first(); @endphp
            <div class="conversation {{ $loop->first ? 'active' : '' }} {{ $conversation->where('unread', true)->count() > 0 ? 'unread' : '' }}" data-user-id="{{ $userId }}">
              
              <div class="conversation-details">
                <h4>{{ $message->sender->name ?? 'Unknown User' }}</h4>
                <span>Interested in: {{ $message->property->title ?? 'Property' }}</span><br>
                <small>Sent to: {{ $message->agency->name ?? 'Our Agency' }}</small><br>
                <small>{{ Str::limit($message->content, 30) }}</small>
            </div>
              <div>
                <div class="conversation-time">{{ $message->created_at->format('h:i A') }}</div>
                @if($conversation->where('unread', true)->count() > 0)
                  <div class="conversation-badge">{{ $conversation->where('unread', true)->count() }}</div>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
    
      <!-- Chat -->
      <div class="chat">
        <div class="chat-header">
          <div class="chat-header-info">
            
            <div>
              <strong id="chat-user-name"></strong><br>
              <small id="chat-user-status"></small>
            </div>
          </div>
        </div>
    
        <div class="chat-body" id="message-container">
          <div class="no-message-selected">
            <p>Select a conversation to view messages</p>
          </div>
        </div>
    
        
      </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Load first conversation by default if exists
    @if(count($messages) > 0)
        loadFirstConversation();
    @endif

    // Click handler for conversations
    $(document).on('click', '.conversation', function() {
        $('.conversation').removeClass('active');
        $(this).addClass('active');
        const userId = $(this).data('userId');
        loadConversation(userId);
    });
    // Tab click handler
    $('.tab-button').click(function() {
        $('.tab-button').removeClass('active');
        $(this).addClass('active');
        const filter = $(this).data('filter');
        filterConversations(filter);
    });

    function loadFirstConversation() {
        const firstConversation = $('.conversation').first();
        if (firstConversation.length) {
            firstConversation.addClass('active');
            loadConversation(firstConversation.data('userId'));
        }
    }
    function filterConversations(filter) {
        $('.conversation').each(function() {
            const hasUnread = $(this).find('.conversation-badge').length > 0;
            
            if (filter === 'all') {
                $(this).show();
            } else if (filter === 'unread') {
                if (hasUnread) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            }
        });
    }

    function loadConversation(userId) {
    const agencyId = {{ Auth::guard('agency')->id() }};
    const url = `/dashboard/messages/conversation/${userId}?agency_id=${agencyId}`;
    
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response && response.messages) {
                updateChatUI(response);
            } else {
                showError('No messages found');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            let errorMsg = 'Error loading messages';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            showError(errorMsg);
        }
    });
}

    function updateChatUI(data) {
        let messagesHtml = '';
        
        if (data.messages.length > 0) {
            let currentDate = '';
            
            data.messages.forEach(message => {
                const messageDate = new Date(message.created_at).toLocaleDateString();
                if (messageDate !== currentDate) {
                    messagesHtml += `<div class="date-divider">${messageDate}</div>`;
                    currentDate = messageDate;
                }
                
                const isAgency = message.sender_id == {{ Auth::guard('agency')->id() }};
                messagesHtml += `
                    <div class="message ${isAgency ? 'sent' : 'received'}">
                        ${!isAgency ? `<img src="${data.user?.avatar || 'https://randomuser.me/api/portraits/lego/1.jpg'}" alt="">` : ''}
                        <div>
                            <div class="message-bubble">${message.content}</div>
                            <div class="message-time">
                                ${new Date(message.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})} 
                                ${isAgency ? '<i class="bx bx-check-double"></i>' : ''}
                            </div>
                        </div>
                    </div>
                `;
            });
        } else {
            messagesHtml = '<div class="no-messages">No messages in this conversation</div>';
        }
        
        // Update UI
        $('#chat-user-name').text(data.user?.name || 'Unknown User');
        $('#chat-user-status').text('Interested in: ' + (data.property?.title || 'Property'));
        $('#message-container').html(messagesHtml).scrollTop($('#message-container')[0].scrollHeight);
    }

    function showError(message) {
        $('#message-container').html(`<div class="error-message">${message}</div>`);
    }
});
</script>
@endpush