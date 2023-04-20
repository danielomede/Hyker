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
