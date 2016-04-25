$(".class_id").change(function () {
    classes = $(this);
    class_id = classes.val();

    if (class_id != 0) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {class_id: class_id},
            dataType: 'json',
            success: function (sections) {

                sectionSelect = classes.parent().parent().next('div.form-group').find('div .section_id');

                sectionSelect
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="0">Please Select Any Section</option>')

                ;


                sections.forEach(function (section) {
                    sectionSelect.append(new Option(section.name, section.id));
                });
            }
        });
    }
});