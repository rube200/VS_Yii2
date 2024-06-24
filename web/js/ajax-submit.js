const $form = $('.ajax-form');

$form.on('beforeSubmit', function() {
    const url = $form.attr('action');
    const dataArray = $form.serializeArray();

    //convert form data into json
    //dataArray is a list like { name: '_csrf', value: 'p5...' }
    const object = {};
    dataArray.forEach(dt => {
        let key = dt['name'];
        const value = dt['value'];

        //we need to trim the name correctly
        //example: TarefaForm[titulo] -> titulo in object form
        const firstBracket = key.indexOf('[');
        if (firstBracket !== -1) {
            const formName = key.substring(0, firstBracket);
            if (!(formName in object)) {
                object[formName] = {};
            }

            const lastBracket = key.indexOf(']');
            key = key.substring(firstBracket + 1, lastBracket);
            object[formName][key] = value;
        }
        else {
            object[key] = value
        }
    });
    const json = JSON.stringify(object);

    $.ajax({
        type: "POST",
        url: url,

        contentType: 'application/json',
        data: json,
        dataType: 'json',

        success: (e) => {
            console.log("Success" + e);
        },

    });

    // prevent default submit
    return false;
});