/**
 * Created by hp on 5/11/2015.
 */


$("#country_id").change(function () {
    country = $(this);
    country_id = country.val();

    if (country_id != 0) {
        $.ajax({
            url: urlCity,
            type: 'POST',
            data: {country_id: country_id},
            dataType: 'json',
            success: function (states) {

                city_select = country.parent().parent().next('div.form-group').find('div .state_id');

                city_select
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="0">Please Select Any State</option>')

                ;


                states.forEach(function (state) {
                    city_select.append(new Option(state.name, state.id));
                });
            }
        });
    }
});
