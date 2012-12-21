$(function () {
    $('.del-btn').click(function () {
        var tr = $(this).parents('tr');
        var id = tr.data('id');
        var target = $(this).data('target');
        $.get(
            '/cate',
            {
                action: 'del',
                target: target,
                id: id
            },
            function () {
                tr.remove();
            });
    });

    $('.edit-btn').click(function () {
        var tr = $(this).parents('tr');
        var id = tr.data('id');
        var name = tr.find('.name').text();
        var modal = $('#editModal');
        
        modal.find('input[name=id]').val(id);
        modal.find('input[name=name]').val(name);
        modal.modal();
    });
});
