@extends('layout')

@section('title', 'Students List')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Students</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>
</div>

<table id="studentsTable" class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <!-- <th>City</th> -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phonenumber }}</td>
            <!-- <td>{{ $student->city }}</td> -->
            <td>
                <button class="btn btn-warning btn-sm edit-student" data-id="{{ $student->id }}">Edit</button>
                <button class="btn btn-danger btn-sm delete-student" data-id="{{ $student->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@include('add-modal')
@include('edit-modal')

<script>
$(document).ready(function() {
    $('#addStudentModal form').on('submit', function(e) {
        e.preventDefault(); 

        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();

        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function(response) {
                $('#addStudentModal').modal('hide'); 
                // alert(response.message); 
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("An error occurred. Please try again.");
            }
        });
    });

    $('#studentsTable').DataTable();

    $(document).on('click', '.edit-student', function() {
        const id = $(this).data('id');

        $.ajax({
            url: `/students/${id}`,
            method: 'GET',
            success: function(response) {
                $('#editStudentForm').attr('action', `/students/${id}`);
                $('#edit-name').val(response.name);
                $('#edit-email').val(response.email);
                $('#edit-phonenumber').val(response.phonenumber);
                $('#edit-address').val(response.address);
                $('#edit-zipcode').val(response.zipcode);
                $('#edit-dob').val(response.dob);

                if (response.gender === 'male') {
                    $('#edit-gender-male').prop('checked', true);
                } else {
                    $('#edit-gender-female').prop('checked', true);
                }

                // Show the edit modal
                $('#editStudentModal').modal('show');
            },
            error: function() {
                alert('Failed to fetch student details.');
            }
        });
    });

    $('#editStudentModal form').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const url = form.attr('action');
        const data = form.serialize();

        $.ajax({
            url: url,
            method: 'PUT',
            data: data,
            success: function(response) {
                $('#editStudentModal').modal('hide'); 
                // alert(response.message); 
                // $('#studentsTable').DataTable().ajax.reload(null, false);
            },
            error: function(xhr) {
                alert('Failed to update student details.');
            }
        });
    });

    $('.delete-student').on('click', function() {
        // e.preventDefault();
        const id = $(this).data('id');
        const row = $(this).closest('tr');
        if (confirm('Are you sure you want to delete this student?')) {
            $.ajax({
                url: `/students/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    row.fadeOut(500, function() {
                        $(this).remove();
                    });
                    // alert(response.message);
                },
                error: function() {
                    alert('Error deleting the student.');
                }
            });
        }
    });
});
</script>
@endsection
