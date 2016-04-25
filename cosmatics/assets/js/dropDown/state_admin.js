/**
 * Created by hp on 5/6/2015.
 */

$("#region_id").change(function () {
    region = $(this);
    region_id = region.val();
    if (region_id != 0) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {region_id: region_id},
            dataType: 'json',
            success: function (countries) {

                select = region.parent().parent().next('div.form-group').find('div .country_id');
                select
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="0">Please Select Any Country</option>')

                ;


                countries.forEach(function (country) {
                    select.append(new Option(country.name, country.id));
                });
            }
        });
    }
});

