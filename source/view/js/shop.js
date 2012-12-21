var d = function (arg) {
    console.log(arg);
};
$(function () {
    var addShop = $('#addShop');

    var v = addShop.find('form').validate({
        errorClass: 'help-inline',
        highlight: function (element, errorClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass) {
            $(element).parents('.control-group').removeClass('error');
        }
    });

    addShop.find('[name=province]').change(function () {
        var id = $(this).val();
        if (!id) 
            return;
        $.get('/city', { province: id }, function (ret) {
            addShop.find('[name=city]').html(ret).change(function () {
                var id = $(this).val();
                if (!id) 
                    return;
                $.get('/district', { city: id }, function (ret) {
                    addShop.find('[name=district]').html(ret);
                });
            });
        });
    });

    addShop.find('[name=bigCategory]').change(function () {
        var id = $(this).val();
        if (!id) {
            return;
        }
        var data = { bigCategory: id };
        $.get('/category', data, function (ret) {
            addShop.find('[name=category]').html(ret);
        });
        $.get('/type', data, function (ret) {
            addShop.find('[name=type]').html(ret);
        });
    });

    $('form[name=editShop]').validate();
    var uploadImageForm = $('form[name=uploadImage]');
    uploadImageForm.find('input[type=file]').change(function () {
        uploadImageForm.submit();
    });

    var searchForm = $('form[name=search]');
    searchForm.find('[name=city]').change(function () {
        var id = $(this).val();
        if (!id) 
            return;
        data = { 
            city: id,
            isSearch: 1 };
        $.get('/district', data, function (ret) {
            searchForm.find('[name=district]').html(ret);
        });
    });
});
