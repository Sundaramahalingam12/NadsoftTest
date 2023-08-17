<!DOCTYPE html>
<html>

<head>
    <title>Members Tree</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        .error {
            color: red;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.modal').modal();

            function ParentMembers() {
                $.ajax({
                    url: 'get_parent_members.php',
                    method: 'GET',
                    success: function(data) {
                        $('#parentDropdown').html(data);
                    }
                });
            }
            ParentMembers();

            function loadMembers() {
                $.ajax({
                    url: 'get_members.php',
                    method: 'GET',
                    success: function(data) {
                        $('#members').html(data);
                    }
                });
            }

            loadMembers();

            $(document).on('click', '#addMember', function() {
                $('#addMemberForm')[0].reset();
                $('#addMemberModal').modal('open');

            });

            $("#addMemberForm").validate({
                rules: {
                    name: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name"
                    },
                    
                },
                submitHandler: function(form) {
                    var formData = $('#addMemberForm').serialize();
                    $.ajax({
                        url: 'add_member.php',
                        method: 'POST',
                        data: formData,
                        success: function(data) {
                            if (data === 'success') {
                                loadMembers();
                                $('#popup').hide();
                                $('#addMemberModal').modal('close');
                                ParentMembers();

                            } else {
                                alert('Failed to add member.');
                            }
                        }
                    });
                }
            });
            $( "#memberName" ).keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                });
        });
    </script>
</head>

<body>
    <div id="members">
    </div>
    <button id="addMember">Add Member</button>

</body>

<!-- Add Member Modal -->
<div id="addMemberModal" class="modal modal-sm">
    <div class="modal-content">
        <h4>Add Member</h4>
        <button type="button" class="btn btn-secondary modal-close close" data-bs-dismiss="modal">X</button>
        <form id="addMemberForm" method="post">
            <div class="input-field">
                <label for="parentDropdown">Parent</label>
                <select id="parentDropdown" name="parentId">
                    <!-- Populate this dropdown with parent members using AJAX -->
                </select>
            </div>
            <div class="input-field">
                <label for="memberName">Name</label>
                <input type="text" id="memberName" name="name" required>
            </div>
            <button type="button" class="modal-close" id="">Cancel</button>
            <button type="submit" class="">Save Changes</button>
        </form>
    </div>
</div>
<!-- Add Member Modal -->


</html>