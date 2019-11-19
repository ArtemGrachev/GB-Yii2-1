function block(thisList) {
    let blockVal = thisList.attr('data-block');
    let blockType = blockVal.split('_')[0];
    let affect = $('[data-blocked="' + blockVal + '"]');
    if (blockType === 'select') {
        if (thisList.find('option:selected').val() === 'no') {
            affect.attr('disabled', 'disabled');
        } else {
            affect.removeAttr('disabled');
        }
    }
}
$(document).ready(function () {
    $('[data-block]').on('change', function (e) {
        block($(this));
    });
    $('[data-block]').each(function(i,elem) {
        block($(this));
    });
});