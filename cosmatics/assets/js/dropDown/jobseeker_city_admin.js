$("#state_id").change(function () {

    state = $(this);
    state_id = state.val();
    if (state_id != 0) {
        $.ajax({
            url: urlJobSeeker,
            type: 'POST',
            data: {state_id: state_id},
            dataType: 'json',
            success: function (cities) {
                select = state.parent().parent().next('div.form-group').find('div .city_id');
                select
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="0">Please Select Any City</option>')

                ;


                cities.forEach(function (city) {

                    select.append(new Option(city.name, city.id));
                });
            }
        });
    }
});