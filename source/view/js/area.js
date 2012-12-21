$(function () {
    $('.edit-btn').click(function () {
        var target = $(this).data('target');
        var id = $(this).data('id');
        var tr = $(this).parents('tr');
        var name = tr.find('.name').text().trim();
        var index = tr.find('.index').text();
        var modal = $('#edit' + target);
        
        modal.find('input[name=id]').val(id);
        modal.find('input[name=name]').val(name);
        modal.find('input[name=index]').val(index);
        modal.modal();
    });
});
