$(document).ready(function () {

    $('body')
        .toast({
            displayTime: 'auto',
            title: 'Oups !',
            message: 'Ce sujet a été résolu ! Par conséquent vous ne pouvez plus y répondre !',
            showProgress: 'top',
            classProgress: 'red'
        });


});
