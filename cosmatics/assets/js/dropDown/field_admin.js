/**
 * Created by hp on 5/14/2015.
 */

$("#category_id").change(function () {

    category_id = $("#category_id").val();
    if (category_id != 0) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {category_id: category_id},
            dataType: 'json',
            success: function (subcategories) {

                select = document.getElementById('subcategory_id');
                $('.subcategory_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="0">Please Select Any Sub Category</option>')

                ;


                subcategories.forEach(function (subcategory) {
                    opt = document.createElement('option');
                    opt.value = subcategory.id;
                    opt.innerHTML = subcategory.name;
                    select.appendChild(opt);
                });
            }
        });
    }
});


