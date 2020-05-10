<button type="button" class="btn btn-outline-primary btn-sm gradeEditBtn" data-toggle="modal"
        data-target="#editGradeModel" value="{{$data->id}}" >
    Edit Grade
</button>

<script>
    $('.gradeEditBtn').unbind().click(function() {
        // $("#editGradeModel").empty();
        $('#editGrade').val('');
        $('#editDescription').val('');
        gradeID = "";
        gradeID = $(this).attr("value");
        console.log(gradeID);
        $("#editGradeModel").ready(function() {
            $.ajax({
                url: "{{ route('admin.grade.getDataForEdit') }}",
                type: "get",
                data: {id:gradeID },
                success: function(a) {
                    $("#editGradeID").val(a[0]);
                    $("#editGrade").val(a[1]);
                    $("#editDescription").val(a[2]);
                    $("#editGradeStatus").empty();
                    if(a[3]=='0'){
                        $("#editGradeStatus").append('<option value="0" selected>Inactive</option>');
                        $("#editGradeStatus").append('<option value="1" >Active</option>');
                    }else{
                        $("#editGradeStatus").append('<option value="1" selected>Active</option>');
                        $("#editGradeStatus").append('<option value="0">Inactive</option>');
                    }


                },
                error: function(a) {
                    console.log("Data Load Error", a.responseJSON);
                }
            });

        });
    });
</script>
