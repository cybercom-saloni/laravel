//function made for nested array with id
$(document).ready(function()
{
    var updateOutput = function(e)
    {


        var list   = e.length ? e : $(e.target),
            output = list.data('output');
             $(function () {
                $.ajax({
                    type: 'post',
                    url: "/category-subcategory/save-nested-categories",
                    data: $('#categorySave').serializeArray(),
                });
        });

        if (window.JSON) {
           var a=  output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));

      
        } else {
            output.val('JSON browser support required for this demo.');
        }

    };

    // activate Nestable for list 1
    $('#nestable-wrapper').nestable({
        group: 1,
        maxDepth : 20,
    })
    .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable-wrapper').data('output', $('#nestable-output')));

    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });




});
