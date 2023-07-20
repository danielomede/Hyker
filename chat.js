$(document).ready(function() {
  // Retrieve and display chat messages on page load
  get_messages();

  // Insert a new message when the form is submitted
      $('#chat_form').submit(function(event) {
    event.preventDefault();
    var name    = $('#name').val();
    var message = $('#message').val();
    var chatid  = $('#chatid').val();
    
    insert_message(name, message, chatid);
    
  });
});

function insert_message(name, message, chatid) {
  $.ajax({
    type: 'POST',
    url: 'insert_message.php', // <-- Replace with the correct URL
    data: { name: name, message: message, chatid: chatid },
    success: function(data) {
        console.log(data);
      // Clear the input field after a message is sent
      $('#message').val('');
      // Retrieve and display chat messages after a message is sent
      get_messages();
      
    },
    error: function(xhr, status, error) {
      console.log(xhr.responseText); // add this line to check for any error messages
    }
  });
}

function get_messages() {
  $.ajax({
    type: 'GET',  
    url: 'chat.php',
    success: function(data) {
        console.log(data);
      var messages = JSON.parse(data);
      var html = '';
      for (var i = 0; i < messages.length; i++) {
        var message = messages[i];
        html += '<div class="message">';
        html += '<span class="name">' + message.name + '</span>';
        html += '<span class="time">' + message.timestamp + '</span>';
        html += '<div class="text">' + message.message + '</div>';
        html += '</div>';
      }
      $('#chat').html(html);
      
    // Scroll to the bottom of the chat container if requested
      if (scrollToBottom) {
        var chatContainer = document.getElementById('chat');
        var lastMessage = chatContainer.lastElementChild;
        if (lastMessage) {
          lastMessage.scrollIntoView();
        }
      }

    }
  });
}


/* Version 2
$(document).ready(function() {
  // Retrieve and display chat messages on page load
  get_messages();

  // Insert a new message when the form is submitted
  $('#chat_form').submit(function(event) {
    event.preventDefault();
    var name = $('#name').val();
    var message = $('#message').val();
    var chatid = $('#chatid').val();
    insert_message(name, message, chatid);
  });
});

function insert_message(name, message, chatid) {
  $.ajax({
    type: 'POST',
    url: 'insert_message.php',
    data: {
      'name': name,
      'message': message,
      'chatid': chatid
    },
    success: function(data) {
      get_messages();
      console.log(data);
      $('#message').val('');
    }
  });
}

function get_messages() {
  $.ajax({
    type: 'POST',
    url: 'chat.php',
    success: function(data) {
    console.log(data);    
      data = JSON.parse(data);
      $('#chat').html('');
      for (var i = 0; i < data.length; i++) {
        var message = '<div class="message"><span class="name">' + data[i]['name'] + ':</span> ' + data[i]['message'] + '</div>';
        $('#chat').append(message);
      }
    }
  });
}
Version 2 */ 



/*
$(document).ready(function() {
	// Retrieve the chat messages and display them
	$.ajax({
		type: 'POST',
		url: 'chat.php',
		success: function(data) {
			data = JSON.parse(data);
			for (var i = 0; i < data.length; i++) {
				var message = '<div class="message"><span class="name">' + data[i]['name'] + ':</span> ' + data[i]['message'] + '</div>';
				$('#chat').append(message);
			}
		}
	});

	// Insert a new chat message
	$('#chat_form').submit(function(event) {
		event.preventDefault();

		var name = $('#name').val();
		var message = $('#message').val();

		if (name == '' || message == '') {
			alert('Please enter your name and message.');
			return;
		}

		$.ajax({
			type: 'POST',
			url: 'insert_message.php',
			data: {
				'name': name,
				'message': message
			},
			success: function(data) {
				var message = '<div class="message"><span class="name">' + name + ':</span> ' + message + '</div>';
				$('#chat').append(message);
				$('#message').val('');
			}
		});
	});
});


function insert_message(name, message) {
  $.ajax({
    type: 'POST',
    url: 'insert_message.php',
    data: {
      'name': name,
      'message': message
    },
    success: function(data) {
      get_messages();
      $('#message').val('');
    }
  });
}


function get_messages() {
  $.ajax({
    type: 'POST',
    url: 'chat.php',
    success: function(data) {
      data = JSON.parse(data);
      $('#chat').html('');
      for (var i = 0; i < data.length; i++) {
        var message = '<div class="message"><span class="name">' + data[i]['name'] + ':</span> ' + data[i]['message'] + '</div>';
        $('#chat').append(message);
      }
    }
  });
}


$(document).ready(function() {
  // Retrieve and display chat messages on page load
  get_messages();

  // Insert a new message when the form is submitted
  $('#chat_form').submit(function(event) {
    event.preventDefault();
    var name = $('#name').val();
    var message = $('#message').val();
    insert_message(name, message);
  });
});
*/
