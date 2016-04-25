$(".section_id").change(function () {
    
    section = $(this);
    console.log(section);
    section_id = section.val();
   
    if (section_id != 0) {
         console.log(section_id);
        $.ajax({
            url: studentsUrl,
            type: 'POST',
            data: {section_id: section_id},
            dataType: 'json',
            success: function (students) {
                console.log(students);
                studentSelect = section.parent().parent().next('div.form-group').find('div .student_id');

                studentSelect
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="0">Please Select Any Student</option>')

                ;

                
                students.forEach(function (student) {
                    studentSelect.append(new Option(student.name, student.id));
                });
            }
        });
    }
});